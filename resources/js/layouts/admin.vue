<template>
    <a-config-provider
        :theme="{
            token: {
                colorPrimary: data.colorPrimary,
                borderRadius: parseInt(`${data.borderRadius}px`),
                colorText: '#fff',
                fontFamily: 'system-ui',
            },
        }"
    >
        <a-layout class="min-h-screen">
            <a-layout-sider
                :style="sidebarStyle"
                class="hidden lg:block text-white"
                ><TheSidebar type="admin"
            /></a-layout-sider>
            <a-layout>
                <a-layout-header :style="headerStyle"
                    ><TheHeader
                /></a-layout-header>
                <a-layout-content
                    class="mt-[84px] lg:mt-5 container-item bg-admin-main"
                    ><router-view v-slot="{ Component }">
                        <transition name="route" mode="out-in">
                            <component :is="Component" />
                        </transition> </router-view
                ></a-layout-content>
            </a-layout>
        </a-layout>
    </a-config-provider>
</template>
<script lang="ts" setup>
import type { CSSProperties } from 'vue'

const defaultData = {
    borderRadius: 6,
    colorPrimary: '#8955f8',
}
const data = ref(defaultData)

const sidebarStyle: CSSProperties = {
    background: '#28243D',
    width: '256px',
}

const headerStyle: CSSProperties = {
    padding: '0',
    background: 'transparent',
}
</script>

<style scoped>
.ant-layout-sider {
    width: 256px !important;
    min-width: 256px !important;
    max-width: 256px !important;
}

.route-enter-active,
.route-leave-active {
    transition: all 0.3s ease-in;
}

.route-enter-from,
.route-leave-to {
    opacity: 0;
    transform: translateX(-100px);
}

.route-enter-to,
.route-leave-from {
    opacity: 1;
    transform: translateX(0);
}
</style>
