<template>
	<aside class="w-64 h-full overflow-y-auto space-y-3 ">
		<div class="logo">
			<img
				src="https://i.pinimg.com/564x/f6/48/32/f64832fa7b0a2c7a63ac30cc93066fe5.jpg"
				alt="logo"
				class="h-[60px] w-[60px] object-cover rounded-full mx-auto"
			/>
		</div>
		<a-menu
			v-model:openKeys="openKeys"
			v-model:selectedKeys="selectedKeys"
			class="text-sm w-[256px] h-100 space-y-3 "
			theme="light"
			mode="inline"
			:items="items"
			@click="handleClick"
		/>
	</aside>
</template>

<script lang="ts" setup>
import { ref, reactive, watch, h } from "vue";
import { useRouter, useRoute } from "vue-router";

import {
	MailOutlined,
	ShoppingCartOutlined,
	AppstoreOutlined,
	OrderedListOutlined,
	TeamOutlined,
	WalletOutlined,
	HistoryOutlined,
	FundOutlined,
	HomeOutlined,
} from "@ant-design/icons-vue";
import type { MenuProps, ItemType } from "ant-design-vue";

const router = useRouter();
const route = useRoute();

function getItem(
	label: string,
	key: string,
	icon?: any,
	iconStyle?: any,
	children?: ItemType[]
): ItemType {
	return {
		key,
		icon: icon ? () => h(icon, { style: iconStyle }) : null,
		label,
		children,
	} as ItemType;
}

const items: ItemType[] = reactive([
	getItem("Dashboard", "/", HomeOutlined, { fontSize: "20px" }),
	getItem("Giỏ hàng", "/cart", ShoppingCartOutlined, { fontSize: "20px" }),
	getItem("Sản phẩm", "/products", AppstoreOutlined, { fontSize: "20px" }),
	getItem("Quản lý đơn hàng", "/orders", OrderedListOutlined, {
		fontSize: "20px",
	}),
	getItem("Quản lý đội nhóm", "/teams", TeamOutlined, { fontSize: "20px" }),
	getItem("Thanh toán", "/payments", WalletOutlined, { fontSize: "20px" }),
	getItem("Lịch sử giao dịch", "/transactions", HistoryOutlined, {
		fontSize: "20px",
	}),
	getItem("Gói tháng", "/package", FundOutlined, { fontSize: "20px" }),
	getItem("Animate", "/animate", FundOutlined, { fontSize: "20px" }),
]);

const selectedKeys = ref<string[]>([route.path]);
const openKeys = ref<string[]>([]);

const handleClick: MenuProps["onClick"] = (e) => {
	const selectedItem = items.find((item) => item?.key === e.key);
	if (selectedItem) {
		router.push(selectedItem.key);
	}
};

watch(
	() => route.path,
	(newPath) => {
		selectedKeys.value = [newPath];
	}
);
</script>

<style scoped>
.a-menu {
	border-right: 0px !important;
	background-color: transparent;
}

.a-menu-item {
	padding: 0 24px !important;
}
.a-menu-item:hover {
	color: white !important;
}
</style>
