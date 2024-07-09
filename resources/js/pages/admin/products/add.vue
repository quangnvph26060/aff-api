<template>
	<div>
		<!-- begin::Title -->
		<div class="flex justify-between flex-wrap">
			<span class="text-2xl font-semibold mb-4">{{ title }}</span>
			<div class="space-x-3">
				<a-button size="large" class="btn-admin w-[100px]"
					>Hủy</a-button
				>
				<a-button size="large" class="btn-admin-primary w-[100px]"
					>Lưu</a-button
				>
			</div>
		</div>
		<!-- end::Title -->

		<!-- begin::Form -->
		<div class="grid grid-cols-3 mt-5 gap-5 admin-layout">
			<!-- begin::Main Info -->
			<Card title="Thông tin sản phẩm" class="col-span-2">
				<template #content>
					<a-form
						:model="formState"
						@finish="onFinish"
						class="space-y-5"
					>
						<a-form-item>
							<Input
								v-model:value="formState.product.name"
								placeholder="Tên sản phẩm"
								size="large"
							/>
						</a-form-item>
						<a-form-item>
							<Input
								v-model:value="formState.product.description"
								placeholder="Mô tả sản phẩm"
								type="textarea"
								size="large"
							/>
						</a-form-item>
					</a-form>
				</template>
			</Card>
			<!-- end::Main Info -->

			<!-- begin::Price -->
			<Card title="Giá" class="col-span-1">
				<template #content>
					<a-form
						:model="formState"
						@finish="onFinish"
						class="space-y-5"
					>
						<a-form-item>
							<Input
								v-model:value="formState.product.price"
								size="large"
								type="number"
								class="w-full"
								title="Giá gốc"
							/>
						</a-form-item>
						<a-form-item>
							<Input
								v-model:value="formState.product.discount"
								size="large"
								type="number"
								title="Giảm giá"
							/>
						</a-form-item>
					</a-form>
					<a-divider class="bg-white" />
					<div class="flex justify-between">
						<span>Còn hàng</span>
						<a-switch v-model:checked="formState.product.stock" />
					</div>
				</template>
			</Card>
			<!-- end::Price -->

			<!-- begin::Product Image -->
			<Card title="Ảnh sản phẩm" class="col-span-2 row-span-4">
				<template #content>
					<Upload class="h-full" />
				</template>
			</Card>
			<!-- end::Product Image -->

			<!-- begin::Organize -->
			<Card title="Tổ chức" class="col-span-1">
				<template #content>
					<a-form
						:model="formState"
						@finish="onFinish"
						class="space-y-5"
					>
						<a-form-item>
							<Select
								v-model:value="formState.product.status"
								:options="status"
								placeholder="Trạng thái"
							/>
						</a-form-item>
						<a-form-item>
							<Select
								v-model:value="formState.product.category"
								:options="category"
								placeholder="Danh mục"
							/>
						</a-form-item>
					</a-form>
				</template>
			</Card>
			<!-- end::Organize -->

			<!-- begin::Extra -->
			<Card title="Kho" class="col-span-2">
				<template #content>
					<div>
						<a-tabs
							v-model:activeKey="activeKey"
							tab-position="left"
							:style="{ height: '200px' }"
							@tabScroll="callback"
						>
							<a-tab-pane
								v-for="i in 2"
								:key="i"
								:tab="i === 1 ? 'Số lượng' : 'Giao hàng'"
							>
								<transition name="tab-pane" mode="out-in">
									<div
										v-if="activeKey === i"
										key="tab-content-{{ i }}"
									>
										<div class="space-y-5" v-if="i === 1">
											<span class="text-lg"
												>Lựa chọn</span
											>
											<div
												class="flex justify-between items-center space-x-5"
											>
												<Input
													:value="
														formState.product.qty
													"
													title="Nhập số lượng"
													class="w-full"
													size="large"
													type="number"
												/>
												<a-button
													type="primary"
													size="large"
													class="self-end"
												>
													Xác nhận
												</a-button>
											</div>
										</div>
										<div class="space-y-5" v-if="i === 2">
											<span class="text-lg"
												>Giao hàng</span
											>
											<div>
												<a-radio-group
													v-model:value="value"
													class="flex flex-col space-y-12"
												>
													<a-radio
														:style="radioStyle"
														:value="1"
													>
														<div>
															<span
																>Fulfilled by
																Seller</span
															>
															<div
																class="text-xs text-gray-400"
															>
																Lorem ipsum
																dolor sit amet,
																consectetur
																adipiscing elit.
																Sed nonne
																merninisti
																licere mihi ista
																probare, quae
																sunt a te dicta?
															</div>
														</div>
													</a-radio>
													<a-radio
														:style="radioStyle"
														:value="2"
													>
														<div>
															<span
																>Fulfilled by
																Seller</span
															>
															<div
																class="text-xs text-gray-400"
															>
																Lorem ipsum
																dolor sit amet,
																consectetur
																adipiscing elit.
																Sed nonne
																merninisti
																licere mihi ista
																probare, quae
																sunt a te dicta?
															</div>
														</div>
													</a-radio>
												</a-radio-group>
											</div>
										</div>
									</div>
								</transition>
							</a-tab-pane>
						</a-tabs>
					</div>
				</template>
			</Card>
			<!-- end::Extra -->
		</div>
		<!-- end::Form -->
	</div>
</template>

<script lang="ts" setup>
import { ref, reactive, computed } from "vue";
import { useRoute } from "vue-router";
import type { SelectProps, TabsProps } from "ant-design-vue";

const route = useRoute();
const formType = route.params.type || "add";

const title = computed(() => {
	return formType === "add" ? "Thêm sản phẩm" : "Sửa sản phẩm";
});

// Tabs
const activeKey = ref<number>(1);
const callback: TabsProps["onTabScroll"] = (val) => {};

// Form
const formState = reactive({
	product: {
		name: "",
		description: "",
		price: 0,
		discount: 0,
		stock: false,
		category: "",
		status: "",
		qty: 0,
	},
});

const value = ref<number>(1);
const radioStyle = reactive({
	display: "flex",
	height: "30px",
	lineHeight: "30px",
});

const status = ref<SelectProps["options"]>([
	{
		value: "1",
		label: "Công khai",
	},
	{
		value: "2",
		label: "Hết hàng",
	},
	{
		value: "3",
		label: "Chờ",
	},
]);

const category = ref<SelectProps["options"]>([
	{
		value: "1",
		label: "Phone",
	},
	{
		value: "2",
		label: "Laptop",
	},
	{
		value: "3",
		label: "Headphone",
	},
]);

const onFinish = (values: any) => {
	console.log("Success:", values);
};
</script>

<style scoped>
:deep(.admin-layout .ant-input) {
	background: #383451 !important;
	border: 1px solid #8955f8 !important;
}

:deep(.admin-layout .ant-input-number) {
	background: #383451 !important;
	border: 1px solid #8955f8 !important;
}

:deep(.admin-layout .ant-input::placeholder) {
	color: #9ca3af !important;
}

:deep(.admin-layout .ant-input-number-input::placeholder) {
	color: #9ca3af !important;
}

.ant-tabs .ant-tabs-tab.ant-tabs-tab-active .ant-tabs-tab-btn {
	color: #8955f8 !important;
}

.tab-pane-enter-active,
.tab-pane-leave-active {
	transition: all 0.4s ease-in;
}

.tab-pane-enter-from,
.tab-pane-leave-to {
	opacity: 0;
	transform: translateX(-100px);
}

.tab-pane-enter-to,
.tab-pane-leave-from {
	opacity: 1;
	transform: translateX(0);
}
</style>
