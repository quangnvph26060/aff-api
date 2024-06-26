<?php

namespace App\Services;

use App\Models\Config;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ConfigService
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        try {
            Log::info('Fetching all configuration');
            return Config::first();
        } catch (Exception $e) {
            Log::error('Failed to fetch configuration: ' . $e->getMessage());
            throw new Exception('Failed to fetch configuration');
        }
    }

    public function updateConfig(array $data): Config
    {
        try {
            // Fetch the configuration record (assuming there's only one)
            $config = Config::first();

            if (!$config) {
                throw new Exception('Configuration record not found.');
            }

            // Begin transaction for database operations
            DB::beginTransaction();

            try {
                // Handle logo updates
                if (isset($data['logo'])) {
                    foreach ($data['logo'] as $logo) {
                        $logoImage = $logo;
                        $logoFileName = 'image_' . time() . '_' . $logoImage->getClientOriginalName();
                        $logoFilePath = 'public/images/' . $logoFileName; // Storage path
                        Storage::putFileAs('public/images', $logoImage, $logoFileName); // Store image
                        $config->logo = $logoFilePath; // Update logo path in database
                    }
                }

                // Handle login banner updates similarly
                if (isset($data['login_banner'])) {
                    foreach ($data['login_banner'] as $banner) {
                        $bannerImage = $banner;
                        $bannerFileName = 'image_' . time() . '_' . $bannerImage->getClientOriginalName();
                        $bannerFilePath = 'public/images/' . $bannerFileName; // Storage path
                        Storage::putFileAs('public/images', $bannerImage, $bannerFileName); // Store image
                        $config->login_banner = $bannerFilePath; // Update login banner path in database
                    }
                }

                // Update other fields in the configuration record
                $config->name = $data['name'];
                $config->email = $data['email'];
                $config->phone = $data['phone'];
                $config->policy = $data['policy'];

                // Save the updated configuration record
                $config->save();

                // Commit the transaction
                DB::commit();

                return $config;
            } catch (Exception $e) {
                // Rollback the transaction on error
                DB::rollback();
                Log::error("Failed to update configuration: {$e->getMessage()}");
                throw new Exception('Failed to update configuration: ' . $e->getMessage());
            }
        } catch (Exception $e) {
            Log::error('Failed to fetch configuration: ' . $e->getMessage());
            throw new Exception('Failed to fetch configuration');
        }
    }

}
