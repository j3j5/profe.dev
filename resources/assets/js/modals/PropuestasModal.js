Vue.component('AddPropuestaModal', {
    template: "#propuesta-modal-template",
    props: ['show', 'name', 'action', 'model'],
    data: function() {
        return {
            nombre: '',
            contenidos: '',
            curso: false,
            thumbnail: '',
            archivo: '',
        };
    },
    watch: {
        model: function() {
            for (var property in this.$data) {
                if (this.model.hasOwnProperty(property)) {
                    this.$data[property] = this.model[property];
                } else {
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
        }
    },
    methods: {
        close: function() {
            this.$dispatch('closeModal');
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
                    self.thumbnail = file.name;
                });
            }
        };
        Dropzone.options.filesDropzone = {
            init: function() {
                this.on("success", function(file, responseText) {
                    self.archivo = file.name;
                });
            }
        };
    },
});
