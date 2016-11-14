<template>
    <table class="table admin-table">
        <thead>
        <tr>
            <th v-for="column in columns | filterBy true in 'visible'"
                @click="sortBy(column.title)"
                track-by="$index"
                :class="getClasses(column.title)">
                {{ column.title | capitalize }}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="entry in filteredValues | orderBy sortKey sortOrders[sortKey]" track-by="id" @click="editItem(entry)">
            <td v-for="column in columns | filterBy true in 'visible'"
                v-show="column.visible">
                {{{ entry[column.title] | displayMedia }}}
            </td>
            <td>
                <button class="btn btn-sm btn-danger" href="#" @click.stop="deleteItem(entry)">
                    <i class="fa fa-2x fa-trash-o"></i>
                </button>
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

<style lang="sass">
    .admin-table {

        thead {
            // background-color: rgba(255, 214, 175, 0.55);
            background-color: rgba(220, 236, 239, 0.55);
            border-top: 3px solid #ddd;
            border: 3px solid rgb(220, 236, 239);
            th {
                vertical-align: middle !important;
                font-size: 2em;
                font-weight: bold;
                text-align: center;
                min-width: 150px;
                border: 3px solid #ddd;
            }
        }



        td {
            max-width: 300px;
            font-size: 1.2em;
            text-align: center;
            vertical-align: middle !important;
            border: 3px solid #ddd !important;
        }

        tbody {
            tr:hover {
                background-color: rgba(249, 249, 249, 0.8);
            }
        }
        .admin-thumb {
            max-height: 90px;
            margin: auto;
        }

        .arrow {
            opacity: 1;
            position: relative;
        }
        .arrow:after {
            position: absolute;
            bottom: 8px;
            right: 8px;
            display: block;
            font-family: 'Glyphicons Halflings';
            content: "\e150";
        }
        .arrow.asc:after {
            content: "\e155";
        }
        .arrow.dsc:after {
            content: "\e156";
        }
    }
</style>
