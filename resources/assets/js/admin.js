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
    created: function() {
        var self = this;
        this.bus.$on('itemCreated', function (data) {
            var notification = {message: 'Yaaay, ¡el nuevo elemento se guardó correctamente!', type: 'info'};
            self.openNotificationWithType(notification);
        });
        this.bus.$on('itemEdited', function (data) {
            var notification = {message: 'Yaaay, ¡los cambios se guardaron correctamente!', type: 'info'};
            self.openNotificationWithType(notification);
        });
    },
    methods: {
        openNotificationWithType (noti) {
            this.openNotification({
                title: noti.title,
                message: noti.message,
                type: noti.type
            });
        },
    },
 });
