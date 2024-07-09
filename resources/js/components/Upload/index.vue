<template>
    <div>
        <a-upload-dragger
            v-model:fileList="fileList"
            name="file"
            :multiple="true"
            action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
            @change="handleChange"
            @drop="handleDrop"
        >
            <div class="py-4">
                <p class="ant-upload-drag-icon">
                    <InboxOutlined
                        :style="{
                            color: 'white',
                        }"
                    ></InboxOutlined>
                </p>
                <p class="ant-upload-text">
                    Click or drag file to this area to upload
                </p>
            </div>
        </a-upload-dragger>
    </div>
</template>
<script lang="ts" setup>
import { ref } from 'vue'
import { InboxOutlined } from '@ant-design/icons-vue'
import { message } from 'ant-design-vue'
import type { UploadChangeParam } from 'ant-design-vue'
const fileList = ref([])
const handleChange = (info: UploadChangeParam) => {
    const status = info.file.status
    if (status !== 'uploading') {
        console.log(info.file, info.fileList)
    }
    if (status === 'done') {
        message.success(`${info.file.name} file uploaded successfully.`)
    } else if (status === 'error') {
        message.error(`${info.file.name} file upload failed.`)
    }
}
function handleDrop(e: DragEvent) {
    console.log(e)
}
</script>
