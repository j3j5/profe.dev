
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./extras');



import BootstrapTable from './components/BootstrapTable.vue'
import Modal from './components/Modal.vue'
import AddItemModal from './components/AddItemModal.vue'
import Alert from './components/Alert.vue'


Vue.component('BootstrapTable', BootstrapTable);
Vue.component('Modal', Modal);
Vue.component('AddItemModal', AddItemModal);
Vue.component('alert', Alert);

new Vue({
    el: '#admin',
    components: {
        BootstrapTable,
        AddItemModal,
   },
   data: function() {
       return {
           tableColumns: [],
           tableValues: [],
       };
   },
   methods: {

   }
 });
