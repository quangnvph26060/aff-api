<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Config;

class ConfigComposer
{
    public function compose(View $view)
    {
        // Retrieve the first config record from the database
        $config = Config::first();

        // Ensure the config data is available and is an object
        if ($config && is_object($config)) {
            $view->with('config', $config);
        }
        else {
            // Handle the case where config is not available
            $view->with('config', (object) [
                'logo' => null,
                'login_banner' => null,
                'name' => null,
                'policy' => null,
                'email' => null,
                'phone' => null,
            ]);
        }
    }
}
?>
