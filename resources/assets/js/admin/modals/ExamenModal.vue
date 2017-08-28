<script>
export default {
    name: 'AddExamenModal',
    template: "#examen-modal-template",
    props: ['show', 'name',],
    data() {
        return {
            nombre: '',
            trimestre: 1,
            curso: 1,
            thumbnail: '',
            archivo: '',
            action: '',
            model: '',
            thumbDropzone: false,
            fileDropzone: false,
            formFields: ['nombre', 'trimestre', 'curso', 'thumbnail', 'archivo'],
        };
    },
    created() {
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
        model() {
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
        thumbBgStyle() {
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
            if(this.thumbnail) {
                return "url('/uploads/" + this.thumbnail + "')";
            }
            return '';
        },
        formData() {
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
            this.thumbDropzone.removeAllFiles();
            this.filesDropzone.removeAllFiles();
        },
    },
    mounted() {
        Dropzone.options.imagesDropzone = false;
        Dropzone.options.filesDropzone = false;

        this.thumbDropzone = new Dropzone("form#images-dropzone", {
            init: () => {
                this.on("success", (file, responseText) => {
                    this.thumbnail = file.name;
                });
            },
            addRemoveLinks: true
        });

        this.filesDropzone = new Dropzone("form#files-dropzone", {
            init: () => {
                this.on("success", (file, responseText) => {
                    this.archivo = file.name;
                });
            },
            addRemoveLinks: true
        });
    },
}
</script>
