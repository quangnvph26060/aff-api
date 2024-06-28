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