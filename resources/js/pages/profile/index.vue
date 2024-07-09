<template>
	<div>
		<!-- begin:: Toolbar -->
		<div class="">
			<div class="">
				<a-image
					src="https://cdn.builder.io/api/v1/image/assets/TEMP/20d4b1bdd72f28b66a0105764e94e83682338a3d48ba0a7597114917dca230b2?apiKey=b3083cca144a416593ef7615d067aac0&"
					alt="Background"
					class="object-cover"
					:preview="false"
				/>
			</div>

			<div class="flex justify-center relative">
				<a-card
					hoverable
					class="w-11/12 px-2 flex flex-row items-center h-[100px] absolute -top-[70px] backdrop-blur-md bg-white/40 border-none justify-between"
				>
					<template #cover>
						<a-avatar
							:size="64"
							src="https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png"
						>
							<!-- <template #icon><UserOutlined /></template> -->
						</a-avatar>
					</template>

				
					<div class="ant-card-body main_info">
						<div class="ant-card-meta">
							<div class="ant-card-meta-detail">
								<div class="ant-card-meta-title">{{ user.name }}</div>
								<div class="ant-card-meta-description">
									{{ user.email }}
								</div>
							</div>
						</div>
					</div>
					<template #actions>
						<div class="flex flex-col md:flex-row md:space-x-4">
							<a-button
								class="bg-transparent border-0 hover:bg-white icon-center rounded-xl"
							>
								<CodeSandboxOutlined />
								<div class="hidden md:block ml-2">
									Tổng quan
								</div>
							</a-button>
							<a-button
								class="bg-transparent border-0 hover:bg-white icon-center rounded-xl"
							>
								<TeamOutlined />
								<div class="hidden md:block ml-2" @click="handleRoute('doinhom')">Đội nhóm</div>
							</a-button>
							<a-button
								class="bg-transparent border-0 hover:bg-white icon-center rounded-xl"
							>
								<ToolOutlined />
								<div class="hidden md:block ml-2"  @click="handleRoute('donhang')">Đơn hàng</div>
							</a-button>
						</div>
					</template>
				</a-card>
			</div>
		</div>
		<!-- end:: Toolbar -->

		<!-- begin::Card Info -->
		<div class="mt-14 grid md:grid-cols-2 xl:grid-cols-3 gap-5">
			<CardProfileSetting class="col-span-1 xl:h-[320px]" />
			<CardProfileInfo class="col-span-1 xl:h-[320px]" />
			<CardProfileAuthInfo class="col-span-1 xl:h-[320px]" />
		</div>
		<!-- end::Card Info -->
	</div>
</template>

<script setup lang="ts">
// import { h } from "vue";
import {
	CodeSandboxOutlined,
	TeamOutlined,
	ToolOutlined,
} from "@ant-design/icons-vue";
import CardProfileSetting from "../../components/Card/Profile/Setting.vue";
import CardProfileInfo from "../../components/Card/Profile/Info.vue";
import CardProfileAuthInfo from "../../components/Card/Profile/AuthInfo.vue";
import { handleError, onMounted, ref } from 'vue';
import { useRouter } from "vue-router";
import { useStore} from "vuex";
const store = useStore();
const user = ref('');
const router = useRouter()
onMounted(async () => {
	const userdata = await store.getters['user'];
	user.value = userdata;
	console.log(user.value);
	
});

function handleRoute(value){
	switch(value){
		case 'doinhom':
		 router.push({ name: 'teams' })
			break;
		case 'donhang':
		router.push({ name: 'orders' })
			break;
		default:
		router.push({ name: 'profile' })
	}

}
</script>

<style>
.ant-card-actions {
	background: transparent !important;
}
</style>
