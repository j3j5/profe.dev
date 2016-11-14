<template>
    <div @click="" @keyup.esc="">
        <!-- FILTER -->
        <div class="col-sm-8">
            <div v-if="showFilter" style="padding-top: 10px;padding-bottom: 10px;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Filter" v-model="filterKey">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-search"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery -->
        <div class="col-sm-12">
            <admin-gallery-images
                v-if="values.length > 0"
                :values="values"
                :filter-key="filterKey">
            </admin-gallery-images>
            <div v-else class="alert alert-info" role="alert">No hay nada todavía</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AdminGalery",
    components: {},
    props: {
        modelName: {
            type: String,
            required: false,
        }
    },
    data: function () {
        return {
            getTableUrl: "/admin/api/"+this.modelName+"/table",
            createModelUrl: '/admin/api/' + this.modelName + '/create',
            updateModelUrl: '/admin/api/' + this.modelName + '/update/',
            bulkUploadUrl: BASE_URL + '/admin/api/' + this.modelName + '/bulkUpload',
            deleteModelUrl: '/admin/api/' + this.modelName + '/delete/',
            values: [],
            filteredSize: 0,
            filterKey: "",
            showFilter: false,
        };
    },
    mounted: function() {
        this.fetchData();
    },
    methods: {
        fetchData: function () {
            this.$http.get(this.getTableUrl).then(function(response) {
                this.values = response.data.values;
            }).bind(this);
        },
    },
    events: {
        removeItem: function(item) {
            if(confirm("¿Estás segura de que deseas eliminarlo?\nNo se podrá recuperar.")) {
                this.$http.delete(this.deleteModelUrl + item.id).then(function(response) {
                    this.values.splice(this.values.indexOf(item), 1);
                }).bind(this);
            }
        },
        itemEdited: function(item) {
            var index = this.values.indexOf(item.old);
            if (index !== -1) {
                Vue.set(this.values, index, item.new)
            }
        },
        itemCreated: function(item) {
            this.values.push(item);
        },
    },
}
</script>
