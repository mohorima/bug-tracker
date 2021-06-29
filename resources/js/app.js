/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


// APPLICATION CODE

//confirm delete
$("#delete").on("click", function () {
    return confirm("Are you sure you want to delete?");
});

//check all checkboxes
$('.container .toggle-button').on("click", function () {
    $('.container input[type="checkbox"]').prop('checked', this.checked)
});

//SIDE-NAV
/* Set the width of the side navigation to 300px and the left margin of the page content to 300px */
$("#hamburger").on("click", function () {
    $("#mySidenav").css({
        "width": "300px"
    });
    $("#main").css({
        "margin-left": "300px"
    });
});

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
$("#closesidenav").on("click", function () {
    $("#mySidenav").css({
        "width": "0"
    });
    $("#main").css({
        "margin-left": "0"
    });
});
