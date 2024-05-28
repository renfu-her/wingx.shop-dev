<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('OrderStatus')->everyTenMinutes();
        $schedule->command('InvoiceCheck')->everyTenMinutes();
        // $schedule->command('XmlToJson')->dailyAt('00:00');
        $schedule->command('LogisticsStatus')->everyTenMinutes();
        $schedule->command('app:order-logistics-status')->everyTenMinutes();

        $schedule->call(function () {
            // 確保這段邏輯只在單數月執行
            if (now()->month % 2 == 1) {
                Artisan::call('XmlToJson');
            }
        })->monthlyOn(26, '00:00'); // 每個月的 26 號 00:00 執行
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
