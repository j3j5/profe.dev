<template>
    <table class="table admin-table">
        <thead>
        <tr>
            <th v-for="column in visibleColumns"
                @click="sortBy(column.title)"
                :class="getClasses(column.title)">
                {{ capitalize(column.title) }}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="entry in filteredValues" track-by="id" @click="editItem(entry)">
            <td v-for="column in visibleColumns"
                v-show="column.visible">
                <div v-html="displayMedia(entry[column.title])"></div>
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
    props: ['columns', 'values', 'sortKey', 'sortOrders', 'filterKey', 'updateModelUrl'],
    data: function() {
        return {
            sortingKey: this.sortKey,
        };
    },
    methods: {
        sortBy: function (key) {
            var self = this;
            this.sortingKey = key;
            this.columns.forEach(function (column) {
                if (column.title !== key) {
                    self.sortOrders[column.title] = 0;
                }
            });
            switch (this.sortOrders[key]) {
                case 'asc':
                    this.sortOrders[key] = 'desc';
                    break;
                case 'desc':
                    this.sortOrders[key] = 'asc';
                    break;
                case 0:
                default:
                    this.sortOrders[key] = 'asc'
                    break;

            }
        },
        getClasses: function (key) {
            var classes = [];
            classes.push("arrow");
            if (this.sortingKey === key) {
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
            this.bus.$emit('removeItem', entry);
        },
        editItem: function(entry) {
            var data = {entry: entry, url: this.updateModelUrl + entry.id};
            this.bus.$emit('editItem', data);
        },
        capitalize: function(word) {
            return word[0].toUpperCase() + word.slice(1);
        },
        displayMedia: function(value) {
            if(String(value).match(/.*\.(png|jpe?g|gif)(\?.*)?$/i)) {
                return '<img src="' + IMG_BASE_URL + value + '" alt="' + value + '" class="admin-thumb img-responsive">';
            } else if(String(value).match(/.*\.(pdf|doc|docx)(\?.*)?$/i)) {
                return '<a target="_blank" href="' + FILES_BASE_URL + value + '" class="">' + value + '</a>';
            } else {
                return value;
            }
        },
    },
    computed: {
        visibleColumns: function() {
            return this.columns.filter(function(column) {
                return column.visible;
            });
        },

        filteredValues: function () {
            var that = this;
            var search = new RegExp(this.filterKey, 'i');

            var result = this.values.filter(function(value) {
                var keys = Object.keys(value);
                for (var i = 0; i < keys.length; i++) {
                    if(String(value[keys[i]]).match(search)) {
                        return value;
                    }
                }
            });

            this.filteredSize = result.length;
            return _.orderBy(result, this.sortingKey, this.sortOrders[this.sortingKey]);
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
