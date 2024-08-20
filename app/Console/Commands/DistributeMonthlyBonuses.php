<?php

namespace App\Console\Commands;

use App\Models\PendingBonus;
use App\Models\UserWallet;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DistributeMonthlyBonuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bonuses:distribute';
 

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Distribute bonuses to users based on their team revenue';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now();
        Log::info($today->day);
        // Chỉ xử lý từ ngày 1 đến ngày 5 của tháng
        if ($today->day >= 1 && $today->day <= 7) {
            Log::info('date: '. date('Y-m-d'));
            $bonuses = PendingBonus::where('eligible_date', '<=', date('Y-m-d'))
                ->where('processed', false)
                ->get();
                Log::info('data:'. $bonuses);
            foreach ($bonuses as $bonus) {
                $wallet = UserWallet::where('user_id', $bonus->user_id)
                    ->where('wallet_id', 1)
                    ->first();

                if ($wallet) {
                    $wallet->update(['total_revenue' => $wallet->total_revenue + $bonus->amount]);
                    $bonus->update(['processed' => true]);
                }
            }
        }
    
    }
}
