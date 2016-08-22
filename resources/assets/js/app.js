
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
import AddItemModal from './components/AddItemModal.vue'
import Alert from './components/Alert.vue'


Vue.component('AdminTable', AdminTable);
Vue.component('AdminValues', AdminValues);
Vue.component('Modal', Modal);
Vue.component('AddItemModal', AddItemModal);
Vue.component('Alert', Alert);

require('./components/PropuestasModal.js')

new Vue({
    el: '#admin',
    components: {
        AdminTable,
        AddItemModal
   },
   data: function() {
       return {
           endpoint: TABLE_ENDPOINT,
           tableColumns: [],
           tableValues: [],
           showModal: false,
           modalAction: CREATE_BASE_URL,
           selectedModel: {},
           showAlert: false
       };
   },
   ready: function () {
       this.fetchTable();
   },
   methods: {
       fetchTable: function() {
           this.$http.get(this.endpoint).then(function(response) {
               this.tableColumns = response.data.columns;
               this.tableValues = response.data.values;
           }).bind(this);
       },
       closeAndResetModal: function() {
           this.selectedModel = {};
           this.showModal = false;
           this.modalAction = CREATE_BASE_URL;
       }
   },
   events: {
       editItem: function(item) {
           this.selectedModel = item;
           this.showModal = true;
           this.modalAction = EDIT_BASE_URL + '/' + this.selectedModel.id;
       },
       removeItem: function(item) {
           if(confirm("Estás a punto de borrar " + item.nombre + ".\n¿Estás segura de que deseas eliminarlo/a?\nNo se podrá recuperar.")) {
               this.tableValues.$remove(item);
           }
       },
       itemCreated: function(item) {
           this.tableValues.push(item);
           this.closeAndResetModal();
       },
       itemEdited: function(item) {
           this.tableValues = this.tableValues.filter(function(entry) {
               return item.id !== entry.id;
           });
           this.tableValues.push(item);

           this.closeAndResetModal();
       },
   },
 });
