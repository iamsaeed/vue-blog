require('./bootstrap');
window.Vue = require('vue');

Vue.component('Categories', require('./components/categories').default);
Vue.component('Computed', require('./components/Computed').default);
Vue.component('ConfirmationBox', require('./components/Confirmation').default);
Vue.component('Messages', require('./components/Messages').default);

const app = new Vue({
    el: '#app',
    data(){
        return {

        }
    },
    created() {

    },
    methods : {

    }
});

// // Add a request interceptor
// axios.interceptors.request.use(function (config) {
//     // Do something before request is sent
//     loader = true
//     return config;
// });
//
// // Add a response interceptor
// axios.interceptors.response.use(function (response) {
//     // Any status code that lie within the range of 2xx cause this function to trigger
//     // Do something with response data
//     loader = false;
//     return response;
// });
