-- 05/23/2024
INSERT INTO `user_info`(`id`, `img_url`, `idnumber`, `bank_name`, `bank`, `branch`, `user_id`, `created_at`, `updated_at`) 
VALUES ('1','','123456','VISA','4111111111111111','branch','1','2023-10-26 12:34:31','2023-10-26 12:34:31')
-- 6/11/2024
chạy 1 bảng migrate
   php artisan migrate --path=/database/migrations/2024_06_03_031437_create_phan_quyen_table_name.php 


-- 6/18/2024
composer require bensampo/laravel-enum
--6/27/2024
php artisan storage:link

lệnh tạo key check auth : php artisan jwt:secret 

-- 06/28/2024
php artisan queue:table
php artisan queue:failed-table
để chạy: php artisan queue:work gưi mail



-- 5/72024
 npm install ant-design-vue
npm install pinia-plugin-persistedstate
npm install pinia
npm install vue-sweetalert2
npm install postcss
npm install gsap
npm install vue-data-ui
npm install bootstrap
npm install @vueuse/core
npm install -g @vue/cli
npm install vuex

-- 7/11/2024
UPDATE products
SET is_featured = 0

-- 7/22/2024
npm install -g npm@10.8.2



-- 8/2/2024 
làm việc với zns zalo 

link các mã lỗi : https://zalo.cloud/zns/guidelines/handle-error-code

Api: link tham khảo: https://zalo.cloud/zns/guidelines/zns-api

api gửi thông tin đon hàng khi user mua thành công 


https://business.openapi.zalo.me/message/template


body:
{
    "phone": "84382252561",
    "template_id": "354647",
    "template_data": {
       "order_code": "order_code",
        "date": "01/08/2020",
        "price": 100,
        "name": "nguyễn văn quangv",
        "payment": "payment"
    }, 
}