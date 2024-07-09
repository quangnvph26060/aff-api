<script lang="ts" setup>
const props = defineProps({
    title: {
        type: String,
        default: null,
    },
})
</script>

<template>
    <a-card class="card bg-card text-white" :bordered="false">
        <template #title>
            <span v-if="props.title">
                {{ props.title }}
            </span>
        </template>
        <template #default>
            <slot name="content"></slot>
        </template>
    </a-card>
</template>

<style>
.card .ant-card {
    /* border: 0 !important; */
}

.card .ant-card-head {
    padding: 0 20px !important;
}
.card .ant-card-body {
    padding: 20 20px !important;
}

.bg-card {
    background-color: #312d4b;
    color: white !important;
}
</style>
