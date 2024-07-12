<?php

namespace App\Services;

use App\Jobs\SendMail;
use App\Models\Brand;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


/**
 * Summary of BrandService
 */
class BrandService
{

    protected $brand;
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function getAllBrand(): \Illuminate\Database\Eloquent\Collection
    {
        try {
            Log::info('Fetching all categories');
            $categories = $this->brand->all();
            return $categories;
        } catch (Exception $e) {
            Log::error('Failed to fetch brand: ' . $e->getMessage());
            throw new Exception('Failed to fetch brand');
        }
    }

    /**
     * Summary of createBrand
     * @param array $data
     * @throws Exception
     * @return Brand
     */
    public function createBrand(array $data): Brand
    {
        // dd($data);
        DB::beginTransaction();
        try {

            Log::info("Creating a new Brand with name: {$data['name']}");
            $image = $data['images'];
            $filename = 'image_' . $image->getClientOriginalName();
            $filePath = 'storage/brand/' . $filename;
            if (!Storage::exists($filePath)) {
                $image->storeAs('public/brand', $filename);
            }
            Storage::putFileAs('public/brand', $image, $filename);
            $is_password = $this->generatePassword();
            $brand = $this->brand->create([
                'name' => $data['name'],
                'logo' => $filePath,
                'email' => $data['email'],
                'phone' => @$data['phone'],
                'address' => $data['address'],
                'role_id' => 4,
                'password' => $is_password,
            ]);
            // mail register brand
            $arrSendMail = [
                'type'              =>  'register_brand',
                'data'              =>  $brand,
                'password_mail'     =>  $is_password,
            ];
            SendMail::dispatch($arrSendMail)->afterCommit(); ; 
            DB::commit();
            return $brand;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to create Brand: {$e->getMessage()}");
            throw new Exception('Failed to create Brand');
        }
    }
    public function generatePassword(): string
    {
        $length     = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password   = '';

        do {
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while (!preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])/', $password));

        return $password;
    }
    public function getBrandById(int $id): Brand
    {
        Log::info("Fetching product with ID: $id");
        $brand = $this->brand->find($id);

        if (!$brand) {
            Log::warning("Product with ID: $id not found");
            throw new ModelNotFoundException("Product not found");
        }
        return $brand;
    }

    public function updateBrand(int $id, array $data): Brand
    {


        DB::beginTransaction();
        try {
            $brand = $this->getBrandById($id);
            Log::info("Updating product with ID: $id");

            if (!empty($data['images'])) {
                $image = $data['images'];
                $filename = 'image_' . $image->getClientOriginalName();
                $filePath = 'storage/brand/' . $filename;
                if (!Storage::exists($filePath)) {
                    $image->storeAs('public/brand', $filename);
                }
                $update = $brand->update([
                    'name' => $data['name'],
                    'logo' => $filePath,
                    'email' => $data['email'],
                    'phone' => @$data['phone'],
                    'address' => $data['address'],
                ]);
            }else{
                $update = $brand->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => @$data['phone'],
                    'address' => $data['address'],
                ]);
            }


            DB::commit();
            return $brand;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to update brand: {$e->getMessage()}");
            throw new Exception('Failed to update brand');
        }
    }

    public function brandtByName($name): \Illuminate\Database\Eloquent\Collection
    {
        try {
            $brand = $this->brand->where('name', 'LIKE', '%' . $name . '%')->get();
            return $brand;
        } catch (Exception $e) {
            Log::error("Failed to search products: {$e->getMessage()}");
            throw new Exception('Failed to search products');
        }
    }
}
