<template>
	<a-table
		:data-source="dataTransaction.data"
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
			<template v-if="column.dataIndex === 'status'">
				<a-tag
					:color="colorByStatus(text)"
					class="inline-flex items-center"
				>
					<template #icon>
						<sync-outlined :spin="true" v-if="text === 'pending'" />
						<check-circle-outlined v-else />
					</template>
					{{ text === 'pending' ? "chờ xác nhận" : "đã thanh toán" }}</a-tag
				>
			</template>
			<template v-else-if="column.dataIndex === 'balance'">
				{{ useFormatCurrency(text)}} 
			</template>
			
			
		</template>
	</a-table>
</template>
<script lang="ts" setup>
import { ref, reactive, onMounted } from "vue";
import {
	SearchOutlined,
	SyncOutlined,
	CheckCircleOutlined,
} from "@ant-design/icons-vue";

import { useFormatCurrency } from "../../composables/useFormatCurrency";
import Wallet from '../../api/wallet/index.js';
const { responseWallet, getTransactionAll} = Wallet();
const dataTransaction = ref([]);
onMounted(async () => {
	await getTransactionAll();
	dataTransaction.value = responseWallet.data;
	console.log(dataTransaction.value);
	
});
const state = reactive({
	searchText: "",
	searchedColumn: "",
});

const searchInput = ref();

const colorByStatus = (status: string) => {
  switch (status) {
    case "pending":
      return "processing";
    case "completed":
      return "success";
    default:
      return "";
  }
};


const columns = [
	{
		title: "Kỳ đối soát",
		dataIndex: "created_at",
	},
	{
		title: "Ví",
		dataIndex: "wallet_id",
		 customRender: ({ text }) => text === 1 ? "Ví chính" : "Ví thưởng"
	},
	{
		title: "Số dư trong kỳ",
		dataIndex: "amount",
		sorter: {
			compare: (a, b) => a.balance - b.balance,
		},
		customRender: ({ text, record }) => {
            return useFormatCurrency(record.amount);
        },
	},
	{
		title: "Thuế thu nhập",
		dataIndex: "tax",
		sorter: {
			compare: (a, b) => a.tax - b.tax,
		},
		customRender: ({ text, record }) => {
            return useFormatCurrency(record.amount ? (record.amount * 0.1) : '0');
        },
	},
	{
		title: "Số dư thực nhận",
		dataIndex: "balance_received",
		sorter: {
			compare: (a, b) => a.balance_received - b.balance_received,
		},
		customRender: ({ text, record }) => {
    		const balanceReceived =  record.amount -  (record.amount * 0.1);
			return useFormatCurrency(balanceReceived);
  	},
	},
	{
		title: "Trạng thái",
		dataIndex: "status",
		filters: [
			{ text: "đã thanh toán", value: 'completed' },
			{ text: "chờ xác nhận", value: 'pending'  },
		],
		onFilter: (value, record) => record.level.indexOf(value) === 'pending',
	},
];

const data = [
	{
		period: "05/05/2024-05/06/2024",
		balance: 100000,
		tax: 0,
		balance_received: 100000,
		status: 1,
	},
	{
		period: "05/05/2024-05/06/2024",
		balance: 200000,
		tax: 0,
		balance_received: 200000,
		status: 0,
	},
	{
		period: "05/05/2024-05/06/2024",
		balance: 300000,
		tax: 0,
		balance_received: 300000,
		status: 1,
	},
	{
		period: "05/05/2024-05/06/2024",
		balance: 400000,
		tax: 0,
		balance_received: 400000,
		status: 0,
	},
	{
		period: "05/05/2024-05/06/2024",
		balance: 500000,
		tax: 0,
		balance_received: 500000,
		status: 1,
	},
	{
		period: "05/05/2024-05/06/2024",
		balance: 600000,
		tax: 0,
		balance_received: 600000,
		status: 0,
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
