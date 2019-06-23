/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Dashboard from './components/admin/Dashboard.vue';
import CreatePizza from './components/admin/CreatePizza.vue';
import EditPizza from './components/admin/EditPizza.vue';
import Orders from './components/admin/Orders.vue';
import Order from './components/admin/Order.vue';
import PageNotFound from './components/PageNotFound.vue';

const routes = [
  {
      name: 'home',
      path: '/admin/',
      component: Dashboard
  },
  {
      name: 'create',
      path: '/admin/create',
      component: CreatePizza
  },
  {
      name: 'edit',
      path: '/admin/pizzas/:id',
      component: EditPizza
  },
  {
      name: 'orders',
      path: '/admin/orders',
      component: Orders
  },
  {
    name: 'order',
    path: '/admin/orders/:id',
    component: Order
  },
  { 
    path: "/admin/*", 
    component: PageNotFound 
  }
]

Vue.component('admin-panel', require('./components/admin/AdminPanel.vue').default);
const router = new VueRouter({ mode: 'history', routes: routes });
const app = new Vue({
    el: '#adminPanel',
    router
});
