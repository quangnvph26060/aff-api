<script lang="ts" setup>
const props = defineProps<{
    breadcrumbItems: { title: string; path?: string }[]
}>()
</script>

<template>
    <a-breadcrumb>
        <!-- bổ sung index  -->
        <a-breadcrumb-item
            v-for="(item, index) in props.breadcrumbItems"
            :key="index"
            :to="item.path"
        >
            {{ item.title }}
        </a-breadcrumb-item>
    </a-breadcrumb>
</template>
