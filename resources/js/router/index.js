import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import About from '../components/About.vue';
import example from '../components/ExampleComponent.vue';
const routes = [
    { path: '/home', component: Home },
    { path: '/about', component: About },
    { path: '/example', component: example }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
