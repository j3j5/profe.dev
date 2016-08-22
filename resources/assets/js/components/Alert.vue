<template>
    <modal :show.sync="show"
    <div class="">
        <button @click="no" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p>{{ message }}</p>
        <button @click="yes" type="btn btn-info">Yes</button>
        <button @click="no" type="btn btn-danger">No</button>
    </div>
</template>

<script>

    export default {
        name: "Alert",
        props: {
            show: {
                type: Boolean,
                required: true,
            },
            message: {
                type: String,
                required: true,
            },
        },
        methods: {
            yes: function() {
                this.$dispatch("alertYes");
                this.close();
            },
            no: function() {
                this.$dispatch("alertNo");
                this.close();
            },
            close: function() {
                this.show = false;
            }
        },
    }

</script>
