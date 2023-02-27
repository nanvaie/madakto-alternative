import {createWebHistory, createRouter} from 'vue-router';

import Login from '../../vue/views/Login.vue';
import Register from '../../vue/views/Register.vue';
import Page404 from '../../vue/views/Page404.vue';
import is_login from '../../js/middleware/is_login.js';
import Dashboard from '../../vue/views/DashBoard.vue';
import Test from '../../vue/views/DashboardTest.vue';
import CreateWorkspace from '../../vue/views/WorkSpaces/Create.vue';
import EditWorkspace from '../../vue/views/WorkSpaces/Edit.vue';
import WorkspaceList from '../../vue/views/WorkSpaces/WorkspaceList.vue';
import AssignmentUserToWorkspace from '../../vue/views/WorkSpaces/AssignmentUserToWorkspace.vue';
import CreateShift from '../../vue/views/Shifts/Create.vue';
import ShiftList from '../../vue/views/Shifts/ShiftList.vue';
import EditShift from '../../vue/views/Shifts/Edit.vue';

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
        name: 'dashbord',
        component: Dashboard,
        beforeEnter:[is_login],
    },

    {
        path: '/test',
        name: 'test',
        component: Test,
        beforeEnter:[is_login],

    },
    {
        path: '/workspaces/create',
        name: 'createWorkspace',
        component: CreateWorkspace,
        beforeEnter:[is_login],
    },
    {
        path: '/workspaces/edit/:id',
        name: 'editWorkspace',
        component: EditWorkspace,
        beforeEnter:[is_login],
    },
    {
        path: '/workspaces',
        name: 'workspaceList',
        component: WorkspaceList,
        beforeEnter:[is_login],
    },
    {
        path: '/workspaces/assignmentUserToWorkspace',
        name: 'assignmentUserToWorkspace',
        component: AssignmentUserToWorkspace,
        beforeEnter:[is_login],
    },
    {
        path: '/shifts/create',
        name: 'createShift',
        component: CreateShift,
        beforeEnter:[is_login],
    },
    {
        path: '/shifts',
        name: 'shiftList',
        component: ShiftList,
        beforeEnter:[is_login],
    },
    {
        path: '/shifts/edit/:id',
        name: 'editShift',
        component: EditShift,
        beforeEnter:[is_login],
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'page404',
        component: Page404,
    },
];



const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;
