<?php

namespace App\Services;

use App\Http\Responses\ApiResponse;
use App\Models\Transaction;
use App\Models\Method as ModelsMethod;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Method;

class TransactionService
{
    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

//   all cart
    // public function getAllCart()
    // {
    //     try {
    //         $cart = $this->cart->all();
    //         return $cart;
    //     } catch (Exception $e) {
    //         Log::error('Failed to fetch cart: ' . $e->getMessage());
    //         throw new Exception('Failed to fetch categories');
    //     }
    // }

//    add to cart
    public function addTransaction($data)
    {
        DB::beginTransaction();
        try {
            Log::info("Createing new transaction request");
            $user_id = Auth::user()->id;
            $wallet_id = Wallet::where('name', $data['wallet_type'])->value('id');
            $amount = $data['amount'];
            $method_id = Method::where('name', $data['method'])->value('id');
            // dd($method_id);
            $transaction = $this->transaction->create([
                'wallet_id' => $wallet_id,
                'user_id' => $user_id,
                'amount' => $amount,
                'method_id' => $method_id,
                'status' => 'pending',
            ]);
            // dd($transaction);
            DB::commit();
            return $transaction;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create request: ' . $e->getMessage());
            throw new Exception('Failed to create request');
        }
    }

    /**
     * Hàm cập nhật thông tin của một danh mục
     *
     * @param int $id
     * @param array $data
     * @return Category
     * @throws ModelNotFoundException
     * CreatedBy: youngbachhh (27/05/2024)
     */
//     public function updateCategory(int $id, array $data): Category
//     {
//         DB::beginTransaction();
//         try {
//             Log::info("Updating category with ID: $id");
//             $category = $this->category->findOrFail($id);
//             $category->update($data);
//             DB::commit();
//             return $category;
//         } catch (Exception $e) {
//             DB::rollBack();
//             Log::error('Failed to update category: ' . $e->getMessage());
//             throw new Exception('Failed to update category');
//         }
//     }
//     public function updateCart($id,$data)
//     {
//         DB::beginTransaction();
//         try {
//             $cart = Cart::find($id);
//             if(!$cart){
//                 return ApiResponse::error('Update to cart Error');
//             }
//             $cart->update(
//                 [
//                     'amount' => $data['amount'],
//                 ]
//             );
//             DB::commit();
//         } catch (Exception $e) {
//             DB::rollBack();
//             Log::error('Failed to delete cart: ' . $e->getMessage());
//             throw new Exception('Failed to delete cart');
//         }
//     }

//     public function deleteCart(int $id)
//     {
//         DB::beginTransaction();
//         try {
//             $cart = $this->cart->findOrFail($id);
//             $cart->delete();
//             DB::commit();
//         } catch (Exception $e) {
//             DB::rollBack();
//             Log::error('Failed to delete cart: ' . $e->getMessage());
//             throw new Exception('Failed to delete cart');
//         }
//     }
// }
}
