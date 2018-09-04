require('./bootstrap');

import VueCkeditor from 'vue-ckeditor2';
import BootstrapVue from 'bootstrap-vue';

import 'bootstrap-vue/dist/bootstrap-vue.css';
window.Vue = require('vue');
Vue.use(BootstrapVue);
Vue.use(VueCkeditor);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('admin-artiste', require('./components/Artiste/adminArtiste'));
Vue.component('forms-artiste', require('./components/Artiste/FormsArtiste'));
Vue.component('tab-artiste', require('./components/Artiste/TabsArtiste'));
Vue.component('api-artiste', require('./components/Artiste/apiArtiste'));

const app = new Vue({
	el: '#app'
});
