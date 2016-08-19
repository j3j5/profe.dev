
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

 Vue.filter('displayThumb', function(value) {
     if(String(value).match(/.*\.(png|jpg|gif)(\?.*)?$/i)) {
         return '<img src="' + IMG_BASE_URL + value + '" class="admin-thumb img-responsive">';
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
   data: {
        showFilter: true,
        showPicker: true,
   },
   methods: {
        addItem: function() {
            var self = this;
            var item = {};
            this.values.push(item);
        },
        toggleFilter: function() {
            this.showFilter = !this.showFilter;
        },
        togglePicker: function() {
            this.showPicker = !this.showPicker;
        }
    },
 });
