Vue.component('AddImageModal', {
    template: "#image-modal-template",
    props: ['show', 'name', 'action', 'model'],
    data: function() {
        return {
            titulo: '',
            artista: '',
            anho: false,
            image: '',
            myDropzone: false,
            formFields: ['titulo', 'artista', 'anho', 'image'],
        };
    },
    watch: {
        model: function() {
            var modelProp;
            for (var property in this.$data) {
                switch(property) {
                    case 'anho':
                        modelProp = "año";
                        break;
                    case 'image':
                        modelProp = "nombre-archivo";
                        break;
                    default:
                        modelProp = property;
                        break;
                }
                if (this.model.hasOwnProperty(modelProp)) {
                    this.$data[property] = this.model[modelProp];
                } else if(jQuery.inArray(property, this.formFields) != -1) {
                    this.$data[property] = '';
                }
            }
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
            if(this.image) {
                return "url('/images/galeria/1/" + this.image + "')";
            }
            return '';
        },
        formData: function() {
            var thedata = {};
            var key;
            for (var property in this.$data) {
                if(jQuery.inArray(property, this.formFields) != -1) {
                    switch(property) {
                        case 'anho':
                        key = "año";
                        break;
                        case 'image':
                        key = "nombre-archivo";
                        break;
                        default:
                        key = property;
                        break;
                    }
                    thedata[key] = this.$data[property];
                }
            }
            return thedata;
        },
    },
    methods: {
        close: function() {
            this.$dispatch('closeModal');
            this.myDropzone.removeAllFiles();
        },
        submitForm: function() {
            this.$http.post(this.action, this.formData)
            .then(function(response) {
                if (Object.keys(this.model).length > 0) {
                    this.$dispatch('itemEdited',  JSON.parse(response.body));
                } else {
                    this.$dispatch('itemCreated',  JSON.parse(response.body));
                }
                this.myDropzone.removeAllFiles();
            }, function(response) {
                alert(response);
            });
        },
    },
    mounted: function() {
        Dropzone.options.filesDropzone = false;
        var self = this;
        this.myDropzone = new Dropzone("form#files-dropzone", {
            init: function() {
                this.on("success", function(file, responseText) {
                    self.image = file.name;
                });
            },
            addRemoveLinks: true
        });
    },
});
