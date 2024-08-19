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
// hàm lấy lại access_token
 public function refreshAccessToken($refreshToken, $secretKey, $appId)
    {
        $client = new Client();
        try {
            $response = $client->post('https://oauth.zaloapp.com/v4/oa/access_token', [
                'headers' => [
                    'secret_key' => $secretKey
                ],
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                    'app_id' => $appId
                ]
            ]);
    
            $body = json_decode($response->getBody(), true);
    
            if (isset($body['access_token'])) {
                // Lưu access_token mới vào cache
                Cache::put('access_token', $body['access_token'], 3600); // 3600 = 1h
                return $body['access_token'];
            } else {
                throw new \Exception('Failed to refresh access token');
            }
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            Log::error('Failed to refresh access token: ' . $e->getMessage());
            throw new \Exception('Failed to refresh access token');
        }
    }

public function getAccessToken()
{
    // Lấy access_token từ cache
    $accessToken = Cache::get('access_token');

    // Nếu không có access_token trong cache, làm mới nó
    if (!$accessToken) {
        $refreshToken = '7ZAyBpMDW0WIDB8dDOo621imiYSobF4LUcUoIoZSzGDz8OH93TYiObWOu1vmnOfCNGh52mVLytDf6Beu9-lwKtqMYI09yVvROXQlTmJAqmet4ETCM-od1Xy9zt9erCjOCG--ArdeqW4C6eH6KDFURXm6YJjWsi9SB0UH5KZRqNvkExK60iF2BdeZZmKod_mlGtF9L3E3Y1HZVBnFAS3i7WuWZ7OXa-uOMNAzCN6Jq4z2MuCWFUBJVKyjbGuxvDbpG2-tFHhGoazB7va9CVJp8aSSndK9_POVLJYcGI7KopnwF8LrBz2rA78EzMW5peGa8ttiL576c7yuUyKJHPIBMGHJmXbgjlT74MkK86xOv6eyFuCNLeteUmfnbGTuhDfS0adkT7xtXXipEi537ee57pIMYmC';
        $secretKey = 'ZFIg89WL81V2R2Sj3vMd';
        $appId = '2355989370921006107';
        $accessToken = $this->refreshAccessToken($refreshToken, $secretKey, $appId);
    }
    Log::info($accessToken);
    return $accessToken;
}
ném đoạn này vào functuion mua hàng
// Lấy access_token từ cache hoặc làm mới nếu hết hạn
            $accessToken = $this->getAccessToken();
            // Gửi yêu cầu đến API của Zalo ZNS
            try {
                $client = new Client();
                $response = $client->post('https://business.openapi.zalo.me/message/template',[
                    'headers' => [
                        'access_token' => $accessToken, // Thay YOUR_ACCESS_TOKEN bằng access token của bạn
                        'Content-Type' => 'application/json'
                    ],
                    'json' => [
                        'phone' => '84382252561', // Số điện thoại của người nhận
                        'template_id' => '354647', // ID template của ZNS
                        'template_data' => [
                            'order_code' => $order->zip_code ?? "",
                            'date' => "01/08/2020" ?? "",
                            'price' => $order->total_money ?? "",
                            'name' => $order->user_id[0]['name'] ?? "Full Name",
                            'payment' => $order->payment_method === 1 ? " chuyển khoản" : " nhận hàng"
                        ]
                    ]
                ]);
                $responseBody = $response->getBody()->getContents();
                Log::info('Phản hồi API: ' . $responseBody);
                // Kiểm tra phản hồi từ API
                if ($response->getStatusCode() == 200) {
                    Log::info('Gửi ZNS thành công.');
                } else {
                    Log::error('Gửi ZNS thất bại: ' . $response->getBody());
                }
            } catch (\Exception $e) {
                Log::error('Lỗi khi gửi ZNS: ' . $e->getMessage());
            }

-- 8/5/2024

php artisan migrate --path=/database/migrations/2024_08_05_101842_create_aff_settings_table.php
php artisan migrate --path=/database/migrations/2024_08_05_114122_add_is_commission_disabled_to_users_table.php

-- 8/6/2024

php artisan migrate --path=/database/migrations/2024_08_06_111204_create_pending_bonuses_table.php


-- 14/8/2024 
ALTER TABLE commission
ADD COLUMN status INT NOT NULL DEFAULT 1;

-- 19/8/2024
ALTER TABLE products
ADD COLUMN approve_product BOOLEAN DEFAULT FALSE;
