<template>
	<a-form
		:label-col="labelCol"
		:wrapper-col="wrapperCol"
		layout="horizontal"
		style="max-width: 600px"
	>
		<a-form-item label="Ảnh CCCD mặt trước">
			<a-upload
				v-model:file-list="fileList"
				action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
				list-type="picture"
			>
				<a-button class="icon-center">
					<upload-outlined class="icon-center"></upload-outlined>
					<span>Chọn ảnh</span>
				</a-button>
			</a-upload>
		</a-form-item>
		<a-form-item label="Ảnh CCCD mặt sau">
			<a-upload
				v-model:file-list="fileList"
				action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
				list-type="picture"
			>
				<a-button class="icon-center">
					<upload-outlined class="icon-center"></upload-outlined>
					<span>Chọn ảnh</span>
				</a-button>
			</a-upload>
		</a-form-item>
		<a-form-item label="Họ và tên">
			<a-input />
		</a-form-item>
		<a-form-item label="Số CCCD">
			<a-input />
		</a-form-item>
		<a-form-item label="Chọn ngân hàng">
			<a-select>
				<a-select-option value="demo">Demo</a-select-option>
			</a-select>
		</a-form-item>
		<a-form-item label="Số tài khoản">
			<a-input />
		</a-form-item>
		<a-form-item label="Tên chủ tài khoản">
			<a-input />
		</a-form-item>
		<a-form-item label="Chi nhánh ngân hàng">
			<a-input />
		</a-form-item>
		<a-form-item label="Chọn tỉnh ngân hàng">
			<a-select>
				<a-select-option value="demo">Demo</a-select-option>
			</a-select>
		</a-form-item>
		<div class="w-full flex justify-center mt-4">
			<a-button type="primary">Xác nhận</a-button>
		</div>
	</a-form>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import type { UploadProps } from "ant-design-vue";

const componentDisabled = ref(true);
const labelCol = { style: { width: "150px" } };
const wrapperCol = { span: 14 };

const fileList = ref<UploadProps["fileList"]>([]);
</script>

<style></style>
