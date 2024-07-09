import { createRouter, createWebHistory } from "vue-router";
import admin from "./admin.js";
import user from "./user.js";
import { useStore } from "vuex"
const routes = [
	...admin,
	...user,
	{
		path: "/login",
		name: "login",
		component: () => import("../layouts/login.vue"),
	},
	{
		path: "/:pathMatch(.*)*",
		name: "NotFound",
		component: () => import("../layouts/404.vue"),
	},
];

function isAuthenticated() {
	return localStorage.getItem("token");
}

const router = createRouter({
	history: createWebHistory(),
	routes,
	strict: true,
});
const store = useStore();
router.beforeEach( async (to, from, next) => {
	
	const users = store.getters["user"];
	if (to.meta.requiresAdmin && (localStorage.getItem('token') === '' || localStorage.getItem('token') === null))
	{
	    next('/login');
	} else {
		if (!users || Object.keys(users).length === 0) {
			await store.dispatch('getUser');
		}
	  	next();
	}
});
export default router;
