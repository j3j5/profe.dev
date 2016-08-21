<template>
    <modal :show.sync="show" v-on:modal-closed="close">
        <div class="modal-header">
            <h2>Nuevo/a {{ name | capitalize}}</h2>
        </div>
        <form v-ajax method="POST" action="{{ action }}">
            <div class="form-group" v-for="(name, field) in fields">
                <label for="{{name}}" class="control-label">{{field.label | capitalize}}</label>
                <input class="form-control" name="{{ name }}" type="{{field.type}}" id="{{ name }}" value="{{ getInputValue(name) }}">
            </div>
            <div class="modal-footer text-right">
                <button type='submit' class="btn btn-info">
                    Guardar
                </button>
                <button class="btn btn-danger"
                    @click.stop.prevent="close">
                    Cancelar
                </button>
            </div>
        </form>
    </modal>
</template>

<script>
export default {
    name: "AddItemModal",
    props: {
        show: {
            type: Boolean,
            required: true,
            twoWay: true
        },
        name: {
            type: String,
            required: true,
        },
        action: {
            type: String,
            required: true,
        },
        model: {
            type: Object,
        },
    },
    data: function() {
        return {
            fields: JSON.parse(FORM),
        };
    },
    methods: {
        getInputValue: function(name) {
            if(this.model.hasOwnProperty(name)){
                return this.model[name];
            }
            return '';
        },
        close: function() {
            this.show = false;
            this.model = {};
            this.action = CREATE_BASE_URL;
        },
    },
    events: {
        formSubmitted: function(response) {
            console.log('modal event recv');
            this.close();
            return true;
        },
    },
    created: function() {
    }
}
</script>

<style>
.modal-header h3 {
    margin-top: 0;
    /*color: #42b983;*/
}

.modal-body {
    margin: 20px 0;
}

.modal-default-button {
    float: right;
}
</style>
