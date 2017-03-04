
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */


import Xwords from './crosswords/xwords.vue'

import Modal from './components/Modal.vue'
import Notification from './components/Notification.vue';

Vue.component('Modal', Modal);
Vue.component('notification', Notification);
Vue.component('Xwords', Xwords);

require('./mixins')

new Vue({
    el: '#app',
    data: function() {
        return {
            modalAction: '',
            showModal: false,
        };
    },
    created: function() {
        console.log('app.created');
    },
    methods: {
        closeAndResetModal: function() {
            this.selectedModel = {};
            this.showModal = false;
        },
        openNotificationWithType (noti) {
            openNotification({
                title: noti.title,
                message: noti.message,
                type: noti.type
            });
        },
    },
    events : {
        closeModal: function(data) {
            this.closeAndResetModal();
        },
    },
 });
