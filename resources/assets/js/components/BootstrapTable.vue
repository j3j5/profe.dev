<template>
    <div class="col-sm-12">
        <button @click="showModal = true"  class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Añadir nuevo</button>
        <button @click="toggleFilter" class="btn btn-default">Filtrar</button>
    </div>

    <div @click="closeDropdown" @keyup.esc="closeDropdown">
        <div class="col-sm-6">
            <div v-if="showFilter" style="padding-top: 10px;padding-bottom: 10px;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Filter" v-model="filterKey">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-search"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div v-if="showColumnPicker" style="padding-top: 10px;padding-bottom: 10px;float:right;">
                <div class="btn-group" :class="{'open' : columnMenuOpen}">
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
        <div class="col-sm-12">
            <table v-if="values.length > 0" class="table table-bordered table-hover table-condensed table-striped vue-table">
                <thead>
                <tr>
                    <th v-for="column in displayCols | filterBy true in 'visible'" @click="sortBy(column.title)"
                        track-by="$index"
                        :class="getClasses(column.title)">
                        {{ column.title | capitalize }}
                    </th>
                    <th colspan="2" class="is-icon"> Acciones </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="entry in filteredValues | orderBy sortKey sortOrders[sortKey]" track-by="$index">
                    <td v-for="column in displayCols | filterBy true in 'visible'" track-by="$index"
                        v-show="column.visible">
                        {{{ entry[column.title] | displayMedia }}}
                    </td>
                    <td class="is-icon" colspan="2">
                        <a class="btn btn-xs btn-info" href="#" @click.prevent="editItem(entry)">
                            <i class="fa fa-4 fa-pencil-square-o"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" href="#" @click.prevent="deleteItem(entry.id)">
                            <i class="fa fa-1 fa-trash-o"></i>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div v-else class="alert alert-info" role="alert">No hay nada todavía</div>
        </div>
    </div>

    <add-item-modal
        name="nombre"
        :show.sync="showModal"
        :action.sync="modalAction"
        :model.sync="selectedModel"
    >
</template>
<script>
    export default {
        name: "BootstrapTable",
        components: {},
        props: {
            columns: {
                type: Array,
            },
            values: {
                type: Array,
                twoWay: true,
            },
            sortable: {
                type: Boolean,
                required: false,
                default: true,
            },
            showColumnPicker: {
                type: Boolean,
                required: false,
                default: true,
            },
            endpoint: {
                type: String,
                required: true,
            },
        },
        data: function () {
            return {
                filteredSize: 0,
                filterKey: "",
                sortKey: "",
                sortOrders: {},
                columnMenuOpen: false,
                displayCols: [],
                showModal: false,
                showFilter: false,
                selectedModel: {},
                modalAction: CREATE_BASE_URL,
            };
        },
        created: function() {
        },
        ready: function () {
            this.fetchTableValues();
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
            fetchTableValues: function() {
                this.$http.get(this.endpoint).then(function(response) {
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
            sortBy: function (key) {
                if (this.sortable) {
                    var self = this;
                    this.sortKey = key;
                    this.columns.forEach(function (column) {
                        if (column !== key) {
                            self.sortOrders[column] = 0;
                        }
                    });
                    if (this.sortOrders[key] === 0) {
                        this.sortOrders[key] = 1;
                    } else {
                        this.sortOrders[key] = this.sortOrders[key] * -1;
                    }
                }
            },
            getClasses: function (key) {
                var classes = [];
                if (this.sortable) {
                    classes.push("arrow");
                    if (this.sortKey === key) {
                        classes.push("active");
                    }
                    if (this.sortOrders[key] === 1) {
                        classes.push("asc");
                    } else if (this.sortOrders[key] === -1) {
                        classes.push("dsc");
                    }
                }
                return classes;
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
            togglePicker: function() {
                this.showColumnPicker = !this.showColumnPicker;
            },
            deleteItem: function(id) {
                this.$http.get(DELETE_BASE_URL + '/' + id).then(function(response) {
                    this.values = this.values.filter(function(item) {
                        return item.id !== id;
                    });
                });
            },
            editItem: function(entry) {
                this.showModal = true;
                this.modalAction = EDIT_BASE_URL + '/' + entry.id;
                this.selectedModel = entry;
            }
        },
        events: {
            formSubmitted: function(response) {
                // Remove old one (if exists)
                this.values = this.values.filter(function(item) {
                    return item.id !== response.id;
                });
                // Add it
                this.values.push(response);
                console.log('BootstrapTable event recv');
                console.log(response);
                return true;
            },
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
