const admin = [
	{
		path: "/admin",
		component: () => import("../layouts/admin.vue"),
		name: "admin",
		redirect: "/admin/user",
		children: [
			// {
			// 	path: "user",
			// 	name: "manage-user",
			// 	component: () => import("../views/admin/user/UserList.vue"),
			// },
		],
		// beforeEnter(to, from, next) {
		// 	// ...
		// 	if (!isAuthenticated()) {
		// 		next({ name: "login" });
		// 	} else {
		// 		if (localStorage.getItem("role") !== "admin") {
		// 			next({ name: "post-list" });
		// 		} else {
		// 			next();
		// 		}
		// 	}
		// },
	},
];

// function isAuthenticated() {
// 	return localStorage.getItem("token");
// }

export default admin;
