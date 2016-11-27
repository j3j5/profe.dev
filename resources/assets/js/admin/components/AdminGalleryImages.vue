<template>
<div>
    <div class="col-sm-4 col-md-2">
        <div class="new add-item thumbnail text-center" @click.stop="openModal">
            <i class="fa fa-5x fa-plus-circle"></i>
        </div>
        <div class="new thumbnail text-center">
            <form id="fileUpload" v-bind:action="bulkUploadUrl">
                <input type="hidden" name="_token" v-bind:value="csrf_token">
                <div class="dz-message" v-bind:style="formMsg">
                    <i class="fa fa-4x fa-plus-circle"></i>
                    <i class="fa fa-4x fa-upload"></i>
                </div>
            </form>
        </div>
    </div>
    <div @click="editItem(model)" class="col-sm-4 col-md-2" v-for="model in values" v-bind:key="model.id">
        <div class="thumbnail gallery-item">
        <button class="btn btn-danger btn-sm featured-button" href="#" @click.prevent.stop="toggleFeatured(model)">
            <i class="fa fa-2x" v-bind:class="{ 'fa-star': model.featured, 'fa-star-o': !model.featured }"></i>
        </button>
        <button class="btn btn-danger btn-sm delete-button" href="#" @click.prevent.stop="deleteItem(model)">
            <i class="fa fa-2x fa-trash-o"></i>
        </button>
        <div class="gallery-image">
            <div v-html="displayMedia(model.imagen)"></div>
            <div class="caption">
                <span v-if="model.titulo || model.autor" class="text-center"><strong>{{ model.titulo }}</strong> por {{ model.autor }}
            </span>
            </div>
        </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "AdminGaleryImages",
    components: {},
    props: ['values', 'filterKey', 'createModelUrl', 'updateModelUrl', 'bulkUploadUrl'],
    data: function() {
        return {
            fileUpload: false,
        };
    },
    methods: {
        deleteItem: function(entry) {
            this.bus.$emit('removeItem', entry);
        },
        toggleFeatured: function(item) {
            var data = {featured: !item.featured};
            this.$http.post(this.updateModelUrl + item.id, data)
            .then(function(response) {
                item.featured = data.featured;
            }, function(response) {
                console.log(response.body)
                alert(response.body);
            });
        },
        editItem: function(entry) {
            var data = {entry: entry, url: this.updateModelUrl + entry.id};
            this.bus.$emit('editItem', data);
        },
        openModal: function() {
            this.bus.$emit('openModal', {url: this.createModelUrl});
        },
        displayMedia: function(value) {
            if(String(value).match(/.*\.(png|jpe?g|gif)(\?.*)?$/i)) {
                return '<img src="' + IMG_BASE_URL + value + '" alt="' + value + '" class="admin-thumb img-responsive">';
            } else if(String(value).match(/.*\.(pdf|doc|docx)(\?.*)?$/i)) {
                return '<a target="_blank" href="' + FILES_BASE_URL + value + '" class="">' + value + '</a>';
            } else {
                return value;
            }
        },
    },
    computed: {
        csrf_token: function() {
            return $('meta[name="_token"]').attr('content');
        }
    },
    mounted: function() {
        var self = this;

        Dropzone.options.fileUpload = false;
        this.fileUpload = new Dropzone("form#fileUpload", {
            init: function() {
                this.on("success", function(file, response) {
                    console.log('success ' + file.name);
                    self.bus.$emit('itemCreated', response);
                    this.removeFile(file);
                });
            },
            uploadMultiple: false,
        });
    },
}
</script>

<style>
.admin-thumb {
    max-height: 180px;
    margin: auto;
}
.featured-button {
    position: absolute;
    top: 5px;
    opacity: 0.8;
}
.delete-button {
    position: absolute;
    top: 5px;
    right: 5px;
    opacity: 0.8;
}

.new {
    height: 100px;
    line-height: 125px;
    color: green;
    position: relative;
}

.add-item {
    position: relative;
    top: 0;
    line-height: 75px;
    height: 75px;
}

.gallery-item {
    height: 220px;
    position: relative;
    margin: 5px;
    background-color: rgba(220, 236, 239, 0.7);
}
.gallery-image {
}
</style>
