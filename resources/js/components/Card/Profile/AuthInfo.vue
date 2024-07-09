<template>
	<div>
		<a-card title="Thông tin đăng nhập">
			<a-descriptions :column="1">
				<a-descriptions-item>
					Tên đăng nhập : {{ user.email }}
				</a-descriptions-item>
				<a-descriptions-item>
					Mật Khẩu: ********
				</a-descriptions-item>
			</a-descriptions>
		</a-card>
	</div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';

import { useStore} from "vuex";
const store = useStore();
const user = ref('');
onMounted(async () => {
	const userdata = await store.getters['user'];
	user.value = userdata;
});

</script>

<style></style>
