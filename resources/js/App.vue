<!-- <template>
    <div>
        <nav>
            <router-link to="/">Home</router-link>
            <router-link to="/about">About</router-link>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'App',
};
</script>

<style scoped>
nav {
    display: flex;
    gap: 10px;
}
</style> -->
<template>
	<a-config-provider
		:theme="{
			token: {
				colorPrimary: data.colorPrimary,
				borderRadius: `${data.borderRadius}px`,
				fontFamily: 'system-ui',
			},
		}"
	>
		<div id="app">
			<router-view></router-view>
		</div>
	</a-config-provider>

	<!-- begin::Back to top -->
	<div class="back-to-top">
		<a-back-top :style="{ right: '6px' }">
			<template #icon>
				<ArrowUpOutlined />
			</template>
		</a-back-top>
	</div>
	<!-- end::Back to top -->
</template>

<script setup>
import { ArrowUpOutlined } from "@ant-design/icons-vue";
import { ref } from "vue";
import { theme } from "ant-design-vue";
import router from "./router";

// color theme
const defaultData = {
	borderRadius: 6,
	colorPrimary: "#5eead4",
};
const data = ref(defaultData);
const { token } = theme.useToken();

// auth
// const initializeApp = async () => {
// 	if (localStorage.getItem("token")) {
// 		const token = localStorage.getItem("token");
// 		const user = await getUserAPI.getByToken(token);
// 		if (user) {
// 			store.login(token, user);
// 		} else {
// 			store.logout();
// 			router.push({ name: "login" });
// 		}
// 	} else {
// 		store.logout();
// 		router.push({ name: "login" });
// 	}
// };

// initializeApp();
</script>

<script>
export default {};
</script>

<style></style>
