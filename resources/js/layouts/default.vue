<template>
	<a-layout class="h-screen">
		<a-layout-sider
			class="text-white hidden lg:block"
			:style="sidebarStyle"
			><TheSidebar type="client"
		/></a-layout-sider>
		<a-layout>
			<a-layout-header :style="headerStyle"
				><TheHeader
			/></a-layout-header>
			<a-layout-content class="container-item mt-20 lg:mt-10 w-full"
				><router-view v-slot="{ Component }">
					<transition name="route" mode="out-in">
						<component :is="Component" />
					</transition> </router-view
			></a-layout-content>
		</a-layout>
	</a-layout>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import type { CSSProperties } from "vue";
import TheHeader from "../components/TheHeader.vue";
import TheSidebar from "../components/TheSidebar.vue";

const sidebarStyle: CSSProperties = {
	background: "white",
	width: "256px",
};

const headerStyle: CSSProperties = {
	padding: "0",
	background: "transparent",
};
</script>

<style scoped>
.ant-layout-sider {
	width: 256px !important;
	min-width: 256px !important;
	max-width: 256px !important;
}

.route-enter-active,
.route-leave-active {
	transition: all 0.3s ease-in;
}

.route-enter-from,
.route-leave-to {
	opacity: 0;
	transform: translateX(-100px);
}

.route-enter-to,
.route-leave-from {
	opacity: 1;
	transform: translateX(0);
}
</style>
