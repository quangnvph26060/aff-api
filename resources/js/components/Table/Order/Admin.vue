<template>
	<div>
		<a-table
			:columns="columns"
			:data-source="data"
			@change="onChange"
			class="admin-layout"
			:scroll="{ x: 1200 }"
		>
			<template #bodyCell="{ column, record }">
				<template v-if="column.key === 'id'">
					<span
						class="cursor-pointer text-[#8C57FF] text-lg font-semibold"
						>#{{ record.id }}
					</span>
				</template>
				<template v-else-if="column.key === 'status'">
					<div class="bg-[#37463F] rounded-full inline-flex">
						<CheckCircleOutlined class="text-2xl text-[#56CA00]" />
					</div>
				</template>
				<template v-else-if="column.key === 'user'">
					<div class="flex items-center gap-3">
						<a-avatar
							:style="{
								backgroundColor: 'orange',
								verticalAlign: 'middle',
							}"
						>
							{{ record.user.name[0] }}
						</a-avatar>
						<div class="flex flex-col">
							<span>{{ record.user.name }}</span>
							<div class="text-slate-300">
								{{ record.user.email }}
							</div>
						</div>
					</div>
				</template>
				<template v-else-if="column.key === 'total'">
					<span class="text-slate-300">
						{{ useFormatCurrency(record.total) }}
					</span>
				</template>
				<template v-else-if="column.key === 'payment_status'">
					<span>
						<a-tag
							color="#37463F"
							class="text-sm font-semibold"
							:style="{
								color: '#22c55e',
							}"
							>đã thanh toán</a-tag
						>
					</span>
				</template>
			</template>
		</a-table>
	</div>
</template>
<script lang="ts" setup>
import { useFormatCurrency } from "../../composables/useFormatCurrency";

const columns = [
	{
		key: "id",
		title: "#ID",
		dataIndex: "id",
		width: 100,
	},
	{
		key: "status",
		title: "Trạng thái",
		dataIndex: "status",
		sorter: {
			compare: (a, b) => a.status - b.status,
			multiple: 3,
		},
		width: 100,
	},
	{
		key: "user",
		title: "Khách hàng",
		dataIndex: "user",
		sorter: {
			compare: (a, b) => a.user.name - b.user.name,
			multiple: 2,
		},
		width: 250,
	},
	{
		key: "total",
		title: "Tổng tiền",
		dataIndex: "total",
		sorter: {
			compare: (a, b) => a.total - b.total,
			multiple: 1,
		},
		width: 200,
	},
	{
		key: "payment_status",
		title: "Thanh toán",
		dataIndex: "payment_status",
		sorter: {
			compare: (a, b) => a.payment_status - b.payment_status,
			multiple: 1,
		},
		width: 140,
	},
];

const data = [
	{
		key: "1",
		id: 1234,
		status: 1,
		user: {
			name: "Nguyen Van A",
			email: "testgmail@gmail.com",
		},
		total: 1000000000,
		payment_status: "paid",
	},
	{
		key: "2",
		id: 5678,
		status: 1,
		user: {
			name: "Nguyen Van A",
			email: "testgmail@gmail.com",
		},
		total: 1000000000,
		payment_status: "paid",
	},
	{
		key: "3",
		id: 3213,
		status: 1,
		user: {
			name: "Nguyen Van A",
			email: "testgmail@gmail.com",
		},
		total: 1000000000,
		payment_status: "paid",
	},
	{
		key: "4",
		id: 2424,
		status: 88,
		user: {
			name: "Nguyen Van A",
			email: "testgmail@gmail.com",
		},
		total: 1000000000,
		payment_status: "paid",
	},
];

function onChange(pagination, filters, sorter, extra) {
	console.log("params", pagination, filters, sorter, extra);
}

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
</style>
