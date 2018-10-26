
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
/**
 * packages
 */
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';

/**
 * components
 */
import MainComponent from './components/MainComponent';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter);
Vue.use(VueResource);

var router = new VueRouter({
   routes: [
       {
           path: '*',
           name: 'main',
           component: MainComponent
       }
   ]
});

Vue.component('main-component', require('./components/MainComponent.vue'));
Vue.component('categories-component', require('./components/CategoriesComponent.vue'));
Vue.component('items-component', require('./components/ItemsComponent.vue'));
Vue.component('tree-menu-component', require('./components/TreeMenuComponent.vue'));

const app = new Vue({
    el: '#app'
});
