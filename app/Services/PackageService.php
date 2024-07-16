<?php

namespace App\Services;

use App\Events\NewOrderEvent;
use App\Jobs\SendMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Packages;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

/**
 * Summary of BrandService
 */
class PackageService
{
    protected $package;
    protected $order;
    protected $orderDetail;

    public function __construct(Packages $package, Order $order, OrderDetail $orderDetail)
    {
        $this->package = $package;
        $this->order   = $order;
        $this->orderDetail = $orderDetail;
    }
    /**
     * Summary of createBrand
     * @param array $data
     * @throws Exception
     * @return Packages
     */
    public function store(array $data)
    {
        DB::beginTransaction();
        try {

            unset($data['_token']);

            $file = $data['images'];
            $filePath = uploadFile('package', $file);
            $filename = 'storage/' . $filePath;

            if (!Storage::disk('public')->exists('package/' . $filePath)) {
                $filePath = uploadFile('package', $file);
                $filename = 'storage/' . $filePath;
            }

            // Insert data into the database
            $result = $this->package->insert([
                'name'          => $data['name'] ?? "",
                'price'         => $data['price'] ?? "",
                'status'        => $data['status'] ?? "",
                'note'          => $data['description'] ?? "",
                'image'         => $filename ?? "",
                'reduced_price' => $data['reduced_price'],
            ]);

            DB::commit();
            Log::info($result);
            return $result;
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Failed to store package', ['error' => $e->getMessage()]);
            throw new Exception('Failed to store package');
        }
    }
    public function update(array $data, $id)
    {
        DB::beginTransaction();
        try {
            unset($data['_token']);


            if (is_string($data['images'])) {
                $filename = $data['images']; 
            } else {
                // Xử lý file ảnh
                $file = $data['images'];
                $filePath = uploadFile('package', $file);
                $filename = 'storage/' . $filePath;

                // Kiểm tra và cập nhật đường dẫn ảnh
                if (!Storage::disk('public')->exists('package/' . $filePath)) {
                    $filePath = uploadFile('package', $file);
                    $filename = 'storage/' . $filePath;
                }
            }

            $data['images'] = $filename;

            // Cập nhật dữ liệu vào cơ sở dữ liệu
            $result = $this->package->where('id', $id)->update([
                'name'          => $data['name'] ?? "",
                'price'         => $data['price'] ?? "",
                'status'        => $data['status'] ?? "",
                'image'         => $data['images'] ?? "",
                'note'          => $data['description'] ?? "",
                'reduced_price' => $data['reduced_price'] ?? "",
            ]);

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update package', ['error' => $e->getMessage()]);
            throw new Exception('Failed to update package');
        }
    }
    // order package 
    public function createOrder($data)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $user_id = $user->id;
            $receive_address = $data['receive_address'];
            $total_money = $data['total_money'];
            $order = $this->order->create([
                'user_id' => $user_id,
                'receive_address' => $receive_address,
                'note' => null,
                'total_money' => $total_money,
                'status' => 1,
                'name' => $data['name'],
                'phone' => $data['phone'],
                'zip_code' => $data['zip_code'],
                'notify' => 0,
            ]);
            if (!$order) {
                return response()->json('error', 'Order package error');
            }

                $this->orderDetail->create([
                    'order_id' => $order->id,
                    'package_id' => $data['package_id'],
                    'quantity' => 1,
                ]);
                Log::info($order->orderDetailPackage);
            $arrSendMail = [
                'type' => 'send_order',
                'user' => $user,
                'order' => $order->orderDetailPackage,
            ];
            SendMail::dispatch($arrSendMail); // send email to  user order
            event(new NewOrderEvent()); // notify to admin

            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create new order: ' . $e->getMessage());
            throw new Exception('Failed to create new order');
        }
    }


}
