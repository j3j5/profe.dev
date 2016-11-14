Vue.component('AddPropuestaModal', {
    template: "#propuesta-modal-template",
    props: ['show', 'name', 'action', 'model'],
    data: function() {
        return {
            nombre: '',
            contenidos: '',
            curso: 1,
            thumbnail: '',
            archivo: '',
            thumbDropzone: false,
            fileDropzone: false,
            formFields: ['nombre', 'contenidos', 'curso', 'thumbnail', 'archivo'],
        };
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
            this.$dispatch('closeModal');
            this.thumbDropzone.removeAllFiles();
            this.filesDropzone.removeAllFiles();
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
                this.filesDropzone.removeAllFiles();
            }, function(response) {
                alert(response);
            });
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
});
