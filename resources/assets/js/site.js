
import Modal from './components/Modal.vue'
import Notification from './components/Notification.vue';

Vue.component('Modal', Modal);
Vue.component('notification', Notification);

new Vue({
    el: '#crosswords',
    data: function() {
        return {
            modalAction: '',
            showModal: false,
        };
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
