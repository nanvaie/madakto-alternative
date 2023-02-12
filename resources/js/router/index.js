import { createWebHistory, createRouter } from 'vue-router';

import Login from '../../vue/views/Login.vue';
import Register from '../../vue/views/Register.vue';
import Home from '../../vue/views/Home.vue';


const routes = [

    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/',
        name: 'home',
        component: Home,
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;
