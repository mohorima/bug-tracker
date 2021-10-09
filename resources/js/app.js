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
        path: "/profile",
        component: require("./components/Profile.vue").default,
        meta: {
            title: "Your Profile",
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
        path: "/project/member/:projectId/:projectTitle",
        name: "project/member",
        component: require("./components/ProjectUser.vue").default,
        meta: {
            title: "Project Members",
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

let sidenav = document.querySelector(".sidenav");
let main = document.querySelector("#main");
let closebtn = document.querySelector(".closebtn");

closebtn.addEventListener("click", () => {
    sidenav.classList.toggle("minimize");
    main.classList.toggle("enlarge");
    closebtn.classList.toggle("rotate");
});

// While viewport is max 992px wide, minimize side-nav
const mediaQuery = window.matchMedia("(max-width: 992px)");

function handleViewportChange(e) {
    // Check if the media query is true
    if (e.matches) {
        sidenav.classList.toggle("minimize");
        main.classList.toggle("enlarge");
        closebtn.classList.toggle("rotate");
    }
}

// Register event listener
mediaQuery.addListener(handleViewportChange);
// Initial check
handleViewportChange(mediaQuery);
