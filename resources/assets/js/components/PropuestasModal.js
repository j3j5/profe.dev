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
    methods: {
        close: function() {
            this.show = false;
            this.model = {};
            this.action = CREATE_BASE_URL;
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
