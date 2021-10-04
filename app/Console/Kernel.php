<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

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
    protected function schedule(Schedule $schedule){
        /*Recuperando o arquivo do log*/
        $log = file_get_contents(public_path().'/log_acesso.txt');
        
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            $items = DB::table('url')->select('id','url')->get();

            foreach($items as $item){
                $status = self::getStatusUrl($item->url);

                DB::table('url')
                ->where('id', $item->id)
                ->update([
                            'status'     => $status,
                            'verificado' => 'Sim'
                        ]);

                $txt_log = "Link: ".$item->url.", Status: ".$status.", Horário: ".NOW().PHP_EOL;

                file_put_contents(public_path().'/log_acesso.txt', $txt_log, FILE_APPEND);
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(){
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    private function getStatusUrl(String $url){
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,15);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpcode;
    }
}
