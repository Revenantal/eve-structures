
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.fullCalendar = require('fullcalendar');
window.moment = require('moment');

// Vue
window.Vue = require('vue');
Vue.component('Countdown', require('./components/Countdown.vue'));
const app = new Vue({
    el: '#app'
});

$(function() {
    updateSystemTimes();
    updatePlayerCount();
    setColorDates();

    // Enable Tooltips
    $('[data-toggle="tooltip"]').tooltip()

    // Update Footer time every 5 seconds
    setInterval(function(){
        updateSystemTimes();
    }, 5000);

    function updateSystemTimes() {
        $('.evedatetime').html(moment().utc().format('HH:mm - DD/MM/YYYY'));
        $('.localdatetime').html(moment().format('HH:mm - DD/MM/YYYY (Z [GMT])'));
    }

    function updatePlayerCount() {
        $.ajax({
            url: "https://esi.tech.ccp.is/latest/status/",
        })
        .done(function( data ) {
            $('.playercount').html(data.players);
        });
    }

    function setColorDates() {
        var now = moment().utc();

        $('[data-color-date]').each(function() {
            var structureTime = moment($(this).data('color-date'));
            var days = structureTime.diff(now, 'days', true);
            var element = "text";

            // pre class, such as text or bg
            if ($(this).data('color-date-element')) {
                element = $(this).data('color-date-element');
            }

            // Set Colors
            if (days <= 1) {
                $(this).addClass(element + '-red');
            } else if (days <= 7) {
                $(this).addClass(element + '-yellow');
            }
        });

    }
});