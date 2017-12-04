<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
        $this->command('model:list-r', function() {
            $models     = array_filter(glob(app_path() . DIRECTORY_SEPARATOR . '*'), 'is_file');
            $arrModels  = [];
            $arrModels2 = [];
            foreach ($models as $k => $m)
            {
                $m              = explode(DIRECTORY_SEPARATOR, $m);
                $m              = end($m);
                $str_m          = str_replace('.php', '', $m);
                $arrModels[$k]  = $str_m;
                $arrModels2[$k] = $str_m;
            }

            $this->info("\n");

            $arr_methods = [];
            foreach ($arrModels2 as $m)
            {
                $arr_methods[] = strtolower($m);
                $arr_methods[] = strtolower(str_plural($m));
            }
            foreach ($arrModels as $model)
            {
                $this->info('Model: ' . $model);
                foreach ($arr_methods as $method_name)
                {
                    if (method_exists('App\\' . $model, $method_name)) {
                        if (substr($method_name, -1 == 's') && substr($method_name, -2) != 's') {
                            $method_name = rtrim($method_name, 's');
                        }
                        $method = ucfirst($method_name);
                        $this->info('          |      ______________');
                        $this->info('          |_____| ' . $method);
                        $this->info('                |______________');
                    }
                }

                $this->info("\n");
            }
        });
        
        $this->command('model:list', function() {
            $models     = array_filter(glob(app_path() . DIRECTORY_SEPARATOR . '*'), 'is_file');
            $this->info("\n");
            $i = 0;
            foreach ($models as $k => $m)
            {
                $m              = explode(DIRECTORY_SEPARATOR, $m);
                $m              = end($m);
                $str_m          = str_replace('.php', '', $m);
                $this->info('    ' .$str_m);
                $i++;
            }
            $this->info("_________________");
            $this->info("total models: " . $i);
            $this->info("_________________");
            $this->info("\n");
        });
    }

}
