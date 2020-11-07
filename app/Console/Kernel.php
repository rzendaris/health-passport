<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\Controller;
use Log;
use App\User;

use App\Model\Table\DownloadApps;
use App\Model\Table\Apps;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $users = DownloadApps::select(['end_users_id'])->groupBy('end_users_id')->get();
            foreach($users as $user){
                $sequence = 0;
                $downloaded_apps = DownloadApps::where('end_users_id', $user->end_users_id)->groupBy('apps_id')->get();
                foreach($downloaded_apps as $downloaded_app){
                    $main_app = Apps::where('id', $downloaded_app->apps_id)->first();
                    if($downloaded_app->version != $main_app->version){
                        $sequence++;
                    }
                }
                if($sequence > 0){
                    $user_info = User::where('id', $user->end_users_id)->first();
                    if($user_info->notification_id != NULL){
                        $title = "Pemberitahuan";
                        $body = $sequence." aplikasi perlu pembaruan";
                        $controller = new Controller;
                        $controller->PushNotification($user_info->notification_id, $title, $body);
                    }
                }
            }
            // your schedule code
            Log::info('Scheduler Working '. json_encode($users));
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
