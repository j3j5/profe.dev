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
                :filter-key="filterKey"
                :bulkUploadUrl="bulkUploadUrl"
                :createModelUrl="createModelUrl"
                :updateModelUrl="updateModelUrl">
            </admin-gallery-images>
            <div v-else class="alert alert-info" role="alert">No hay nada todavía</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AdminGalery",
    components: {},
    props: ['modelName'],
    data() {
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
    created() {
        this.bus.$on('itemCreated', (item) => {
            this.values.push(item);
        });
        this.bus.$on('itemEdited', (item) => {
            var index = self.values.indexOf(item.old);
            if (index !== -1) {
                Vue.set(self.values, index, item.new)
            }
        });
        this.bus.$on('removeItem', (item) => {
            if(confirm("¿Estás segura de que deseas eliminarlo?\nNo se podrá recuperar.")) {
                this.axios.delete(self.deleteModelUrl + item.id)
                .then( (response) => {
                    var index = this.values.indexOf(item);
                    this.values.splice(index, 1);
                }, (response) => {
                    console.log('error on the del req');
                    console.log(response);
                    alert(response.body);
                });
            }
        });
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            Vue.axios.get(this.getTableUrl).then((response) => {
                this.values = response.data.values;
            });
        },
    },
}
</script>
