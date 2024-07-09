<script lang="ts" setup>
import { useRouter } from 'vue-router'
import { reactive, defineProps  } from 'vue'
import { useFormatCurrency } from "../../composables/useFormatCurrency";
const router = useRouter()
const productList: {
    index: number
    images: string
    name: string
    describe: string
    price: number
    discounted_price: number
}[] = reactive([
    {
        index: 1,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 2,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt, mang đến niềm vui cho người ...',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 3,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 4,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 5,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 6,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 7,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 8,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 9,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 10,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 11,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 12,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 13,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 14,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 15,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 16,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 17,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 18,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 19,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
    {
        index: 20,
        images: 'https://tiki.vn/blog/wp-content/uploads/2023/01/airpod-3-va-airpod-pro.jpg',
        name: 'tai nghe không dây hàng nhập khẩu chính hãng tại mỹ do nhà táo sản xuất',
        describe: 'sản phẩm chất liệu tốt',
        price: 1000000,
        discounted_price: 600000,
    },
])
const props = defineProps({
  productId: Number,
});
console.log(props.productId);

// xử lý chuyển trang
const handleSelected = (index: number) => {
    router.push('/products/detail/102')
}
</script>
<template>
    <div class="scrollbar-flex-content space-x-4 my-4">
        <div
            v-for="product in productList"
            :key="product.index"
            class="shadow-xl transition duration-300 rounded-[10px] hover:shadow-2xl cursor-pointer pb-3 scrollbar-demo-item"
            @click="handleSelected(product.index)"
        >
            <div class="space-y-2">
                <div class="relative">
                    <a-image
                        :src="product.images"
                        :preview="false"
                        class="object-fill h-[150px] lg:h-[200px]"
                    />
                    <div
                        class="h-7 w-[60px] icon-center justify-center absolute top-[5px] right-[5px] bg-gradient-to-r from-cyan-500 to-blue-500 rounded-md text-center text-white text-sm"
                    >
                        20% off
                    </div>
                </div>
                <div class="px-3 space-y-3">
                    <div class="line-clamp-2 text-start">
                        {{ product.name }}
                    </div>
                    <div class="flex justify-between">
                        <span
                            class="color-secondary self-center font-bold inline-block align-middle"
                            >{{
                                useFormatCurrency(product.discounted_price)
                            }}</span
                        >
                        <a-button
                            type="primary"
                            class="icon-center self-center rounded-2xl"
                        >
                            <ShoppingCartOutlined class="text-xl" />
                        </a-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.scrollbar-flex-content {
    display: flex;
}
.scrollbar-demo-item {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 220px;
    height: 280px;
    margin: 10px;
    text-align: center;
    border-radius: 4px;
}
</style>
