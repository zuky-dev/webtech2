const defPath = '/';

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueBreadcrumbs from 'vue2-breadcrumbs';
import VueCookies from 'vue-cookies';
import App from '../components/App.vue';

//routes
import Home from '../components/Home.vue';
import E1 from '../components/E1.vue';
import E2 from '../components/E2.vue';
import E3 from '../components/E3.vue';

Vue.use(VueRouter);
Vue.use(VueBreadcrumbs);
Vue.use(VueCookies);

const routes = [
  {
    path: defPath,
    component: Home,
    name: 'Domov',
    meta:{
      sk: 'Domov',
      en: 'Home',
      users: 'all'
    }
  },
  {
    path: defPath + 'e1',
    component: E1,
    name: 'Uloha1',
    meta: {
      sk: 'Uloha 1',
      en: 'Exercise 1',
      users: 'all'
    }
  },
  {
    path: defPath + 'e2',
    component: E2,
    name: 'Uloha2',
    meta: {
      sk: 'Uloha 2',
      en: 'Exercise 2',
      users: 'all'
    }
  },
  {
    path: defPath + 'e3',
    component: E3,
    name: 'Uloha3',
    meta: {
      sk: 'Uloha 3',
      en: 'Exercise 3',
      users: 'admin'
    }
  },
];

$cookies.config('30d');

const router = new VueRouter({
  routes,
  mode: 'history'
});

new Vue({
  el: '#app',
  router,
  render: h => h(App)
});
