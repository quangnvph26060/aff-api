<script lang="ts" setup>
import { useFormatCurrency } from "../../composables/useFormatCurrency";
import type { SelectProps } from "ant-design-vue";

const status = ref<SelectProps["options"]>([
	{
		value: "1",
		label: "Đã thanh toán",
	},
	{
		value: "2",
		label: "Chưa thanh toán",
	},
]);

const category = ref<SelectProps["options"]>([
	{
		value: "1",
		label: "Điện thoại",
	},
	{
		value: "2",
		label: "Máy tính",
	},
]);

const stock = ref<SelectProps["options"]>([
	{
		value: "1",
		label: "Còn hàng",
	},
	{
		value: "2",
		label: "Hết hàng",
	},
]);
</script>

<template>
	<div>
		<div class="grid grid-cols-4 divide-x divide-slate-700">
			<CardWallet
				title="Ví chính"
				:money="100000000"
				class="col-span-4 md:col-span-2 xl:col-span-1"
			/>
			<CardWallet
				title="Ví chính"
				:money="100000000"
				class="col-span-4 md:col-span-2 xl:col-span-1"
			/>
			<CardWallet
				title="Ví chính"
				:money="100000000"
				class="col-span-4 md:col-span-2 xl:col-span-1"
			/>
			<CardWallet
				title="Ví chính"
				:money="100000000"
				class="col-span-4 md:col-span-2 xl:col-span-1"
			/>
		</div>
		<div class="mt-5 space-y-5">
			<Card title="Bộ lọc">
				<template #content>
					<div class="grid grid-cols-3 gap-5">
						<Select
							:options="status"
							placeholder="Trạng thái"
							class="col-span-3 md:col-span-1"
						/>
						<Select
							:options="category"
							placeholder="Danh mục"
							class="col-span-3 md:col-span-1"
						/>
						<Select
							:options="stock"
							placeholder="Tồn kho"
							class="col-span-3 md:col-span-1"
						/>
					</div>
				</template>
			</Card>
			<TableProductsAdmin class="bg-admin-card" />
		</div>

		<a href="#" class="btn text-lg p-2">Mua hàng</a>
	</div>
</template>

<style scoped>
.btn {
	position: relative;
	display: inline-block;
	width: 200px;
	text-align: center;
	color: #fff;
	text-transform: uppercase;
	text-decoration: none;
	font-family: sans-serif;
	box-sizing: border-box;
	background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
	background-size: 400%;
	border-radius: 30px;
	z-index: 1;
}

.btn:hover {
	animation: animate 8s linear infinite;
}

@keyframes animate {
	0% {
		background-position: 0%;
	}
	100% {
		background-position: 400%;
	}
}

.btn:before {
	content: "";
	position: absolute;
	top: -5px;
	right: -5px;
	bottom: -5px;
	left: -5px;
	z-index: -1;
	background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
	background-size: 400%;
	border-radius: 40px;
	opacity: 0;
	transition: 0.5s;
}

.btn:hover:before {
	filter: blur(20px);
	opacity: 1;
	animation: animate 8s linear infinite;
}
</style>
