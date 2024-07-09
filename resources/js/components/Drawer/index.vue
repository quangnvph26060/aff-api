<script setup lang="ts">
import { ref, computed } from "vue";
import TheSidebar from "../TheSidebar.vue";

interface Props {
	open: boolean;
}

const props = defineProps<Props>();
const emit = defineEmits<{
	(e: "update:open", value: boolean): void;
}>();

const isOpen = computed<boolean>({
	get() {
		return props.open || false;
	},
	set(value: boolean) {
		emit("update:open", value);
	},
});

const onClose = () => {
	isOpen.value = false;
};
</script>

<template>
	<a-drawer
		
		placement="left"
		:open="isOpen"
		:width="256"
		@close="onClose"
		:closable="false"
	>
		<TheSidebar class="w-full" @click="onClose" />
	</a-drawer>
</template>

<style>
.ant-drawer-body {
	padding: 0 !important;
}
</style>
