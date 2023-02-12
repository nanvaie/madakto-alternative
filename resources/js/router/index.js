import {createWebHistory, createRouter} from 'vue-router';

import Login from '../../vue/views/Login.vue';
import Register from '../../vue/views/Register.vue';
import Home from '../../vue/views/Home.vue';
import is_login from '../../js/middleware/is_login.js';

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
        beforeEnter:[is_login],
    },
];



const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;
