<template>
<div class="col-sm-4 col-md-2" v-for="model in values" track-by="id">
    <div class="thumbnail">
        <button class="btn btn-danger btn-sm featured-button" href="#" @click.prevent="toggleFeatured(model)">
            <i class="fa fa-2x" v-bind:class="{ 'fa-star': model.featured, 'fa-star-o': !model.featured }"></i>
        </button>
        <button class="btn btn-danger btn-sm delete-button" href="#" @click.prevent="deleteItem(model)">
            <i class="fa fa-2x fa-trash-o"></i>
        </button>
        {{{model.imagen | displayMedia"}}}
        <div class="caption">
            <span class="text-center"><strong>{{model.titulo}}</strong> por {{model.autor}}
        </span>
        </div>
    </div>
</div>
<div class="col-sm-4 col-md-2">
    <div class="add-item thumbnail text-center">
        <i class="fa fa-5x fa-plus-circle"></i>
    </div>
</div>
</template>

<script>
export default {
    name: "AdminGaleryImages",
    components: {},
    props: ['values', 'filterKey'],
    methods: {
        deleteItem: function(entry) {
            this.$dispatch('removeItem', entry);
        },
        toggleFeatured: function(item) {
            console.log('featuring');
            var data = {featured: !item.featured};
            this.$http.post(this.$parent.updateModelUrl + item.id, data)
            .then(function(response) {
                console.log('success!');
                item.featured = data.featured;
                // this.$dispatch('itemEdited', item);
            }, function(response) {
                alert(response.body);
            });
        },
    }
}
</script>

<style>
.admin-thumb {
    max-height: 200px;
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
    right: 20px;
    opacity: 0.8;
}
.add-item {
    height: 200px;
    line-height: 225px;
    color: green;
}
</style>
