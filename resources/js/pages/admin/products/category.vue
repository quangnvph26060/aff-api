<script lang="ts" setup>
import { useFormatCurrency } from "../../composables/useFormatCurrency";
import type { SelectProps } from "ant-design-vue";
import TableProductsAdmin from "@components/Table/Products/Admin.vue";

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
	</div>
</template>

<style scoped></style>
