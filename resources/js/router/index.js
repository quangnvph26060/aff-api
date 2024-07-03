import { createRouter, createWebHistory } from 'vue-router';
import SomeView from '../views/SomeView.vue';

const routes = [
    {
        path: '/home',
        name: 'Home',
        component: SomeView,
    },
    // Các route khác nếu cần
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
