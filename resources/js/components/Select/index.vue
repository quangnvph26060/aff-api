<template>
    <div>
        <a-select
            ref="select"
            class="admin-layout w-full"
            :options="props.options"
            @focus="focus"
            @change="handleChange"
            :placeholder="props.placeholder"
            size="large"
            allowClear
        ></a-select>
    </div>
</template>

<script lang="ts" setup>
import { ref } from 'vue'
import type { SelectProps } from 'ant-design-vue'
const value1 = ref('Chọn')

const props = defineProps<{
    options: SelectProps['options']
    placeholder: string
}>()

const focus = () => {
    console.log('focus')
}

const handleChange = (value: string) => {
    console.log(`selected ${value}`)
}
</script>

<style scoped>
:deep(.admin-layout .ant-select-selector) {
    background-color: #312d4b !important;
    color: white !important;
    border: 1px solid #8955f8 !important;
}

:deep(.ant-select-dropdown) {
    padding: 0 !important;
}

:deep(.admin-layout .ant-select-arrow) {
    color: white !important;
}

:deep(.admin-layout .ant-select-item-option-content) {
    color: white;
}

:deep(.ant-select-single.ant-select-open .ant-select-selection-item) {
    color: white !important;
}

:deep(.rc-virtual-list-holder-inner) {
    background-color: #312d4b !important;
    color: white;
}

:deep(.ant-select-selection-placeholder) {
    color: #a1a1aa !important;
}
</style>
