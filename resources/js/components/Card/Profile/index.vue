//TODO: Add CardProfile to Dashboard
<template>
	<div>
		<a-card title="Tài khoản">
			<template #extra>
				<router-link :to="{ name: 'profile' }">
					<span class="color-secondary font-semibold"> Xem thêm</span>
				</router-link>
			</template>
			<a-form :model="props" label-width="auto" label-position="top">
				<a-form-item label="" class="">
					<a-tag v-if="props.isAdmin" color="success" size="small">
						{{
							props.isVerified
								? "đã được xác thực"
								: "chưa được xác thực"
						}}
					</a-tag>
				</a-form-item>
				
				<a-form-item label="Mã giới thiệu:">
					<div class="flex justify-between">
						<div
							v-text="user.referral_code"
							class="self-center" id="myInput"
						></div>
						<a-button @click="copyToClipboard">Giới thiệu </a-button>
					</div>
				</a-form-item>
				<div>
					<div v-for="(wallet, index) in user.wallet" :key="index">
						<div>
						<span v-if="wallet.wallet_id === 1">Số dư chính: </span>
						<span v-else>Ví thưởng: </span>
						<span :key="wallet.id">{{ useFormatCurrency(wallet.total_revenue) }}</span>
						</div>
					</div>
				</div>

			
				<div class="">Tài khoản đã được xác thực</div>
			</a-form>
		</a-card>
	</div>
</template>

<script lang="ts" setup>
import { ref, onMounted } from "vue";
import { useFormatCurrency } from "../../../composables/useFormatCurrency";
import { useClipboard } from "@vueuse/core";
import { useStore} from "vuex";
import apiURL  from "../../../connect.js";
const store = useStore();
const user = ref('');

onMounted(async () => {
	const userdata = await store.getters['user'];
	user.value = userdata;
});
const copyToClipboard = () => {
  var copyText = document.getElementById("myInput");
  var referralLink = `${apiURL.FE_URL}login?referralcode=` + encodeURIComponent(copyText.textContent || copyText.innerText);

  // Tạo một textarea ẩn để sao chép nội dung
  const el = document.createElement('textarea');
  el.value = referralLink;
  el.style.position = 'absolute';
  el.style.left = '-9999px';
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
};



const props = defineProps<{
	isAdmin: boolean;
	isVerified: boolean;
	referralCode: string;
	mainWallet: number;
	pendingWallet: number;
}>();

// const { text, copy, copied, isSupported } = useClipboard({
// 	source,
// });
</script>
