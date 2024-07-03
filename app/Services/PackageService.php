<?php

namespace App\Services;

use App\Models\Packages;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

/**
 * Summary of BrandService
 */
class PackageService
{
    protected $package;

    public function __construct(Packages $package)
    {
        $this->package = $package;
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
                'name'   => $data['name'] ?? "",
                'price'  => $data['price'] ?? "",
                'status' => $data['status'] ?? "",
                'image' => $filename ?? "",
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
                'name'   => $data['name'] ?? "",
                'price'  => $data['price'] ?? "",
                'status' => $data['status'] ?? "",
                'image'  => $data['images'] ?? "",
            ]);

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update package', ['error' => $e->getMessage()]);
            throw new Exception('Failed to update package');
        }
    }


}
