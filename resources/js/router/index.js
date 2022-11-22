import { createWebHistory, createRouter } from 'vue-router';
import Dashboard from '../../vue/views/DashBoard.vue';

const routes = [
    {
        path: '/',
        name: 'Dashboard',
        component: Dashboard,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
