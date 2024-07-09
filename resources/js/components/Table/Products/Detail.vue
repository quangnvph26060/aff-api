<script setup lang="ts">
import { ref, reactive, computed, onMounted } from "vue";
// import { useFormatCurrency } from "../../composables/useFormatCurrency";
import Product from "../../../api/products/product.js";
import CardProductList  from "../../Card/ProductList.vue";
import { useFormatCurrency } from "../../../composables/useFormatCurrency";
 import { useRouter } from 'vue-router'
const router = useRouter()
const { responseProduct, findProduct} = Product();s
import Cart from "../../../api/carts/cart.js";
const{addToCart} = Cart();
onMounted( async() => {
	const url = window.location.href;
	const id = url.substring(url.lastIndexOf('/') + 1);
 	await findProduct(id);
});
 const option = ref(null);
 const quantity = ref(1);
 function addcart(id) {
    addToCart(id);
}


const activeKey = ref("1");
const getImageUrl = (imagePath) => {
  const baseUrl = 'http://127.0.0.1:8000';
  const modifiedImagePath = imagePath.replace('public', 'storage');
  return `${baseUrl}/${modifiedImagePath}`;
};
const handleSelected = async (index: number) => {
	findProduct(index);
	await router.push(`/products/detail/${index}`);
}
</script>
<template>
	<div class="bg-[white] p-5 space-y-5">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-x-[20px]">
			<div class="col-span-1 flex justify-center">
				
				<a-image v-if="responseProduct.data && responseProduct.data.images && responseProduct.data.images.length > 0"
					:src="getImageUrl(responseProduct.data.images[0]['image_path'])"
					class="object-cover max-w-[500px]"
					:preview="false"
				></a-image>
				
			</div>
			<div class="col-span-1 space-y-4 ">
				<span class="text-2xl" >
					<!-- {{ productData.name }} --> 
					{{ responseProduct.data.name }}
				</span>
				<!-- <div class="pl-2 pr-2" style="border-bottom: 0.7px solid gray"></div> -->
				
				<p>
					<span class="text-xl">
						{{ useFormatCurrency(responseProduct.data.price) }}
						</span>
						<span
							class="text-base ml-3 line-through text-slate-400"
						>
						{{ responseProduct.data.commission_rate }} %
						</span>
				</p>
					<a-divider />
				<!-- begin::Description -->
				<div v-html="responseProduct.data.description"></div>
				

				<!-- end::Description -->
				<a-divider />
				<div class="grid grid-cols-6 lg:grid-cols-12 gap-4 items-center">
					<div class="col-span-3 d-flex justify-content-between ">
						<span>Số Lượng:</span>
						<span class="w-20">
							<input
							type="number"
							v-model="quantity"
							:min="1"
							:max="responseProduct.data.quantity"
							size="10"
							class="w-full"
							/>
						</span>
					</div>
				</div>
				<!-- begin::Quantity&Cart -->
				<div class="grid grid-cols-6 gap-4">
					

					<a-button
						type="primary"
						class="h-[40px] col-span-3 lg:col-span-2 bg-secondary "
					>
						Mua ngay
					</a-button>
					<a-button
						class="h-[40px] color-secondary col-span-3 lg:col-span-2" @click="addcart(responseProduct.data.id)"
					>
						Thêm vào giỏ
					</a-button>
				</div>
				<!-- end::Quantity&Cart -->
			</div>
		</div>

		<!-- begin::Product Detail -->
		<div>
			<a-tabs v-model:activeKey="activeKey" class="xl:px-5">
				<a-tab-pane key="1" tab="Chi tiết sản phẩm">
					<div v-html="responseProduct.data.description"></div>
				</a-tab-pane>
				<a-tab-pane key="2" tab="Đánh giá">
					<form>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên của bạn</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email của bạn</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="rating">Đánh giá (số sao)</label>
                        <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                </form>
				</a-tab-pane>
			</a-tabs>
		</div>
		<!-- end::Product Detail -->

		<!-- sản phẩm tương tự -->
		<a-divider />

		<div class="mb-10">
			<div class="text-center">
				<span class="text-[18px] font-semibold"
					>Sản phẩm tương tự
				</span>
			</div>
			 <div class="scrollbar-flex-content space-x-4 my-4">
				<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
					<div
						v-for="product in responseProduct.productCategory"
						:key="product.index"
						class="shadow-xl transition duration-300 rounded-[10px] hover:shadow-2xl cursor-pointer pb-3 scrollbar-demo-item main-img"
						@click="handleSelected(product.id)"
					>
						<div class="space-y-2">
						<div class="relative" style="width: ;">
	
							<a-image
							v-if="product && product.images && product.images.length > 0"
							:src="getImageUrl(product.images[0]['image_path'])"
							:preview="false"
							class="object-fill h-[150px] lg:h-[200px]"
							></a-image>
							<div
							class="h-7 w-[40px] md:w-[60px] icon-center justify-center absolute top-[5px] right-[5px] bg-gradient-to-r from-rose-500 to-fuchsia-500 rounded-md text-center text-white text-sm"
							>
							{{ product.commission_rate }}%
							</div>
						</div>
						<div class="px-3 space-y-3 ">
							<div class="line-clamp-2 text-start">
							{{ product.name }}
							</div>
							<div class="flex justify-content-between align-items-center">
								<span class="color-secondary self-center font-bold inline-block align-middle">{{ useFormatCurrency(product.price) }}</span>
								<span class="self-center font-thin text-xs inline-block align-middle line-through click-hover" @click="addcart(product.id)">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
										<path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3c.83.305 1.968.542 2.48 1.323c.356.545.356 1.268.356 2.715V9.76c0 2.942.061 3.912.892 4.826c.83.914 2.168.914 4.842.914h5.085c2.666 0 3.244-.601 3.756-3.193c.224-1.13.45-2.246.564-3.373c.216-2.134-.973-2.814-2.866-2.814H5.836M16.5 21a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3Zm-8 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3Z"/>
									</svg>
								</span>
							
							</div>
						</div>
						</div>
					</div>
				</div>
    		</div>
		</div>
	</div>
</template>

<style scoped>
:deep(.ant-tabs-nav-wrap) {
	width: 80%;
}
.main-img{
	width: 300px; 
	height: 300px;
	object-fit: cover;
}
</style>
