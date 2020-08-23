import Vue from 'vue';
import 'bootstrap';
import axios from 'axios';

Vue.use(require('vue-resource'));
Vue.component('listing-log', require('./components/WithoutPagination.vue'));
Vue.component('listing-log-with-pagination', require('./components/WithPagination.vue'));
Vue.component('log-table-body', require('./components/Table.vue'));


Vue.component('pagination', require('laravel-vue-pagination'));
axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};
const app = new Vue({
    el: '#app',
});
