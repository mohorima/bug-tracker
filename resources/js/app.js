require("./bootstrap");

window.Vue = require("vue").default;

//VueRouter

import VueRouter from "vue-router";
Vue.use(VueRouter);

let routes = [
    {
        path: "/dashboard",
        component: require("./components/Dashboard.vue").default,
    },
    {
        path: "/issue",
        component: require("./components/Issue.vue").default,
    },
    {
        path: "/project",
        component: require("./components/Project.vue").default,
    },
    {
        path: "/task",
        component: require("./components/Task.vue").default,
    },
];

const router = new VueRouter({
    mode: "history",
    linkActiveClass: "active",
    routes,
});

// Register Vue components.

//Fire is a new instance of vue which will be used as a bus
window.Fire = new Vue();

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

// Create a fresh Vue application instance and attach it to the page

const app = new Vue({
    el: "#app",
    router,
});

// APPLICATION CODE

//confirm delete
$("#delete").on("click", function () {
    return confirm("Are you sure you want to delete?");
});

//check all checkboxes
$(".container .toggle-button").on("click", function () {
    $('.container input[type="checkbox"]').prop("checked", this.checked);
});

//SIDE-NAV
/* Set the width of the side navigation to 300px and the left margin of the page content to 300px */
$("#hamburger").on("click", function () {
    $("#mySidenav").css({
        width: "300px",
    });
    $("#main").css({
        "margin-left": "300px",
    });
});

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
$("#closesidenav").on("click", function () {
    $("#mySidenav").css({
        width: "0",
    });
    $("#main").css({
        "margin-left": "0",
    });
});
