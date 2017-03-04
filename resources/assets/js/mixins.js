/**
 * Add mixin to open notifications
 */
const NotificationComponent = Vue.extend(Notification);

Vue.mixin({
    methods: {
        openNotification: (propsData = {
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
        },
        getRandomInt: function (min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min)) + min;
        },
    },
})
