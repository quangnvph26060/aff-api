<script lang="ts" setup>
import { useRouter } from "vue-router";
import { useFormatCurrency } from "../../../composables/useFormatCurrency";
import { onMounted, reactive, ref } from "vue";
import { gsap } from "gsap";
import { ShoppingCartOutlined } from "@ant-design/icons-vue";
import apiURL from "../../../connect.js";
import Product from '../../../api/products/product.js';
import Cart from '../../../api/carts/cart.js';
import { useStore} from "vuex"
const {getProduct, responseProduct, findProduct} = Product();
const{addToCart} = Cart();
const store = useStore();
const router = useRouter();

function formatDate(dateTimeStr) {
    const date = new Date(dateTimeStr);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const year = date.getFullYear();
    return `${day}-${month}-${year}`;
}



// xử lý chuyển trang
const handleSelected = async  (index) => {
	//await findProduct(index);
	await router.push(`/products/detail/${index}`);
};

//Infinite Scroll
// const loading = ref(true);
// const index = 0;
// const limit = 8;
// let newProducts = getProduct.splice(index, limit);

// const load = () => {
// 	setTimeout(() => {
// 		loading.value = false;
// 		if (getProduct.length > 0) {
// 			newProducts = newProducts.concat(productList.splice(index, limit));
// 		} else {
// 			loading.value = false;
// 		}
// 	}, 2000);
// };

const beforeEnter = (el: HTMLElement) => {
	el.style.opacity = "0";
	el.style.transform = "translateX(-100px)";
};

const enter = (el: HTMLElement, done: () => void) => {
	setTimeout(() => {
		gsap.to(el, {
			opacity: 1,
			x: 0,
			duration: 0.8,
			onComplete: done,
		});
	});
};
function addcart(id) {
    addToCart(id);
}
onMounted(() => {
  getProduct();
	const elements = document.querySelectorAll(".product-grid .product");
	elements.forEach((el, index) => {
		gsap.fromTo(
			el,
			{ opacity: 0, y: 100 },
			{ opacity: 1, y: 0, duration: 0.5, delay: index * 0.1 }
		);
	});
});
const getImageUrl = (imagePath) => {
  const baseUrl = apiURL.URL;
  const modifiedImagePath = imagePath.replace('public', 'storage');
  return `${baseUrl}/${modifiedImagePath}`;
};
// mã hóa id
const encodeId = (id) => {
  return btoa(id);
};
</script>
<template>
		
        <div class="row">
			<div class="row mb-4">
            <div class="col-lg-6 col-md-12">
                <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2024/06/banner/1200x100-1200x100-1.jpg" class="img-fluid" alt="Banner">
            </div>
			<div class="col-lg-6 col-md-12">
                <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2024/06/banner/1200x100-1200x100-1.jpg" class="img-fluid" alt="Banner">
            </div>
        	</div>
            <div class="col-lg-3">
                <input type="text" class="form-control" placeholder="Tìm kiếm...">
            </div>
            <div class="col-lg-2">
                <select class="form-control">
                    <option value="">Chọn 1</option>
                    <option value="1">Tùy chọn 1</option>
                    <option value="2">Tùy chọn 2</option>
                </select>
            </div>
            <div class="col-lg-2">
                <select class="form-control">
                    <option value="">Chọn 2</option>
                    <option value="1">Tùy chọn 1</option>
                    <option value="2">Tùy chọn 2</option>
                </select>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    
	<transition-group
		name="fade"
		tag="div"
		appear
		@before-enter="beforeEnter as any"
		@enter="enter as any"
		class="product-grid grid grid-cols-2 md:grid-cols-4 2xl:grid-cols-5 gap-x-4 gap-y-6 justify-around bg-white rounded-[10px] mt-[10px]"
	>
		
		<div
			v-for="(product, index) in responseProduct.data"
			:key="index"
			:data-index="index"
			class="">
		
			<div class="space-y-2 relative group main-content">
				<div class="main-img" >
					<a-image
						v-if="product && product.images && product.images.length > 0"
						:src="getImageUrl(product.images[0]['image_path'])"
						:preview="false"
						class="object-fill"
						@click="handleSelected(product.id)"
						
					></a-image>
					<a-image
						v-else
						:src="('Capture.PNG')" 
						:preview="false"
						class="object-fill"
						@click="handleSelected(product.id)"
					></a-image>
					<div
						class="h-7 w-[40px] md:w-[60px] icon-center justify-center absolute top-[5px] right-[5px] bg-gradient-to-r from-rose-500 to-fuchsia-500 rounded-md text-center text-white text-sm"
					>
						{{ product?.commission_rate }}%
					</div>
				</div>
				<div class="px-3 space-y-3 relative group">
					<div class="text-xs font-thin text-slate-500">
                        {{ product?.name }}
					</div>
					<div class="text-start md:text-base line-clamp-2">
						{{ product?.name }}
					</div>
					<div class="flex space-x-3 justify-content-between align-items-center">
						<span
							class="color-secondary self-center font-semibold inline-block align-middle"
							>{{
								useFormatCurrency(product?.price)
							}}</span
						>
						<span class="self-center font-thin text-xs inline-block align-middle line-through click-hover" @click="addcart(product.id)">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
								<path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3c.83.305 1.968.542 2.48 1.323c.356.545.356 1.268.356 2.715V9.76c0 2.942.061 3.912.892 4.826c.83.914 2.168.914 4.842.914h5.085c2.666 0 3.244-.601 3.756-3.193c.224-1.13.45-2.246.564-3.373c.216-2.134-.973-2.814-2.866-2.814H5.836M16.5 21a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3Zm-8 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3Z"/>
							</svg>
						</span>
					</div>
				</div>
			</div>
		</div>
	</transition-group>

</template>

<style scoped>


.group {
	z-index: 1;
	position: relative;
}

.group .overlay {
	z-index: 2;
	display: none;
}

.group:hover .overlay {
	display: block;
}
.main-img{
	width: 300px; 
	height: 300px;
	object-fit: cover;
}
.click-hover{
	cursor: pointer;
}
</style>