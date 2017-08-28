<script>
export default {
    name: 'AddImageModal',
    template: "#image-modal-template",
    props: ['show', 'name',],
    data() {
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
    created() {
        this.bus.$on('openModal', (data) => {
            this.action = data.url;
        });
        this.bus.$on('editItem', (data) => {
            this.action = data.url;
            this.model = data.entry;
        });
        this.bus.$on('resetModal', () =>  {
            this.reset();
        });
        this.bus.$on('itemCreated', () => {
            this.reset();
        });
        this.bus.$on('itemEdited', () => {
            this.reset();
        });
    },
    watch: {
        model() {
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
        formBgStyle() {
            return {
                backgroundSize: 'cover',
                backgroundImage: this.imageUrl,
                backgroundRepeat: 'no-repeat',
                backgroundPosition: 'center',
            };
        },
        formMsg() {
            return {
                backgroundColor: "white",
                opacity: "0.8",
                width: "30%",
                margin: "2em auto",
            }
        },
        imageUrl() {
            if(this.image) {
                return "url('/images/galeria/1/" + this.image + "')";
            }
            return '';
        },
        formData() {
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
        close() {
            this.bus.$emit('closeModal');
            this.reset();
        },
        submitForm() {
            Vue.axios.post(this.action, this.formData)
            .then((response) => {
                if (Object.keys(this.model).length > 0) {
                    var eventData = {old: this.model, new: response.body};
                    this.bus.$emit('itemEdited', eventData);
                } else {
                    this.bus.$emit('itemCreated', response.body);
                }
                this.close();
            }, (response) => {
                alert(response);
            });
        },
        reset() {
            this.action = '';
            this.model = {};
            this.myDropzone.removeAllFiles();
        },
    },
    mounted() {
        Dropzone.options.filesDropzone = false;
        this.myDropzone = new Dropzone("form#files-dropzone", {
            init() {
                this.on("success", (file, responseText) => {
                    this.image = file.name;
                });
            },
            addRemoveLinks: true
        });
    },
}
</script>
