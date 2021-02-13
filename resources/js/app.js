require('./bootstrap');
window.Vue = require('vue');

Vue.component('Categories', require('./components/categories').default);

const app = new Vue({
    el: '#app',
});
