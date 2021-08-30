require("./bootstrap");

window.Vue = require("vue").default;

//VueRouter

import VueRouter from "vue-router";
Vue.use(VueRouter);

let routes = [
    {
        path: "/dashboard",
        component: require("./components/Dashboard.vue").default,
        meta: {
            title: "Dashboard",
        },
    },
    {
        path: "/client",
        component: require("./components/Client.vue").default,
        meta: {
            title: "Clients",
        },
    },
    {
        path: "/invoice",
        component: require("./components/Invoice.vue").default,
        meta: {
            title: "Invoices",
        },
    },
    {
        path: "/issue",
        component: require("./components/Issue.vue").default,
        meta: {
            title: "Issues",
        },
    },
    {
        path: "/project",
        component: require("./components/Project.vue").default,
        meta: {
            title: "Projects",
        },
    },
    {
        path: "/permission",
        component: require("./components/Permission.vue").default,
        meta: {
            title: "Permissions",
        },
    },
    {
        path: "/role",
        component: require("./components/Role.vue").default,
        meta: {
            title: "Roles",
        },
    },
    {
        path: "/task",
        component: require("./components/Task.vue").default,
        meta: {
            title: "Tasks",
        },
    },
    {
        path: "/user",
        component: require("./components/User.vue").default,
        meta: {
            title: "Users",
        },
    },
];

const router = new VueRouter({
    mode: "history",
    linkActiveClass: "active",
    routes,
});

router.beforeEach((to, from, next) => {
    window.document.title =
        to.meta && to.meta.title ? to.meta.title : "BugTrack";
    next();
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
