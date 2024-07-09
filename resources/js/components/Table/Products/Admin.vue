<template>
	<div>
		<!-- begin::Toolbar -->
		<div class="flex flex-row-reverse container-item">
			<!-- begin::Action buttons -->
			<div class="space-x-4 my-5">
				<a-button size="large" class="btn-admin">Xuất file</a-button>
				<a-button
					size="large"
					class="btn-admin-primary"
					@click="onAddProduct"
					>Thêm sản phẩm</a-button
				>
			</div>
			<!-- end::Action buttons -->
		</div>
		<!-- end::Toolbar -->

		<a-table
			:columns="columns"
			:data-source="data"
			@change="onChange"
			class="admin-layout"
			:row-selection="rowSelection"
			:scroll="{ x: 1500 }"
		>
			<template #bodyCell="{ column, record }">
				<template v-if="column.key === 'product'">
					<div class="grid gap-1">
						<span>
							{{ record.product }}
						</span>
						<div class="text-xs text-slate-300">
							{{ record.product }}
						</div>
					</div>
				</template>
				<template v-else-if="column.key === 'category'">
					<div class="flex items-center space-x-3">
						<div
							class="bg-[#37463F] rounded-2xl p-1.5 inline-flex"
							v-if="record.category === 'phone'"
						>
							<MobileOutlined class="text-xl text-[#56CA00]" />
						</div>
						<div
							class="bg-[#2D4268] rounded-2xl p-1.5 inline-flex"
							v-else-if="record.category === 'laptop'"
						>
							<LaptopOutlined class="text-xl text-[#16B1FF]" />
						</div>
						<div
							class="bg-[#52324C] rounded-2xl p-1.5 inline-flex"
							v-else-if="record.category === 'headphone'"
						>
							<GlobalOutlined class="text-xl text-[#FF4C51]" />
						</div>
						<span>
							{{ record.category }}
						</span>
					</div>
				</template>
				<template v-else-if="column.key === 'stock'">
					<a-switch
						v-model:checked="record.stock"
						size="small"
						class="w-[32px]"
					/>
				</template>
				<template v-else-if="column.key === 'price'">
					<span class="text-slate-300">
						{{ useFormatCurrency(record.price) }}
					</span>
				</template>
				<template v-else-if="column.key === 'status'">
					<span>
						<a-tag
							:color="getTagColor(record.status).bgColor"
							class="text-sm font-semibold"
							:style="{
								color: getTagColor(record.status).color,
								borderRadius: '12px',
								padding: '2px 8px',
							}"
						>
							{{ getTagColor(record.status).text }}
						</a-tag>
					</span>
				</template>
				<template v-else-if="column.key === 'qty'">
					<span class="text-slate-300">
						{{ record.qty }}
					</span>
				</template>
			</template>
		</a-table>
	</div>
</template>
<script lang="ts" setup>
import { useFormatCurrency } from "../../composables/useFormatCurrency";
import { Table } from "ant-design-vue";
import { computed, ref, h } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const columns = [
	{
		key: "product",
		title: "Sản phẩm",
		dataIndex: "product",
		width: 200,
	},
	{
		key: "category",
		title: "Danh mục",
		dataIndex: "category",
		sorter: {
			compare: (a, b) => a.category - b.category,
			multiple: 3,
		},
		width: 180,
	},
	{
		key: "stock",
		title: "Tồn kho",
		dataIndex: "stock",
		width: 100,
	},
	{
		key: "price",
		title: "Giá",
		dataIndex: "price",
		sorter: {
			compare: (a, b) => a.price - b.price,
			multiple: 1,
		},
		width: 200,
	},
	{
		key: "qty",
		title: "Số lượng",
		dataIndex: "qty",
		sorter: {
			compare: (a, b) => a.qty - b.qty,
			multiple: 1,
		},
		width: 120,
	},
	{
		key: "status",
		title: "Trạng thái",
		dataIndex: "status",
		sorter: {
			compare: (a, b) => a.status - b.status,
			multiple: 1,
		},
		width: 100,
	},
	{
		key: "action",
		title: "Thao tác",
		dataIndex: "action",
		width: 140,
	},
];

const getTagColor = (status: number) => {
	switch (status) {
		case 1:
			return { color: "#22c55e", bgColor: "#37463F", text: "công khai" };
		case 2:
			return { color: "#FF4C51", bgColor: "#52324C", text: "hết hàng" };
		default:
			return { color: "#D89B0E", bgColor: "#52433F", text: "chờ" };
	}
};
// product, category, stock, price, qty, status, action

const data = reactive([
	{
		key: "1",
		product: "Iphone 13 Pro Max",
		category: "phone",
		stock: false,
		price: 1000000000,
		qty: 10,
		status: 1,
		action: "Sửa | Xóa",
	},
	{
		key: "2",
		product: "Iphone 13 Pro Max",
		category: "phone",
		stock: true,
		price: 1000000000,
		qty: 10,
		status: 2,
		action: "Sửa | Xóa",
	},
	{
		key: "3",
		product: "Laptop Dell XPS 13",
		category: "laptop",
		stock: false,
		price: 1000000000,
		qty: 10,
		status: 3,
		action: "Sửa | Xóa",
	},
	{
		key: "4",
		product: "Tai nghe Sony WH-1000XM4",
		category: "headphone",
		stock: false,
		price: 1000000000,
		qty: 10,
		status: 1,
		action: "Sửa | Xóa",
	},
]);

function onChange(pagination, filters, sorter, extra) {
	console.log("params", pagination, filters, sorter, extra);
}

const selectedRowKeys = ref<DataType["key"][]>([]); // Check here to configure the default column

const onSelectChange = (changableRowKeys: string[]) => {
	console.log("selectedRowKeys changed: ", changableRowKeys);
	selectedRowKeys.value = changableRowKeys;
};

const rowSelection = computed(() => {
	return {
		selectedRowKeys: unref(selectedRowKeys),
		onChange: onSelectChange,
		hideDefaultSelections: true,
		selections: [
			Table.SELECTION_ALL,
			Table.SELECTION_INVERT,
			Table.SELECTION_NONE,
			{
				key: "odd",
				text: "Select Odd Row",
				onSelect: (changableRowKeys) => {
					let newSelectedRowKeys = [];
					newSelectedRowKeys = changableRowKeys.filter(
						(_key, index) => {
							if (index % 2 !== 0) {
								return false;
							}
							return true;
						}
					);
					selectedRowKeys.value = newSelectedRowKeys;
				},
			},
			{
				key: "even",
				text: "Select Even Row",
				onSelect: (changableRowKeys) => {
					let newSelectedRowKeys = [];
					newSelectedRowKeys = changableRowKeys.filter(
						(_key, index) => {
							if (index % 2 !== 0) {
								return true;
							}
							return false;
						}
					);
					selectedRowKeys.value = newSelectedRowKeys;
				},
			},
		],
	};
});

const onAddProduct = () => {
	router.push({ name: "admin-products-add", params: { type: "add" } });
};
</script>

<style scoped>
:deep(.admin-layout .ant-table-thead > tr > th) {
	background-color: #3d3759 !important;
	color: #ffffff !important;
}

:deep(.admin-layout .ant-table-tbody > tr > td) {
	background-color: #312d4b !important;
	color: #ffffff !important;
}

:deep(.admin-layout .ant-table-tbody > tr:hover > td) {
	background-color: #312d4b !important;
}

:deep(.admin-layout .ant-switch-checked) {
	background-color: #8955f8 !important;
}
</style>
