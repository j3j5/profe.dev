<script>
export default {
    name: 'AddImageModal',
    template: "#image-modal-template",
    props: ['show', 'name',],
    data: function() {
        return {
            titulo: '',
            artista: '',
            anho: false,
            image: '',
            action: '',
            model: '',
            myDropzone: false,
            formFields: ['titulo', 'artista', 'anho', 'image'],
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
            this.myDropzone.removeAllFiles();
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
}
</script>
