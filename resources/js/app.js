import { createApp } from 'vue';
import App from './App.vue';
import router from './router/index.js';
import axios from "axios";
import Antd from "ant-design-vue";
import store from '../js/store/index.js';
import "../../resources/js/assets/main.scss";
import "ant-design-vue/dist/reset.css";
import { createPinia } from "pinia";
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";
import VueSweetalert2 from "vue-sweetalert2";
import 'bootstrap/dist/css/bootstrap.css'
//import 'ant-design-vue/dist/antd.css';
// import 'vue-data-ui/dist/vue-data-ui.css';
//import 'tailwindcss/dist/tailwind.css';
import 'sweetalert2/dist/sweetalert2.min.css';
import { theme } from "ant-design-vue";
const { token } = theme.useToken();
const app = createApp(App);

window.axios = axios;

router.beforeEach((to, from, next) => {
	window.scrollTo(0, 0);
	next();
});
const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);
app.use(VueSweetalert2);
app.use(Antd);
app.use(store);
app.use(pinia);
app.use(router);
app.mount('#app');
