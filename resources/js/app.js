
require('./bootstrap');

window.Vue = require('vue').default;

import router from './router.js';

Vue.component('menu-bar', require('./components/MenuBar.vue').default);
Vue.component('home-page', require('./components/Home.vue').default);
Vue.component('product-home-page', require('./components/ProductHome.vue').default);
Vue.component('product-detail-page', require('./components/ProductDetail.vue').default);
Vue.component('about-page', require('./components/About.vue').default);
Vue.component('register-page', require('./components/Register.vue').default);
Vue.component('login-page', require('./components/Login.vue').default);
Vue.component('profile-page', require('./components/Profile.vue').default);

Vue.component('product-component', require('./components/Products/ProductComponent.vue').default);



const app = new Vue({
    el: '#app',
    router,
});
