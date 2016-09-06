<template>
<div class="col-sm-4 col-md-2">
    <div class="new add-item thumbnail text-center" @click.stop="openModal">
        <i class="fa fa-5x fa-plus-circle"></i>
    </div>
    <div class="new thumbnail text-center">
        <form id="fileUpload" action="{{ createUrl }}">
            <input type="hidden" name="_token" value="{{csrf_token}}">
            <div class="dz-message" v-bind:style="formMsg">
                <i class="fa fa-4x fa-plus-circle"></i>
                <i class="fa fa-4x fa-upload"></i>
            </div>
        </form>
    </div>
</div>
<div @click="editItem(model)" class="col-sm-4 col-md-2" v-for="model in values" track-by="id">
    <div class="thumbnail gallery-item">
    <button class="btn btn-danger btn-sm featured-button" href="#" @click.prevent.stop="toggleFeatured(model)">
        <i class="fa fa-2x" v-bind:class="{ 'fa-star': model.featured, 'fa-star-o': !model.featured }"></i>
    </button>
    <button class="btn btn-danger btn-sm delete-button" href="#" @click.prevent.stop="deleteItem(model)">
        <i class="fa fa-2x fa-trash-o"></i>
    </button>
    <div class="gallery-image">
        {{{model.imagen | displayMedia"}}}
        <div class="caption">
            <span v-if="model.titulo || model.autor" class="text-center"><strong>{{model.titulo}}</strong> por {{model.autor}}
        </span>
        </div>
    </div>
    </div>
</div>
</template>

<script>
export default {
    name: "AdminGaleryImages",
    components: {},
    props: ['values', 'filterKey'],
    data: function() {
        return {
            fileUpload: false,
        };
    },
    methods: {
        deleteItem: function(entry) {
            this.$dispatch('removeItem', entry);
        },
        toggleFeatured: function(item) {
            console.log('featuring');
            var data = {featured: !item.featured};
            this.$http.post(this.$parent.updateModelUrl + item.id, data)
            .then(function(response) {
                item.featured = data.featured;
            }, function(response) {
                alert(response.body);
            });
        },
        editItem: function(entry) {
            var data = {entry: entry, url: this.$parent.updateModelUrl};
            this.$dispatch("editItem", data);
        },
        openModal: function() {
            this.$dispatch('openModal', {url: this.$parent.createModelUrl});
        },
        closeModal: function() {
            this.$dispatch('closeModal');
        },
    },
    computed: {
        createUrl: function() {
            return this.$parent.bulkUploadUrl;
        },
        csrf_token: function() {
            return $('meta[name="_token"]').attr('content');
        }
    },
    ready: function() {
        var self = this;

        Dropzone.options.fileUpload = false;
        this.fileUpload = new Dropzone("form#fileUpload", {
            init: function() {
                this.on("success", function(file, response) {
                    console.log('success ' + file.name);
                    self.$dispatch('itemCreated', response);
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
}
.gallery-image {
}
</style>
