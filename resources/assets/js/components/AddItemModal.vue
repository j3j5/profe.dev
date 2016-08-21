<template>
    <div class="modal-mask" v-show="show" transition="modal">
        <div class="modal-wrapper">
            <div class="modal-container">

                <h2>Nuevo/a {{ name | capitalize}}</h2>

                <form v-ajax method="POST" action="{{ action }}">
                    <div class="form-group" v-for="(name, field) in fields">
                        <label for="{{name}}" class="control-label">{{field.label | capitalize}}</label>
                        <input class="form-control" name="{{ name }}" type="{{field.type}}" id="{{ name }}" value="{{ getInputValue(name) }}">
                    </div>
                    <button type='submit' class="btn btn-info">
                        Guardar
                    </button>
                    <button class="btn btn-danger"
                        @click.stop.prevent="cancel">
                        Cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>
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
        cancel: function() {
            this.show = false;
            this.model = {};
            this.action = CREATE_BASE_URL;
        },
    },
    events: {
        formSubmitted: function(response) {
            console.log('modal event recv');
            this.model = {};
            this.show = false;
            return true;
        },
    },
    created: function() {
    }
}
</script>

<style>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    max-width: 66%;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
    font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body {
    margin: 20px 0;
}

.modal-default-button {
    float: right;
}

/*
 * the following styles are auto-applied to elements with
 * v-transition="modal" when their visiblity is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter, .modal-leave {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
