<script lang="ts" setup>
import { useFormatCurrency } from "../../composables/useFormatCurrency";
import { HomeOutlined } from "@ant-design/icons-vue";

const props = defineProps<{
	title: string;
	money: number;
	icon: string;
}>();
</script>

<template>
	<a-card class="" :style="{ padding: '0' }">
		<template #title> </template>
		<template #default>
			<div
				class="text-sm leading-5 color-secondary md:text-secondary font-semibold"
			>
				{{ props.title }}
			</div>
			<div class="flex flex-1 gap-5 justify-between rounded-2xl">
				<div class="flex flex-col my-auto">
					<div
						class="flex gap-2 mt-2 whitespace-nowrap leading-[140%]"
					>
						<div class="grow text-lg">
							{{ useFormatCurrency(props.money) }}
						</div>
					</div>
				</div>
				<div
					class="flex items-center justify-center w-[40px] h-[40px] my-auto overflow-hidden bg-secondary rounded-xl"
				>
					<HomeOutlined class="text-xl text-white" />
				</div>
			</div>
		</template>
	</a-card>
</template>
