
window._ = require('lodash');
window.Cookies = require('js-cookie');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.Vue = require('vue');

window.Vue.axios = require('axios');

window.Vue.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

// Vue.http.interceptors.push((request, next) => {
    // request.headers.set('X-XSRF-TOKEN', Cookies.get('XSRF-TOKEN'));
    // request.headers.set('X-CSRF-TOKEN', decodeURIComponent(Cookies.get('XSRF-TOKEN')));
    //  next();
// });

let token = document.head.querySelector('meta[name="_token"]');

if (token) {
    window.Vue.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Dropzone = require("dropzone");
