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
                    <button @click="showModal=true" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Añadir nuevo</button>
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
                :columns.sync="displayCols"
                :values.sync="filteredValues"
                :sort-key.sync="sortKey"
                :sort-orders.sync="sortOrders">
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
            columns: {
                type: Array,
            },
            values: {
                type: Array,
                twoWay: true,
            },
            model: {
                type: String,
                required: false,
            },
            showModal: {
                type: Boolean,
                default: false,
            }
        },
        data: function () {
            return {
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
        computed: {
            filteredValues: function () {
                var result = this.$options.filters.filterBy(this.values, this.filterKey);
                result = this.$options.filters.orderBy(result, this.sortKey, this.sortOrders[this.sortKey]);
                this.filteredSize = result.length;
                return result;
            },
        },
        methods: {
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
        },
        events: {
        }
    }
</script>

<style>
    .vue-table td {
        vertical-align: middle !important;
    }
    .admin-thumb {
        max-height: 90px;
        margin: auto;
    }

    .is-icon {
        text-align: center;
    }
</style>
