<script setup lang="ts">
import { ref, onMounted } from "vue";
import { useFormatCurrency } from "../../composables/useFormatCurrency";
import { useRouter } from "vue-router";
import { useStore} from "vuex";
import Wallet from '../../api/wallet/index.js';
const { postTransactionRequest, formData} = Wallet();
const store = useStore();
const user = ref('');
const router = useRouter();
const balance1 = ref<Number>(0);
const balance2 =  ref<Number>(0);
const withdraw = ref<Number>(0); 
const wallet_type = ref<Number>(1);
const inputPrice = ref();
const inputWallet = ref("");
onMounted(async () => {
	const userdata = await store.getters['user'];
	user.value = userdata;
	if(userdata && userdata.wallet.length > 0){
		balance1.value = userdata?.wallet[0]['total_revenue'];
	 	balance2.value = userdata?.wallet[1]['total_revenue'];
	}
	
	
});
const Error = ref({
  method: false
});
async function btnTransaction() {
	Error.value.method = false;
	formData.wallet_type = wallet_type.value;
	formData.amount = withdraw.value;
	formData.method = inputWallet.value;
	if (formData.method === "") {
		Error.value.method = true;
		return;
	}
  	await postTransactionRequest(formData);
}
const method = ref("Chọn phương thức");
const method1 = ref("Chọn ví");

const focus = () => {
	// console.log('focus')
};
const handleChangeWallet = (value: number)=>{
	if(value == 1){
		wallet_type.value = 1
		inputPrice.value = balance1.value;
	}else if(value == 2){
		wallet_type.value = 2
		inputPrice.value = balance2.value;
	}
} 
const handleChange = (value: string) => {
	// console.log(`selected ${value}`)
	inputWallet.value = value;
};

</script>

<template>
	<div>
		<a-card title="Yêu cầu rút tiền" :bordered="false" class="w-100 ">
			<a-descriptions title="Số dư">
				<a-descriptions-item label="Số dư ví chính" >{{
					useFormatCurrency(balance1)
				}}</a-descriptions-item>
				<a-descriptions-item label="Số dư ví thưởng">{{
					useFormatCurrency(balance2)
				}}</a-descriptions-item>
			</a-descriptions>
			

			<div class="flex gap-5">
				<a-select
					ref="select"
					v-model:value="method1"
					style="width: 200px"
					@focus="focus"
					@change="handleChangeWallet(method1)"
				>
					<a-select-option value="1">Ví chính</a-select-option>
					<a-select-option value="2">Ví thưởng</a-select-option>
				</a-select>
				
				<a-select
					ref="select"
					v-model:value="method"
					style="width: 200px"
					@focus="focus"
					@change="handleChange(method)"
				>
					<a-select-option value="0">Tiền mặt</a-select-option>
					<a-select-option value="1">Chuyển khoản</a-select-option>
				</a-select>
				<!-- <p v-if="Error.method === true" style="color: red;">Vui lòng chọn phương thức</p> -->
				<a-input-number
					v-model:value="withdraw"
					:formatter="
						(value) =>
							`đ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
					"
					:min="10000"
					:step="1000"
					:max="inputPrice"
					class="w-[200px]"
					
				/>
				<!-- end::Method Withdraw -->

				<!-- begin::Submit Request -->
				<a-button class="bg-secondary text-white" @click="btnTransaction">Tạo yêu cầu rút tiền</a-button>
					
				<!-- end::Submit Request -->
			</div>
		</a-card>
	</div>
</template>

<style scoped>
.balance_item span{
	padding-left:10px !important;
}
</style>
