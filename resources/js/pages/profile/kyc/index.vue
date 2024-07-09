<template>
	<div>
		<a-card title="Cập nhật thông tin định danh điện tử">
			<FormKyc class="ml-auto mr-auto" />
		</a-card>
	</div>
</template>

<script setup lang="ts">
// import FormKyc from "@/components/Form/Kyc/index.vue";
import FormKyc from "../../../components/Form/Kyc/index.vue";
</script>

<style scoped>
::deep(.ant-card-head) {
	text-align: center !important;
}
</style>
