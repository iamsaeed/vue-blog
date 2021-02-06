require('./bootstrap');
window.Vue = require('vue');

Vue.component('CategoriesIndex', require('./components/categories/index').default);

const app = new Vue({
    el: '#app',
});
