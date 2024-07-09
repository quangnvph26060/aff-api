<template>
	<a-table :data-source="dataArr" :columns="columns" @change="onChange" :pagination="pagination"
		:scroll="{ x: 1200 }">
		<template #customFilterDropdown="{
			setSelectedKeys,
			selectedKeys,
			confirm,
			clearFilters,
			column,
		}">
			<div style="padding: 8px">
				<a-input ref="searchInput" :placeholder="`Tìm ${column.title}`" :value="selectedKeys[0]"
					style="width: 188px; margin-bottom: 8px; display: block" @change="(e) =>
							setSelectedKeys(
								e.target.value ? [e.target.value] : []
							)
						" @pressEnter="
						handleSearch(selectedKeys, confirm, column.dataIndex)
						" />
				<a-button type="primary" size="small" style="width: 90px; margin-right: 8px" @click="
					handleSearch(selectedKeys, confirm, column.dataIndex)
					">
					<template #icon>
						<SearchOutlined />
					</template>
					Tìm
				</a-button>
				<a-button size="small" style="width: 90px" @click="handleReset(clearFilters)">
					Đặt lại
				</a-button>
			</div>
		</template>
		<template #customFilterIcon="{ filtered }">
			<search-outlined :style="{ color: filtered ? '#108ee9' : undefined }" />
		</template>
		<template #bodyCell="{ text, column, record }">
			<span v-if="
				state.searchText &&
				state.searchedColumn === column.dataIndex
			">
				<template v-for="(fragment, i) in text
					.toString()
					.split(
						new RegExp(
							`(?<=${state.searchText})|(?=${state.searchText})`,
							'i'
						)
					)">
					<mark v-if="
						fragment.toLowerCase() ===
						state.searchText.toLowerCase()
					" :key="i" class="highlight">
						{{ fragment }}
					</mark>
					<template v-else>{{ fragment }}</template>
				</template>
			</span>
			<template v-else>
				<template v-if="column.dataIndex === 'name'">
					<a @click="handleLinkClick(record.id)">{{ text }}</a>
				</template>
				<template v-if="column.dataIndex === 'level'">
					<a-tag :color="colorByLevel(text)">{{ text }}</a-tag>
				</template>
				<template v-else-if="column.dataIndex === 'personal_sale'">
					{{ useFormatCurrency(text) }}
				</template>
				<template v-else-if="column.dataIndex === 'team_sale'">
					{{ useFormatCurrency(text) }}
				</template>
			</template>
		</template>
	</a-table>
</template>
<script lang="ts" setup>
import { ref, reactive, onMounted } from "vue";
import { useRouter } from "vue-router";
import { SearchOutlined } from "@ant-design/icons-vue";
import { useFormatCurrency } from "../../composables/useFormatCurrency";
import Teams from "../../api/team/team.js";
const { responseTeam, getAllTeamMember } = Teams();
const dataArr = ref([]);
onMounted(async () => {
	await getAllTeamMember();
	dataArr.value = responseTeam.data;
	  console.log(responseTeam.data);

});
const state = reactive({
	searchText: "",
	searchedColumn: "",
});

const searchInput = ref();

const colorByLevel = (level: string) => {
	switch (level) {
		case "F1":
			return "#1F77B4";
		case "F2":
			return "#AEC7E8";
		case "F3":
			return "#FF7F0E";
		case "F4":
			return "#FFBB78";
		case "F5":
			return "#2CA02C";
		default:
			return "";
	}
};

const columns = [
	{
		title: "Tài khoản",
		dataIndex: "email",
		width: 180,
	},
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
		scopedSlots: { customRender: 'name' }
	},
	{
		title: "Mã thành viên",
		dataIndex: "id",
		width: 140,
		customFilterDropdown: true,
		onFilter: (value, record) =>
			record.id.toString().toLowerCase().includes(value.toLowerCase()),
		onFilterDropdownOpenChange: (visible) => {
			if (visible) {
				setTimeout(() => {
					searchInput.value.focus();
				}, 100);
			}
		},
	},
	{
		title: "DS Cá nhân",
		dataIndex: "personal_sale",
		sorter: {
			compare: (a, b) => a.personal_sale - b.personal_sale,
		},
		width: 200,
	},
	{
		title: "DS Nhóm",
		dataIndex: "team_sale",
		sorter: {
			compare: (a, b) => a.team_sale - b.team_sale,
		},
		width: 200,
	},
	{
		title: "Hạng thành viên",
		dataIndex: "level",
		filters: [
			{ text: "F1", value: "F1" },
			{ text: "F2", value: "F2" },
			{ text: "F3", value: "F3" },
			{ text: "F4", value: "F4" },
			{ text: "F5", value: "F5" },
		],
		onFilter: (value, record) => record.level.indexOf(value) === 0,
		width: 160,
	},
];

const pagination = reactive({
	pageSize: 10,
	showSizeChanger: true,
	responsive: true,
	showLessItems: true,
	onChange: (page, pageSize) => { },
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

function onChange(pagination, filters, sorter, extra) {
	// console.log('params', pagination, filters, sorter, extra)
}
const router = useRouter();
const handleLinkClick = (id: number) => {
	console.log('Link clicked for ID: ', id);;
	router.push({name: 'team' ,params: { id }});
};
</script>
