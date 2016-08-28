
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./extras');


import AdminTable from './components/AdminTable.vue'
import AdminValues from './components/AdminValues.vue'
import Modal from './components/Modal.vue'
import Alert from './components/Alert.vue'
import Dropzone from './components/Dropzone.vue';

Vue.component('AdminTable', AdminTable);
Vue.component('AdminValues', AdminValues);
Vue.component('Modal', Modal);
Vue.component('Alert', Alert);
Vue.component('vue-dropzone', Dropzone);

require('./modals/PropuestasModal.js')
require('./modals/ImagesModal.js')

new Vue({
    el: '#admin',
    components: {
        AdminTable,
    },
    data: function() {
        return {
            selectedModel: {},
            modalAction: '',
            showModal: false,
        };
    },
    ready: function () {
    },
    methods: {
        closeAndResetModal: function() {
            this.selectedModel = {};
            this.showModal = false;
        }
    },
    events : {
        modalOpen: function(data) {
            this.showModal = true;
            this.modalAction = data.url;
        },
        modalClosed: function(data) {
            this.closeAndResetModal();
        },
        editItem: function(data) {
            this.selectedModel = data.entry;
            this.modalAction = data.url + this.selectedModel.id;
            this.showModal = true;
        },
    },
 });
