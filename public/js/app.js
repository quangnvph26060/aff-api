import { createApp } from '../../node_modules/vue';
import router from '../../resources/js/router/index.js';
import App from './App.vue';

const app = createApp(App);
app.use(router);
app.mount('#app');
