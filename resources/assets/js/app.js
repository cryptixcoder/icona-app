
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('child-tow', require('./components/ChildTow.vue'));
Vue.component('tow-form', require('./components/TowForm.vue'));
Vue.component('invoice', require('./components/Invoice.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('photo', require('./components/Photo.vue'));
Vue.component('new-tow', require('./components/NewTow.vue'));
Vue.component('archive', require('./components/Archive.vue'));
Vue.component('release', require('./components/ReleaseComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
    	showTowModal: false
    },

    methods: {
    	closeTowModal(){
    		this.showTowModal = false;
    	}
    }
});
