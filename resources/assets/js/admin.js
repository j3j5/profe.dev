import AdminTable from './admin/components/AdminTable.vue'
import AdminValues from './admin/components/AdminValues.vue'

import AdminGallery from './admin/components/AdminGallery.vue'
import AdminGalleryImages from './admin/components/AdminGalleryImages.vue'

// import Notification from './components/Notification.vue';

import Modal from './components/Modal.vue'
import AddPropuestaModal from './admin/modals/PropuestasModal.vue';
import AddImageModal from './admin/modals/ImagesModal.vue';
import AddConceptoModal from './admin/modals/ConceptosModal.vue';
import AddMegustaModal from './admin/modals/MegustaModal.vue';
import AddExamenModal from './admin/modals/ExamenModal.vue';

Vue.component('AdminTable', AdminTable);
Vue.component('AdminValues', AdminValues);
Vue.component('AdminGallery', AdminGallery);
Vue.component('AdminGalleryImages', AdminGalleryImages);
// Vue.component('notification', Notification);

Vue.component('Modal', Modal);
Vue.component('AddPropuestaModal', AddPropuestaModal);
Vue.component('AddImageModal', AddImageModal);
Vue.component('AddConceptoModal', AddConceptoModal);
Vue.component('AddMegustaModal', AddMegustaModal);
Vue.component('AddExamenModal', AddExamenModal);

var admin = new Vue({
    el: '#admin',
    data() {
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
            // this.openNotification({
            //     title: noti.title,
            //     message: noti.message,
            //     type: noti.type
            // });
        },
    },
 });
