
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
// require('./bus')
require('./extras');

const bus = new Vue() // Single event hub

// Distribute to components using global mixin
Vue.mixin({
    data: function () {
        return {
            bus: bus
        }
    }
})

require('./admin');

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
