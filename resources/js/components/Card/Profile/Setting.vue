<template>
	<div>
		<a-card title="Cài đặt">
			<a-descriptions :column="1">
				<a-descriptions-item
					v-for="(value, key) in notificationData"
					:key="key"
				>
					<div class="flex items-center gap-5">
						<a-switch v-model:checked="formState[key]" />
						<div>{{ value }}</div>
					</div>
				</a-descriptions-item>
			</a-descriptions>
		</a-card>
	</div>
</template>

<script setup lang="ts">
import type { UnwrapRef } from "vue";
import { reactive } from "vue";

interface Notification {
	received_email: string;
	order_notification: string;
	withdraw_notification: string;
	income_notification: string;
}

interface Setting {
	received_email: boolean;
	order_notification: boolean;
	withdraw_notification: boolean;
	income_notification: boolean;
}

const formState: UnwrapRef<Setting> = reactive({
	received_email: false,
	order_notification: false,
	withdraw_notification: false,
	income_notification: false,
});

const notificationData: Notification = {
	received_email: "Email",
	order_notification: "Email khi có đơn hàng mới",
	withdraw_notification: "Email khi rút tiền thành công",
	income_notification: "Email khi có thu nhập mới",
};
</script>

<style></style>
