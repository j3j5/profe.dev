Vue.component('AddImageModal', {
    template: "#image-modal-template",
    props: ['show', 'name', 'action', 'model'],
    data: function() {
        return {
            titulo: '',
            artista: '',
            anho: false,
            image: '',
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
                } else {
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
        }
    },
    methods: {
        close: function() {
            this.$dispatch('modalClosed');
        },
        submitForm: function() {
            this.$http.post(this.action, this.$data)
            .then(function(response) {
                if (Object.keys(this.model).length > 0) {
                    this.$dispatch('itemEdited',  JSON.parse(response.body));
                } else {
                    this.$dispatch('itemCreated',  JSON.parse(response.body));
                }
            }, function(response) {
                alert(response);
            });
        },
    },
    ready: function() {
        var self = this;
        Dropzone.options.imagesDropzone = {
            init: function() {
                this.on("success", function(file, responseText) {
                    self.image = file.name;
                });
            }
        };
    },
});
