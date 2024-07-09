<script setup lang="ts">
import { ref } from "vue";
import { useRouter } from "vue-router";
import Breadcrumb from "./Breadcrumb/index.vue";
import Drawer from "./Drawer/index.vue";
import {
	MenuOutlined,
	NotificationOutlined,
	UserOutlined,
} from "@ant-design/icons-vue";
import Auth from '../api/auth/index.js';
const{ logout } = Auth();
const router = useRouter();
const showModal = ref(false);
function toggleModal() {
  showModal.value = !showModal.value;
}
const searchInput = ref("");



const handleLogout = () => {
	 logout();
};

const openDrawer = ref(false);
const handleDrawer = () => {
	openDrawer.value = !openDrawer.value;
};
</script>

<template>
	<header class="flex flex-col h-[144px] lg:h-[84px]">
		<div
			class="flex justify-center items-center h-[72px] bg-gradient-to-r from-[#4fd1c5] from-10% via-[#76faed] via-50% to-[#4fd1c5] to-90% lg:hidden"
		>
			<img src="../assets/logo.png" class="w-[64px] h-[64px]" />
		</div>

		<div
			class="flex items-center justify-end sm:justify-between mt-4 px-5 container-item"
		>
			<div class="my-auto text-2xl whitespace-nowrap hidden sm:block">
				<Breadcrumb :breadcrumbItems="breadcrumbItems" />
			</div>
			<div class="flex gap-5 justify-between items-center text-xs">
				<!-- <a-input
					v-model="searchInput"
					class="w-[200px] lg:w-[300px] border-none"
					clearable
					placeholder="Tìm kiếm"
				/> -->
				<!-- <button
					aria-label="Notifications"
					class="flex items-center h-[32px]"
				>
					<NotificationOutlined class="text-xl" />
				</button> -->
				<div
					class="icon-center cursor-pointer block lg:hidden"
					@click="handleDrawer"
				>
					<MenuOutlined
						:style="{
							fontSize: '20px',
						}"
					/>
				</div>
				<button aria-label="Notifications" @click="handleLogout">
					
				</button>
				<div class="profile">
					<a-avatar style="background-color: #87d068" id="profile" @click="toggleModal">
					<template #icon><UserOutlined /></template>
					</a-avatar>
					<div v-if="showModal" class="modal_profile">
						<ul>
							<li><router-link :to="{ name: 'profile' }">Thông Tin</router-link></li>
							<li><a href="#" @click="handleLogout">Đăng Xuất</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>

	<Drawer :open="openDrawer" @update:open="handleDrawer" />
</template>

<style scoped>
.ant-input::placeholder {
	color: #a1a1aa;
}
.modal_profile {
	padding: 0 10px;
  position: absolute;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
  top: 10%; 
  width: 10%;
  left: 94%;
  transform: translateX(-50%);
  z-index: 10;
}
.modal_profile ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.modal_profile ul li {
  display: inline;
}

.modal_profile ul li a {
  display: block;

}

.modal_profile ul li a:hover {
  background-color: #ccc;
}
.modal_profile {
        position: absolute;
        top: 50px; /* Căn chỉnh top theo ý muốn */
        right: 10px; /* Căn chỉnh right theo ý muốn */
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        padding: 10px;
        z-index: 1000; /* Để đảm bảo nằm trên các phần tử khác khi mở modal */
    }

    .modal_profile ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .modal_profile ul li {
        margin-bottom: 10px;
    }

    .modal_profile ul li a {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        color: #333;
        transition: background-color 0.3s;
    }

    .modal_profile ul li a:hover {
        background-color: #f0f0f0;
    }

    .modal_profile ul li:last-child a {
        border-bottom: none; /* Loại bỏ border-bottom của phần tử cuối cùng */
    }

    .modal_profile ul li a {
        border-bottom: 1px solid #ccc; /* Thêm border-bottom cho các liên kết */
    }
</style>
