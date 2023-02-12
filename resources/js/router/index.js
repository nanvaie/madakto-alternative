import { createWebHistory, createRouter } from 'vue-router';
import Dashboard from '../../vue/views/DashBoard.vue';
import Login from '../../vue/views/Login.vue';


const routes = [
    {
        path: '/',
        name: 'Dashboard',
        component: Dashboard,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
