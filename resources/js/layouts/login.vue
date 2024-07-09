<script setup lang="ts">
import { reactive, ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import Auth from '../api/auth/index.js';
const router = useRouter();
const{loginForm, submitLogin, errors, resultOtp,submitResgiter } = Auth();

// onMounted(async () => {
//     await register(formSignup);
// });
interface FormLogin {
	phone: string;
	password: string;
}

interface FormSignup {
	name: string,
	phone: string;
	password: string;
	confirmPassword: string;
	referral_code: string,
	email: string,
	otp: string,
}

const formLogin = reactive<FormLogin>({
	phone: "",
	password: "",
});

const formSignup = reactive<FormSignup>({
	phone: "",
	password: "",
	confirmPassword: "",
	referral_code: "",
	name: "",
	email: "",
	otp: "",
});
onMounted(()=>{
	const urlParams = new URLSearchParams(window.location.search);
      const magioithieu = urlParams.get('referralcode');
      if (magioithieu) {
		formSignup.referral_code =  magioithieu;
      } else {
		formSignup.referral_code =  "";
      }
});
// const onFinish = (values: any) => {
// 	console.log("Success:", values);
// };

const onFinishFailed = (errorInfo: any) => {
	
	console.log("Failed:", errorInfo);
};
const otpValue = ref('');
const submitOtp = (event) => {
  event.preventDefault();
  formSignup.otp = otpValue.value;
  submitResgiter(formSignup,'sendotp');
};
const submitOtp1 = (event) => {
  event.preventDefault();
  formSignup.otp = otpValue.value;
  submitResgiter(formSignup,'register');
};
type menu = {
	name: string;
	icon: string;
	url: string;
};
const switchForm = ref(false);

const headerMenu: menu[] = reactive([
	{
		name: "Dashboard",
		icon: "HomeFilled",
		url: "/",
	},
	{
		name: "Cá nhân",
		icon: "ShoppingCart",
		url: "/profile",
	},

	{
		name: "Đăng ký",
		icon: "Key",
		url: "/signup",
	},
	{
		name: "Đăng nhập",
		icon: "Avatar",
		url: "/login",
	},
]);

</script>

<template>
	<div class="flex justify-center">
		<div class="grid grid-cols-2 justify-center gap-5 w-screen login_mobi">
			<!-- begin::Login Form -->
			<div class="col-span-2 lg:col-span-1 flex justify-center">
				<main class="mt-48">
					<div>
						<h1
							class="text-3xl font-bold leading-10 text-center text-teal-300"
						>
							{{
								switchForm ? "Chào mừng " : "Chào mừng trở lại"
							}}
						</h1>
					</div>
					<div class="mt-10">
						<!-- begin::Login From -->
						<a-form
							:model="formLogin"
							name="basic"
							autocomplete="off"
						
							@finishFailed="onFinishFailed"
							class="w-full px-5 lg:px-0 lg:w-[400px] h-10"
							layout="vertical"
							v-if="!switchForm"
						>
							<a-form-item
								label="Tài Khoản"
								name="phone"
								
							>
								<a-input
									v-model:value="loginForm.phone"
									class="h-10" :class="[errors.phone ? 'border border-danger' : '']" 
								/>
							</a-form-item>
							<span class="text-danger" v-if="errors.phone">{{ errors.phone }}</span>
							<a-form-item
								label="Mật khẩu"
								name="password"
								
							>
								<a-input-password
									v-model:value="loginForm.password"
									class="h-10" :class="[errors.password ? 'border border-danger' : '']" 
								/>
							</a-form-item>
							<span class="text-danger" v-if="errors.password">{{ errors.password }}</span>
						
							<a-form-item>
								<a-button
									type="submit"
									class="w-full h-9 bg-secondary"
									@click="submitLogin">
									Đăng nhập
								</a-button>
							</a-form-item>
							<p
								class="text-sm font-bold leading-5 mt-7 text-center max-md:ml-2.5"
							>
								<span>Chưa có tài khoản? </span>
								<a
									href="#"
									class="text-teal-300"
									@click="switchForm = !switchForm"
									>Đăng ký</a
								>
							</p>
						</a-form>
						<!-- end::Login Form -->

						<!-- begin::Signup Form -->
						<a-form
							:model="formSignup"
							name="basic"
							autocomplete="off"
						
							@submit="submitOtp"
							class="w-[360px] lg:w-[400px] h-10"
							layout="vertical"
							v-else
						>
						
						<a-form-item
								label="Họ và tên"
								name="name"
							>
								<a-input
									v-model:value="formSignup.name"
									class="h-10" :class="[errors.name ? 'border border-danger' : '']" 
								/>
						</a-form-item>
							<span class="text-danger" v-if="errors.name">{{ errors.name }}</span>
							<a-form-item
								label="Email"
								name="email"
							>
								<a-input
									v-model:value="formSignup.email"
									class="h-10" :class="[errors.email ? 'border border-danger' : '']" 
								/>
							</a-form-item>
							<span class="text-danger" v-if="errors.email">{{ errors.email }}</span>
							<a-form-item
								label="Số diện thoại"
								name="phone"
							>
								<a-input
									v-model:value="formSignup.phone"
									class="h-10" :class="[errors.phone ? 'border border-danger' : '']" 
								/>
							</a-form-item>
							<span class="text-danger" v-if="errors.phone">{{ errors.phone }}</span>
							<a-form-item
								label="Mật khẩu"
								name="password"
							>
								<a-input-password
									v-model:value="formSignup.password"
									class="h-10"  :class="[errors.password ? 'border border-danger' : '']" 
								/>
							</a-form-item>
							<span class="text-danger" v-if="errors.password">{{ errors.password }}</span>
							<a-form-item
								label="Xác nhận mật khẩu"
								name="confirmPassword"
							>
								<a-input-password
									v-model:value="formSignup.confirmPassword"
									class="h-10"  :class="[errors.confirmPassword ? 'border border-danger' : '']" 
								/>
							</a-form-item>
							<span class="text-danger" v-if="errors.confirmPassword">{{ errors.confirmPassword }}</span>
							<a-form-item
								label="Mã giới thiệu"
								name="referral_code"
							>
								<a-input
									v-model:value="formSignup.referral_code"
									class="h-10"
								/>
							</a-form-item>
							<div>
							<div v-if="resultOtp.status === true" class="mb-2">
								<form @submit="submitOtp1">
									<div class="flex">
										<div class="form-group mr-2">
											<input type="text" class="form-control" v-model="otpValue" placeholder="Nhập Mã OTP" />
										</div>
										<button type="submit" class="btn  css-dev-only-do-not-override-16xcw0g ant-btn ant-btn-primary  h-9 bg-secondary">Xác Nhận</button>
									</div>
								</form>
								</div>
							</div>

							<a-form-item>
								<a-button
									type="primary"
									html-type="submit"
									class="w-full h-9 bg-secondary"
									>Đăng Ký</a-button
								>
							</a-form-item>
							<p
								class="text-sm font-bold leading-5 mt-7 text-center max-md:ml-2.5"
							>
								<span>Đã có tài khoản? </span>
								<a
									href="#"
									class="text-teal-300"
									@click="switchForm = !switchForm"
									>Đăng nhập</a
								>
							</p>
						</a-form>
						<!-- end::Signup Form -->
					</div>
				</main>
			</div>
			<!-- end::Login Form -->

			<!-- begin::Banner -->
			<div class="hidden lg:block col-span-1 banner_mobi">
				<a-image
					src="https://cdn.builder.io/api/v1/image/assets/TEMP/d6b6afb56aecf96cb91282d9c4221d0ed42465a149c8908d687bc58e604e84e5?apiKey=b3083cca144a416593ef7615d067aac0&"
					alt="Decorative image"
					:preview="false"
					class="h-full w-full"
				/>
			</div>
			
		</div>
		
	</div>
</template>

<style></style>
