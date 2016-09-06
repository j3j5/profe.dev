
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
import AdminGallery from './components/AdminGallery.vue'
import AdminGalleryImages from './components/AdminGalleryImages.vue'
import Dropzone from './components/Dropzone.vue';
import Notification from './components/Notification.vue';

Vue.component('AdminTable', AdminTable);
Vue.component('AdminValues', AdminValues);
Vue.component('Modal', Modal);
Vue.component('AdminGallery', AdminGallery);
Vue.component('AdminGalleryImages', AdminGalleryImages);
Vue.component('vue-dropzone', Dropzone);
Vue.component('notification', Notification);

require('./modals/PropuestasModal.js')
require('./modals/ImagesModal.js')
require('./modals/ConceptosModal.js')
require('./modals/MegustaModal.js')

new Vue({
    el: '#admin',
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
        openModal: function(data) {
            this.showModal = true;
            this.modalAction = data.url;
        },
        closeModal: function(data) {
            this.closeAndResetModal();
        },
        editItem: function(data) {
            this.selectedModel = data.entry;
            this.modalAction = data.url + this.selectedModel.id;
            this.showModal = true;
        },
        itemCreated: function(item) {
            this.$broadcast('itemCreated', item);
            this.closeAndResetModal();
            var notification = {message: 'Yaaay, ¡se guardó!', type: 'info'};
            this.openNotificationWithType(notification);
        },
        itemEdited: function(item) {
            var info = {old: this.selectedModel, new: item};
            this.$broadcast('itemEdited', info);
            this.closeAndResetModal();
            var notification = {message: 'Yaaay, ¡se guardó!', type: 'info'};
            this.openNotificationWithType(notification);
        },
    },
 });

const NotificationComponent = Vue.extend(Notification);

const openNotification = (propsData = {
  title: '',
  message: '',
  type: '',
  direction: '',
  duration: 4500,
  container: '.notifications'
}) => {
  return new NotificationComponent({
    el: document.createElement('div'),
    propsData
  })
};
