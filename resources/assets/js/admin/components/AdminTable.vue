<template>
    <!-- FILTER -->
    <div @click="closeDropdown" @keyup.esc="closeDropdown">
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
        <!-- COLUMN PICKER (BUTTON) -->
        <div class="col-sm-4">
            <div style="padding-top: 10px;padding-bottom: 10px;float:right;">
                <div class="btn-group" :class="{'open' : columnMenuOpen}">
                    <button @click="openModal" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Añadir nuevo</button>
                    <button @click="toggleFilter" class="btn btn-warning">Filtrar</button>
                    <button @click.stop.prevent="columnMenuOpen = !columnMenuOpen" @keyup.esc="columnMenuOpen = false"
                            type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true">
                        Columnas <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li v-for="column in displayCols">
                            <a href="#" @click.stop.prevent="toggleColumn(column)">
                                <i v-if="column.visible" class="glyphicon glyphicon-ok"></i> {{column.title}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="col-sm-12">
            <admin-values
                v-if="values.length > 0"
                :columns="displayCols"
                :values="values"
                :sort-key="sortKey"
                :sort-orders="sortOrders"
                :filter-key="filterKey">
            </admin-values>
            <div v-else class="alert alert-info" role="alert">No hay nada todavía</div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "AdminTable",
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
                deleteModelUrl: '/admin/api/' + this.modelName + '/delete/',
                columns: [],
                values: [],
                filteredSize: 0,
                filterKey: "",
                sortKey: "",
                sortOrders: {},
                columnMenuOpen: false,
                displayCols: [],
                showFilter: false,
            };
        },
        created: function () {
           this.setSortOrders();
           var self = this;
           this.columns.forEach(function (column) {
               var obj = {};
               obj.title = column.title;
               obj.visible = true;
               self.displayCols.push(obj);
           });
        },
        ready: function() {
            this.fetchTable();
        },
        watch: {
            columns: function () {
                var self = this;
                this.columns.forEach(function (column) {
                    var obj = {};
                    obj.title = column;
                    obj.visible = true;
                    self.displayCols.push(obj);
                });
                this.setSortOrders();
            },
            showFilter: function () {
                this.filterKey = "";
            },
            showColumnPicker: function () {
                this.columnMenuOpen = false;

                this.displayCols.forEach(function (column) {
                    column.visible = true;
                });
            }
        },
        methods: {
            fetchTable: function() {
                this.$http.get(this.getTableUrl).then(function(response) {
                    this.columns = response.data.columns;
                    this.values = response.data.values;
                }).bind(this);
            },
            setSortOrders: function () {
                this.sortKey = "";
                var sortOrders = {};
                this.columns.forEach(function (column) {
                    sortOrders[column] = 0;
                });
                this.sortOrders = sortOrders;

            },
            closeDropdown: function () {
                this.columnMenuOpen = false;
            },
            toggleColumn: function (column) {
                column.visible = !column.visible;
            },
            toggleFilter: function() {
                this.showFilter = !this.showFilter;
            },
            openModal: function() {
                this.$dispatch('openModal', {url: this.createModelUrl});
            },
        },
        events: {
            removeItem: function(item) {
                if(confirm("Estás a punto de borrar " + item.nombre + ".\n¿Estás segura de que deseas eliminarlo?\nNo se podrá recuperar.")) {
                    this.$http.delete(this.deleteModelUrl + item.id).then(function(response) {
                        this.values.$remove(item);
                    }).bind(this);
                }
            },
            itemCreated: function(item) {
                this.values.push(item);
            },
            itemEdited: function(item) {
                 var index = this.values.indexOf(item.old);
                 if (index !== -1) {
                     this.values.$set(index, item.new);
                 }
            },
        },
    }
</script>

<style>
</style>
