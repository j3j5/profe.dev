<template>
    <table class="table table-bordered table-hover table-condensed table-striped vue-table">
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
        <tr v-for="entry in values | orderBy sortKey sortOrders[sortKey]" track-by="id">
            <td v-for="column in columns | filterBy true in 'visible'" track-by="$index"
                v-show="column.visible">
                {{{ entry[column.title] | displayMedia }}}
            </td>
            <td class="is-icon" colspan="2">
                <a class="btn btn-xs btn-info" href="#" @click.prevent="editItem(entry)">
                    <i class="fa fa-4 fa-pencil-square-o"></i>
                </a>
                <a class="btn btn-xs btn-danger" href="#" @click.prevent="deleteItem(entry)">
                    <i class="fa fa-1 fa-trash-o"></i>
                </a>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: 'AdminValues',
    props: ['columns', 'values', 'sortKey', 'sortOrders'],
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
}
</script>

<style>
    .vue-table .arrow {
        opacity: 1;
        position: relative;
    }
    .vue-table .arrow:after {
        position: absolute;
        bottom: 8px;
        right: 8px;
        display: block;
        font-family: 'Glyphicons Halflings';
        content: "\e150";
    }
    .vue-table .arrow.asc:after {
        content: "\e155";
    }
    .vue-table .arrow.dsc:after {
        content: "\e156";
    }
</style>
