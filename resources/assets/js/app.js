/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../../node_modules/jquery/dist/jquery.js');
require('./bootstrap');
require('../AdminLTE/dist/js/adminlte.js');
require('../AdminLTE/bower_components/datatables_net/js/jquery.dataTables.js');
require('../AdminLTE/plugins/iCheck/icheck.js');


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});