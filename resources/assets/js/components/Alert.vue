<template>
    <modal :show.sync =
    <div class="alert alert-dismissable alert-warning clearfix">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p>{{ message }}</p>
    </div>
</template>

<script>

    export default {
        data: function() {
            return {
                alertMessage: "",
            }
        },
        props: {
            'message': {
                type: String,
                required: true,
            }
        },
    }

</script>
