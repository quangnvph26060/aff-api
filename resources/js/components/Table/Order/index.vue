<script lang="ts" setup>
import { computed, ref, reactive, onMounted } from "vue";
import { SearchOutlined } from "@ant-design/icons-vue";
import Order from "../../../api/order/order.js";
import { useFormatCurrency } from "../../../composables/useFormatCurrency";
const {  getOrder, responseOrder } = Order();
const currentPage1 = ref(5);
const dataArr = ref([]);
onMounted(async () => {
  await getOrder();
  dataArr.value = responseOrder.data;
  console.log(dataArr.value);
  
});
const handleSizeChange = (val: number) => {
	console.log(`${val} items per page`);
};
const handleCurrentChange = (val: number) => {
	console.log(`current page: ${val}`);
};

interface User {
	id: number;
	name: string;
	date: string;
	status: string;
	total: number;
}

const searchInput = ref();
const state = reactive({
	searchText: "",
	searchedColumn: "",
});

const handleSearch = (selectedKeys, confirm, dataIndex) => {
	confirm();
	state.searchText = selectedKeys[0];
	state.searchedColumn = dataIndex;
};

const handleReset = (clearFilters) => {
	clearFilters({ confirm: true });
	state.searchText = "";
};

const data: User[] = [
	{
		id: 1,
		name: "Nguyễn Văn Bách",
		date: "02/05/2024 10:21:08",
		status: "success",
		total: 100,
	},
	{
		id: 2,
		name: "Nguyễn Văn Bách",
		date: "02/05/2024 10:21:08",
		status: "processing",
		total: 120,
	},
	{
		id: 3,
		name: "Nguyễn Văn Bách",
		date: "02/05/2024 10:21:08",
		status: "success",
		total: 140,
	},
	{
		id: 4,
		name: "Nguyễn Văn Bách",
		date: "02/05/2024 10:21:08",
		status: "error",
		total: 100,
	},
];

const columns = [
	{
		title: "Tên",
		dataIndex: "name",
		customFilterDropdown: true,
		onFilter: (value, record) =>
			record.name.toString().toLowerCase().includes(value.toLowerCase()),
		onFilterDropdownOpenChange: (visible) => {
			if (visible) {
				setTimeout(() => {
					searchInput.value.focus();
				}, 100);
			}
		},
		width: 250,
	},
	{
		title: "Ngày tạo",
		dataIndex: "created_at",
		width: 250,

	},
	{
		title: "Trạng thái",
		dataIndex: "status",
		filters: [
			{ text: "Chờ xử lý", value: 1 },
			{ text: "Đang vận chuyển", value: 2 },
			{ text: "Đã giao hàng", value: 3 },
			{ text: "Đã hủy", value: 4 },
			{ text: "Đã hoàn tiền", value: 5 },
			{ text: "Tạm dừng", value: 6 },
			{ text: "Thất bại", value: 7 },
		],
		onFilter: (value, record) => record.level.indexOf(value) === 1,
		width: 160,
	},
	{
		title: "Tổng tiền",
		dataIndex: "total_money",
		sorter: {
			compare: (a, b) => a.total - b.total,
		},
		width: 200,
	},
	{
		title: "Hành động",
		dataIndex: "operation",
		width: 200,
	},
];

function onChange(pagination, filters, sorter, extra) {
	console.log("params", pagination, filters, sorter, extra);
}

const pagination = reactive({
	pageSize: 10,
	showSizeChanger: true,
	responsive: true,
	showLessItems: true,
	onChange: (page, pageSize) => {},
});

function labelByStatus(status: number) {
	switch (status) {
		case 1:
			return "Chờ xử lý ";
		case 2:
			return "Đang vận chuyển";
		case 3:
			return "Đã giao hàng";
		case 4:
			return "Đã hủy";
		case 5:
			return "Đã hoàn tiền";
		case 6:
			return "Tạm dừng";
		case 7:
			return "Thất bại";
		default:
			return "";
	}
}
</script>

<template>
	<a-table
		:columns="columns"
		:data-source="dataArr"
		@change="onChange"
		:pagination="pagination"
		:scroll="{ x: 1200 }"
	>
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
		<template #bodyCell="{ column, text }">
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
			<template v-if="column.dataIndex === 'operation'">
				<div class="space-x-3">
					<a-button size="small"> Sửa </a-button>
					<a-button type="primary" size="small" danger>
						Xóa
					</a-button>
				</div>
			</template>
			<template v-else-if="column.dataIndex === 'status'">
				<div>
					<a-tag>
						{{ labelByStatus(text) }}
					</a-tag>
				</div>
			</template>
			<template v-else-if="column.dataIndex === 'total_money'">
				<div>
					{{ useFormatCurrency(text) }}
				</div>
			</template>
		</template>
	</a-table>
</template>
