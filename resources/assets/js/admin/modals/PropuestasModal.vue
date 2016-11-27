<script>
export default {
    name: 'AddPropuestaModal',
    template: "#propuesta-modal-template",
    props: ['show', 'name'],
    data: function() {
        return {
            nombre: '',
            contenidos: '',
            curso: 1,
            thumbnail: '',
            archivo: '',
            action: '',
            model: '',
            thumbDropzone: false,
            fileDropzone: false,
            formFields: ['nombre', 'contenidos', 'curso', 'thumbnail', 'archivo'],
        };
    },
    created: function() {
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
            for (var property in this.$data) {
                if (this.model.hasOwnProperty(property)) {
                    this.$data[property] = this.model[property];
                } else if(jQuery.inArray(property, this.formFields) != -1) {
                    this.$data[property] = '';
                }
            }
        },
    },
    computed: {
        thumbBgStyle: function() {
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
            var mydata = {};
            for (var property in this.$data) {
                if(jQuery.inArray(property, this.formFields) != -1) {
                    mydata[property] = this.$data[property];
                }
            }
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
                console.log('error on the req');
                console.log(response);
                alert(response.body);
            });
        },
        reset: function() {
            this.action = '';
            this.model = {};
            this.thumbDropzone.removeAllFiles();
            this.filesDropzone.removeAllFiles();
        },
    },
    mounted: function() {
        var self = this;
        Dropzone.options.imagesDropzone = false;
        Dropzone.options.filesDropzone = false;

        this.thumbDropzone = new Dropzone("form#images-dropzone", {
            init: function() {
                this.on("success", function(file, responseText) {
                    self.thumbnail = file.name;
                });
            },
            addRemoveLinks: true
        });

        this.filesDropzone = new Dropzone("form#files-dropzone", {
            init: function() {
                this.on("success", function(file, responseText) {
                    self.archivo = file.name;
                });
            },
            addRemoveLinks: true
        });

    },
}
</script>
