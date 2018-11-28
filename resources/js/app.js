
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Model from './components/Model'
import Product from './components/Product'
import Editname from './components/Editname'
import Add from './components/Add'
import Edit from './components/Edit'
import Deleteprod from './components/Deleteprod'
import Removeprod from './components/Removeprod'

require('axios-debug')(axios)
window.Vue = Vue
Vue.use(VueAxios, axios)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('model', Model)
Vue.component('product', Product)
Vue.component('editname', Editname)
Vue.component('add', Add)
Vue.component('edit', Edit)
Vue.component('deleteprod', Deleteprod)
Vue.component('removeprod', Removeprod)
axios.defaults.baseURL = 'http://test.for'
// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
