<script setup lang="ts">
import { useFormatCurrency } from "../../composables/useFormatCurrency";

const props = defineProps<{
	title: string;
	money: number;
}>();
</script>

<template>
	<Card>
		<template #content>
			<div>
				<div
					class="bg-green-500 rounded-full p-2 inline-flex absolute right-4"
				>
					<MoneyCollectOutlined class="text-3xl" />
				</div>
				<div>
					<div class="text-base">{{ props.title }}</div>
					<div class="text-2xl mt-2">
						{{ useFormatCurrency(props.money) }}
					</div>
				</div>
			</div>
		</template>
	</Card>
</template>

<style></style>
