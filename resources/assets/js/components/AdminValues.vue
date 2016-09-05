<template>
    <table class="table table-bordered table-hover table-striped admin-table">
        <thead>
        <tr>
            <th v-for="column in columns | filterBy true in 'visible'"
                @click="sortBy(column.title)"
                track-by="$index"
                :class="getClasses(column.title)">
                {{ column.title | capitalize }}
            </th>
            <th colspan="2" class="is-icon"> Acciones </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="entry in filteredValues | orderBy sortKey sortOrders[sortKey]" track-by="id" @click="editItem(entry)">
            <td v-for="column in columns | filterBy true in 'visible'" track-by="id"
                v-show="column.visible">
                {{{ entry[column.title] | displayMedia }}}
            </td>
            <td class="is-icon" colspan="2">
                <a class="btn btn-sm btn-info" href="#" @click.prevent="editItem(entry)">
                    <i class="fa fa-4 fa-pencil-square-o"></i>
                </a>
                <a class="btn btn-sm btn-danger" href="#" @click.prevent="deleteItem(entry)">
                    <i class="fa fa-4 fa-trash-o"></i>
                </a>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: 'AdminValues',
    props: ['columns', 'values', 'sortKey', 'sortOrders', 'filterKey'],
    methods: {
        sortBy: function (key) {
            var self = this;
            this.sortKey = key;
            this.columns.forEach(function (column) {
                if (column.title !== key) {
                    self.sortOrders[column.title] = 0;
                }
            });
            if (this.sortOrders[key] === 0) {
                this.sortOrders[key] = 1;
            } else {
                this.sortOrders[key] = this.sortOrders[key] * -1;
            }
        },
        getClasses: function (key) {
            var classes = [];
            classes.push("arrow");
            if (this.sortKey === key) {
                classes.push("active");
            }
            if (this.sortOrders[key] === 1) {
                classes.push("asc");
            } else if (this.sortOrders[key] === -1) {
                classes.push("dsc");
            }
            return classes;
        },
        deleteItem: function(entry) {
            this.$dispatch('removeItem', entry);
        },
        editItem: function(entry) {
            var data = {entry: entry, url: this.$parent.updateModelUrl};
            this.$dispatch("editItem", data);
        },
    },
    computed: {
        filteredValues: function () {
            var result = this.$options.filters.filterBy(this.values, this.filterKey);
            result = this.$options.filters.orderBy(result, this.sortKey, this.sortOrders[this.sortKey]);
            this.filteredSize = result.length;
            return result;
        },
    },
}
</script>

<style>
    .admin-table .arrow {
        opacity: 1;
        position: relative;
    }
    .admin-table .arrow:after {
        position: absolute;
        bottom: 8px;
        right: 8px;
        display: block;
        font-family: 'Glyphicons Halflings';
        content: "\e150";
    }
    .admin-table .arrow.asc:after {
        content: "\e155";
    }
    .admin-table .arrow.dsc:after {
        content: "\e156";
    }

    .admin-table td {
        /*width: 100px;*/
        max-width: 500px;
    }
</style>
