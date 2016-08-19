<template>
    <tr v-for="row in rows.data">
        <td class="admin-row" v-for="column in columns">
            <img v-if="isImage(column)" class="admin-thumb" src="/uploads/{{ row[column] }}">
            <span v-else>{{row[column]}}</span>
        </td>

        <td class="admin-row text-right">
            <div class="btn-group">
                <a class="btn btn-xs btn-info" href="#edit">
                    <i class="fa fa-4 fa-pencil-square-o"></i>
                </a>
                <a class="btn btn-xs btn-danger" onclick="return confirm('confirmar?')" href="#delete">
                    <i class="fa fa-1 fa-trash-o"></i>
                </a>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['rows', 'columns'],

    methods: {
        isImage: function(column) {
            return column == 'thumbnail';
        }
    },

    created() {
        this.rows = JSON.parse(this.rows);
        this.columns = JSON.parse(this.columns);
    },
    ready() {
        console.log(this.rows);
        console.log(this.columns);
    }
};
</script>
