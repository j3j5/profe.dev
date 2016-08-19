
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
 // import Vue from `vue`

 Vue.filter('displayMedia', function(value) {

     if(String(value).match(/.*\.(png|jpg|gif)(\?.*)?$/i)) {
         return '<img src="' + IMG_BASE_URL + value + '" class="admin-thumb img-responsive">';
     } else if(String(value).match(/.*\.(pdf|doc|docx)(\?.*)?$/i)) {
         return '<a href="' + FILES_BASE_URL + value + '" class="">' + value + '</a>';
     } else {
         return value;
     }
 });

import BootstrapTable from './components/BootstrapTable.vue'
// import myrow from './components/Row.vue'

new Vue({
   el: 'body',
   components: {
        BootstrapTable: BootstrapTable
   },
   methods: {
        addItem: function() {
            var self = this;
            var item = {};
            this.values.push(item);
        }
    },
 });
