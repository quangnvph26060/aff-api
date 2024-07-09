<template>
	<a-table
		:data-source="data"
		:columns="columns"
		:pagination="pagination"
		:scroll="{ x: 1200 }"
		@change="onChange"
	>
		<template #headerCell="{ column }">
			<template v-if="column.key === 'name'">
				<span style="color: #1890ff">Name</span>
			</template>
		</template>
		<template
			#customFilterDropdown="{
				setSelectedKeys,
				selectedKeys,
				confirm,
				clearFilters,
				column,
			}"
		>
			<div style="padding: 8px">
				<a-input
					ref="searchInput"
					:placeholder="`Tìm ${column.title}`"
					:value="selectedKeys[0]"
					style="width: 188px; margin-bottom: 8px; display: block"
					@change="
						(e) =>
							setSelectedKeys(
								e.target.value ? [e.target.value] : []
							)
					"
					@pressEnter="
						handleSearch(selectedKeys, confirm, column.dataIndex)
					"
				/>
				<a-button
					type="primary"
					size="small"
					style="width: 90px; margin-right: 8px"
					@click="
						handleSearch(selectedKeys, confirm, column.dataIndex)
					"
				>
					<template #icon><SearchOutlined /></template>
					Tìm
				</a-button>
				<a-button
					size="small"
					style="width: 90px"
					@click="handleReset(clearFilters)"
				>
					Đặt lại
				</a-button>
			</div>
		</template>
		<template #customFilterIcon="{ filtered }">
			<search-outlined
				:style="{ color: filtered ? '#108ee9' : undefined }"
			/>
		</template>
		<template #bodyCell="{ text, column, record }">
			<span
				v-if="
					state.searchText &&
					state.searchedColumn === column.dataIndex
				"
			>
				<template
					v-for="(fragment, i) in text
						.toString()
						.split(
							new RegExp(
								`(?<=${state.searchText})|(?=${state.searchText})`,
								'i'
							)
						)"
				>
					<mark
						v-if="
							fragment.toLowerCase() ===
							state.searchText.toLowerCase()
						"
						:key="i"
						class="highlight"
					>
						{{ fragment }}
					</mark>
					<template v-else>{{ fragment }}</template>
				</template>
			</span>
			<template v-else-if="column.dataIndex === 'money'">
				{{ useFormatCurrency(text) }}
			</template>
			<template v-else-if="column.dataIndex === 'new_balance'">
				{{ useFormatCurrency(text) }}
			</template>
			<template v-else-if="column.dataIndex === 'status'">
				<a-tag
					:color="colorByStatus(text)"
					class="inline-flex items-center"
				>
					<template #icon>
						<sync-outlined :spin="true" v-if="text === 0" />
						<check-circle-outlined v-else />
					</template>
					{{ text === 0 ? "chờ xác nhận" : "đã thanh toán" }}</a-tag
				>
			</template>
		</template>
	</a-table>
</template>
<script lang="ts" setup>
import { ref, reactive } from "vue";
import {
	SearchOutlined,
	SyncOutlined,
	CheckCircleOutlined,
} from "@ant-design/icons-vue";

import { useFormatCurrency } from "../../composables/useFormatCurrency";

const state = reactive({
	searchText: "",
	searchedColumn: "",
});

const searchInput = ref();

const colorByStatus = (status: number) => {
	switch (status) {
		case 0:
			return "processing";
		case 1:
			return "success";
		default:
			return "";
	}
};

const columns = [
	{
		title: "Loại giao dịch",
		dataIndex: "transaction_type",
	},
	{
		title: "Số tiền",
		dataIndex: "money",
		sorter: {
			compare: (a, b) => a.money - b.money,
		},
	},
	{
		title: "Số dư mới",
		dataIndex: "new_balance",
		sorter: {
			compare: (a, b) => a.new_balance - b.new_balance,
		},
	},
	{
		title: "Trạng thái",
		dataIndex: "status",
	},
	{
		title: "Thời gian",
		dataIndex: "time",
	},
];

const data = [
	{
		transaction_type: "Rút tiền",
		money: 100000,
		new_balance: 1000000,
		status: 0,
		time: "10:10:10 05/05/2024",
	},
	{
		transaction_type: "Nhận chiết khấu từ F1",
		money: 200000,
		new_balance: 0,
		status: 1,
		time: "10:10:10 05/05/2024",
	},
	{
		transaction_type: "Nhận chiết khấu từ F2",
		money: 300000,
		new_balance: 1000000,
		status: 0,
		time: "10:10:10 05/05/2024",
	},
	{
		transaction_type: "Nhận chiết khấu từ F3",
		money: 400000,
		new_balance: 0,
		status: 1,
		time: "10:10:10 05/05/2024",
	},
	{
		transaction_type: "Nhận chiết khấu từ F4",
		money: 500000,
		new_balance: 1000000,
		status: 1,
		time: "10:10:10 05/05/2024",
	},
	{
		transaction_type: "Rút tiền",
		money: 600000,
		new_balance: 0,
		status: 0,
		time: "10:10:10 05/05/2024",
	},
];

const handleSearch = (selectedKeys, confirm, dataIndex) => {
	confirm();
	state.searchText = selectedKeys[0];
	state.searchedColumn = dataIndex;
};

const handleReset = (clearFilters) => {
	clearFilters({ confirm: true });
	state.searchText = "";
};

const pagination = reactive({
	pageSize: 10,
	showSizeChanger: true,
	responsive: true,
	showLessItems: true,
	onChange: (page, pageSize) => {},
});

function onChange(pagination, filters, sorter, extra) {
	// console.log('params', pagination, filters, sorter, extra)
}
</script>
