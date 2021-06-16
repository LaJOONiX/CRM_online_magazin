/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
//
// window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from './App.vue'
import Vue from 'vue'
import Cookies from 'js-cookie'
import VueMeta from 'vue-meta'
import Vuelidate from 'vuelidate'
import Paginate from 'vuejs-paginate'
import messagePlugin from './utils/message.plugin'
import titlePlugin from './utils/title.plugin'
import dateFilter from './filters/date.filter'
import currencyFilter from './filters/currency.filter'
import localizeFilter from './filters/localize.filter'
import tooltipDirective from './directives/tooltip.directive'
import add_fixed from './components/add_fixed'
import m_create from './components/m_create'
import loader from './components/app/Loader'
import 'materialize-css/dist/js/materialize.min'
import store from './store'
import router from "./router"
import axios from 'axios'
import pagination from 'laravel-vue-pagination'

Vue.prototype.$Cookies = Cookies;
Vue.prototype.$initials = function (str) {
    return str.split(/\s+/).map((w,i) => i ? w.substring(0,1).toUpperCase() + '.' : w).join(' ')
}

Vue.config.productionTip = false


Vue.use(VueMeta)
Vue.use(Vuelidate)
Vue.use(titlePlugin)
Vue.use(messagePlugin)

Vue.filter('date', dateFilter)
Vue.filter('currency', currencyFilter)
Vue.filter('localize', localizeFilter)
Vue.directive('tooltip', tooltipDirective)
Vue.component('Loader', loader)
Vue.component('Paginate', Paginate)
Vue.component('add_fixed', add_fixed)
Vue.component('m_create', m_create)
Vue.component('pagination', pagination);

const token = localStorage.getItem('user-token')
if (token) {
  axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

const app = new Vue({
    el: '#app',
    store,
    router,
    render: h => h(App),
})
