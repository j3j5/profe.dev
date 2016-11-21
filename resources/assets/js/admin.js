import AdminTable from './admin/components/AdminTable.vue'
import AdminValues from './admin/components/AdminValues.vue'
import AdminGallery from './admin/components/AdminGallery.vue'
import AdminGalleryImages from './admin/components/AdminGalleryImages.vue'
import Modal from './components/Modal.vue'
import Notification from './components/Notification.vue';
import AddPropuestaModal from './admin/modals/PropuestasModal.vue';

Vue.component('AdminTable', AdminTable);
Vue.component('AdminValues', AdminValues);
Vue.component('Modal', Modal);
Vue.component('AdminGallery', AdminGallery);
Vue.component('AdminGalleryImages', AdminGalleryImages);
Vue.component('notification', Notification);

Vue.component('AddPropuestaModal', AddPropuestaModal);

// require('./admin/modals/ImagesModal.js')
// require('./admin/modals/ConceptosModal.js')
// require('./admin/modals/MegustaModal.js')
// require('./admin/modals/ExamenModal.js')

var admin = new Vue({
    el: '#admin',
    data: function() {
        return {
            selectedModel: {},
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
        editItem: function(data) {
            this.selectedModel = data.entry;
            this.modalAction = data.url + this.selectedModel.id;
            this.showModal = true;
        },
        itemCreated: function(item) {
            // this.$broadcast('itemCreated', item);
            this.closeAndResetModal();
            var notification = {message: 'Yaaay, ¡el nuevo elemento se guardó correctamente!', type: 'info'};
            this.openNotificationWithType(notification);
        },
        itemEdited: function(item) {
            var info = {old: this.selectedModel, new: item};
            this.$broadcast('itemEdited', info);
            this.closeAndResetModal();
            var notification = {message: 'Yaaay, ¡los cambios se guardaron correctamente!', type: 'info'};
            this.openNotificationWithType(notification);
        },
    },
 });
