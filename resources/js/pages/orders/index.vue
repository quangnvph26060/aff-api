<script setup lang="ts">
import { CheckCircleOutlined } from "@ant-design/icons-vue";
import TableOrder from "../../components/Table/Order/index.vue";
// import TableOrder from "../../components/Table/Order/index.vue";
import TableOrderOverview from "../../components/Table/Order/Overview.vue";
import Order from "../../api/order/order.js";
import { useFormatCurrency } from "../../composables/useFormatCurrency";
import { onMounted, ref } from "vue";
const {  getOrder, responseOrder } = Order();

const dataCount = ref(0);
onMounted(async () => {
  await getOrder();
  dataCount.value = responseOrder.count;
  
});
</script>

<template>
	<div>
		<a-card>
			<template #title class="font-bold">
				<span class="font-bold">Quản lý đơn hàng</span>
				<div class="flex items-center text-xs text-green-500 mt-1">
					<CheckCircleOutlined class="mr-1" />
					{{ dataCount }} đơn thành công
				</div>
			</template>
			<TableOrder />
		</a-card>
		<div class="mt-4">
			<a-card class="leading-5 max-w-[500px]">
				<template #title class="font-bold">
					<span class="font-bold">Tổng quan đơn hàng</span></template
				>
				<p class="mb-4 text-slate-400">
					<span class="font-bold text-green-400">+30%</span> tháng này
				</p>
				<TableOrderOverview />
			</a-card>
		</div>
	</div>
</template>
