Vue.component('AddConceptoModal', {
    template: "#concepto-modal-template",
    props: ['show', 'name', 'action', 'model'],
    data: function() {
        return {
            palabra: '',
            definicion: '',
            curso: false,
            thumbnail: '',
            grupo_id: '',
            grupos: [],
            thumbDropzone: false,
            formFields: ['palabra', 'definicion', 'curso', 'thumbnail', 'grupo_id'],
            showGrupo: false,
            grupoConcepto: '',
        };
    },
    created: function() {
        this.fetchGrupos();
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
            this.formFields.forEach(function(field) {
                if (self.$data.hasOwnProperty(field)) {
                    mydata[field] = self.$data[field];
                }
            });
            return mydata;
        },
    },
    methods: {
        close: function() {
            this.$dispatch('closeModal');
            this.thumbDropzone.removeAllFiles();
        },
        submitForm: function() {
            this.$http.post(this.action, this.formData)
            .then(function(response) {
                if (Object.keys(this.model).length > 0) {
                    this.$dispatch('itemEdited',  JSON.parse(response.body));
                } else {
                    this.$dispatch('itemCreated',  JSON.parse(response.body));
                }
                this.thumbDropzone.removeAllFiles();
            }, function(response) {
                alert(response);
            });
        },
        fetchGrupos: function() {
            this.$http.get('/admin/api/grupos').then(function(response) {
                this.grupos = response.data.grupos;
            }).bind(this);
        },
        createNewGrupo: function() {
            var data = {nombre: this.grupoConcepto};
            this.$http.post('/admin/api/grupoConcepto/create', data).then(function(response) {
                var newGrupo = JSON.parse(response.body);
                this.grupos.push(newGrupo);
                this.showGrupo = false;
                this.grupo_id = newGrupo.id;
            }).bind(this);
        }
    },
    ready: function() {
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
});
