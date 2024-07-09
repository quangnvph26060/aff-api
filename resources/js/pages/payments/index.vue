<script setup lang="ts">
import CardWithdraw from "../../components/Card/Withdraw.vue";
import TablePayment from "../../components/Table/Payment.vue";
</script>

<template>
	<div>
		<CardWithdraw />
		<a-card title="Lịch sử thanh toán" :bordered="false" class="w-100">
			<TablePayment class="mt-5" />
		</a-card>
	</div>
</template>
