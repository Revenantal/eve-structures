
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.fullCalendar = require('fullcalendar');

// Vue
window.Vue = require('vue');
Vue.component('Countdown', require('./components/Countdown.vue'));
const app = new Vue({
    el: '#app'
});