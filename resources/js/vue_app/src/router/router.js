import { createRouter, createWebHistory } from "vue-router";
//layouts
import CardLayout from "@/layouts/CardLayout.vue";
import NavBarLayout from "@/layouts/NavBarLayout.vue";
//pages
import Login from "@/pages/auth/Login.vue";
import Register from "@/pages/auth/Register.vue";
import Dashboard from "@/pages/TaskList.vue";


const routes = [
    // {
    //     path: "/", //view inicial
    //     name: "login",
    //     component: Login,
    // },
    {
        path: "/", //view inicial
        component: CardLayout,
        children: [
            {
                path: "",
                name: "login",
                component: Login,
                meta: {
                    title: "Login",
                },
            },
            {
                path: "register",
                name: "register",
                component: Register,
                meta: {
                    title: "Registrar",
                },
            },
        ],
    },
    {
        path: "/dashboard",
        component: NavBarLayout,
        children: [
            {
                path: "",
                name: "dashboard",
                component: Dashboard,

            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory("/taskList/"),
    routes,
});

export default router;
