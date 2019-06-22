/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueStripeCheckout from 'vue-stripe-checkout';

Vue.use(VueStripeCheckout, 'pk_test_MIcCHhBXA9QDLLZXnGBLvVKM00X0XBmacd');
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

import User from './store/user.js';
import Items from './store/items.js';
import CSRF from './store/csrf.js';
import Messages from './store/messages.js';
import Home from './components/app/Home.vue';
import Cart from './components/app/Cart.vue';
import Profile from './components/app/Profile.vue';
import ProfileUpdate from './components/app/ProfileUpdate.vue';
import ProfileDelete from './components/app/ProfileDelete.vue';
import Success from './components/app/Success.vue';
import ProfileOrders from './components/app/ProfileOrders.vue';

const routes = [
  {
    name: 'home',
    path: '/',
    component: Home
  },
  {
    name: 'cart',
    path: '/cart',
    component: Cart,
  },
  {
    name: 'success',
    path: '/success',
    component: Success,
  },
  {
    name: 'profile',
    path: '/profile',
    component: Profile,
    children: [
      {
        name: 'profileUpdate',
        path: '/profile/update',
        component: ProfileUpdate
      },
      {
        name: 'profileDelete',
        path: '/profile/delete',
        component: ProfileDelete
      },
      {
        name: 'profileOrders',
        path: '/profile/orders',
        component: ProfileOrders
      }
    ]
  },

]

class Store {
  constructor(obj) {
    this.hydrateStore(obj)
  }

  hydrateStore(obj) {
      for (let k in obj) {
          this[k] = {
              state: Vue.observable(obj[k].state || {}),
              getters: obj[k].getters || {},
              mutations:obj[k].mutations || {}
          };
      }
  }
}

const customStore = new Store({
  user: User,
  items: Items,
  csrf: CSRF,
  messages: Messages
});

Vue.prototype.$store = customStore;

Vue.component('pizza-app', require('./components/app/App.vue').default);
const router = new VueRouter({ mode: 'history', routes });
const app = new Vue({
    el: '#app',
    router
});
