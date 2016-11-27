<script>
export default {
    name: 'AddConceptoModal',
    template: "#concepto-modal-template",
    props: ['show', 'name',],
    data: function() {
        return {
            palabra: '',
            definicion: '',
            curso: false,
            thumbnail: '',
            grupo_id: '',
            grupos: [],
            action: '',
            model: '',
            thumbDropzone: false,
            formFields: ['palabra', 'definicion', 'curso', 'thumbnail', 'grupo_id'],
            showGrupo: false,
            grupoConcepto: '',
        };
    },
    created: function() {
        this.fetchGrupos();

        var self = this;
        this.bus.$on('openModal', function (data) {
            self.action = data.url;
        });
        this.bus.$on('editItem', function (data) {
            self.action = data.url;
            self.model = data.entry;
        });
        this.bus.$on('resetModal', function () {
            self.reset();
        });
        this.bus.$on('itemCreated', function () {
            self.reset();
        });
        this.bus.$on('itemEdited', function () {
            self.reset();
        });
    },
    watch: {
        model: function() {
            var modelProp;
            var self = this;
            this.formFields.forEach(function(field) {
                if (self.model.hasOwnProperty(field)) {
                    self.$data[field] = self.model[field];
                } else {
                    self.$data[field] = '';
                }
            });
        },
    },
    computed: {
        formBgStyle: function() {
            return {
                backgroundSize: 'cover',
                backgroundImage: this.imageUrl,
                backgroundRepeat: 'no-repeat',
                backgroundPosition: 'center',
            };
        },
        formMsg: function() {
            return {
                backgroundColor: "white",
                opacity: "0.8",
                width: "30%",
                margin: "2em auto",
            }
        },
        imageUrl: function() {
            if(this.thumbnail) {
                return "url('/uploads/" + this.thumbnail + "')";
            }
            return '';
        },
        formData: function() {
            var self = this;
            var mydata = {};
            this.formFields.forEach( function(field) {
                if (self.$data.hasOwnProperty(field)) {
                    mydata[field] = self.$data[field];
                }
            });
            return mydata;
        },
    },
    methods: {
        close: function() {
            this.bus.$emit('closeModal');
            this.reset();
        },
        submitForm: function() {
            this.$http.post(this.action, this.formData)
            .then(function(response) {
                if (Object.keys(this.model).length > 0) {
                    var eventData = {old: this.model, new: response.body};
                    this.bus.$emit('itemEdited', eventData);
                } else {
                    this.bus.$emit('itemCreated', response.body);
                }
                this.close();
            }, function(response) {
                alert(response);
            });
        },
        reset: function() {
            this.action = '';
            this.model = {};
            this.thumbDropzone.removeAllFiles();
        },
        fetchGrupos: function() {
            this.$http.get('/admin/api/grupos').then(function(response) {
                this.grupos = response.data.grupos;
            }).bind(this);
        },
        createNewGrupo: function() {
            var data = {nombre: this.grupoConcepto};
            this.$http.post('/admin/api/grupoConcepto/create', data).then(function(response) {
                var newGrupo = response.body;
                this.grupos.push(newGrupo);
                this.showGrupo = false;
                this.grupo_id = newGrupo.id;
            }).bind(this);
        }
    },
    mounted: function() {
        Dropzone.options.thumbDropzone = false;
        var self = this;
        this.thumbDropzone = new Dropzone("form#thumb-dropzone", {
            init: function() {
                this.on("success", function(file, responseText) {
                    self.image = file.name;
                });
            },
            addRemoveLinks: true
        });
    },
}
</script>
