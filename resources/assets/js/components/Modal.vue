<template>
    <transition name="modal">
        <div class="modal-mask" v-show="show" @click="close">
            <div class="modal-wrapper">
                <div class="modal-container" @click.stop>
                    <button @click="close" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <slot name="modal-stuff"></slot>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "Modal",
    props: {

    },
    data: function() {
        return {
            show: false,
        };
    },
    methods: {
        showIt: function() {
            this.show = true;
        },
        close: function() {
            this.show = false;
            this.bus.$emit('resetModal');
        },
    },
    created: function() {
        var self = this;
        this.bus.$on('openModal', function (data) {
            self.showIt();
        });
        this.bus.$on('closeModal', function () {
            self.close();
        });
        this.bus.$on('itemCreated', function () {
            self.close();
        });
        this.bus.$on('itemEdited', function () {
            self.close();
        });
        this.bus.$on('editItem', function (data) {
            self.showIt();
        });
    },
    mounted: function () {
        document.addEventListener("keydown", (e) => {
            if (this.show && e.keyCode == 27) {
                this.close();
            }
        });
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
