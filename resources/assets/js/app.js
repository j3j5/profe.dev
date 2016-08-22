
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
       }
   },
   events: {
       editItem: function(item) {
           console.log(item);
           this.showModal = true;
       }
   },
 });
