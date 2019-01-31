<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ViewCommand extends Command
{

    protected $views_directory;
    protected $new_path = '';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create empty blade file for some view';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->views_directory = str_replace('\\', '/', resource_path() . '/' . 'views' . '/');
    }

    public function createViewFile()
    {
        $segments = explode('/', $this->argument('view'));
        $this->scanner($segments, 0);
    }

    private function stepDeep(&$segments, $i)
    {
        $this->views_directory .= $segments[$i] . '/';

        $i++;
        $this->scanner($segments, $i);
    }

    private function scanner(&$segments, $i)
    {
        if (array_key_exists($i, $segments)) {
            if (is_dir($this->views_directory . $segments[$i])) {
                $this->stepDeep($segments, $i);
            }
            elseif (is_file($this->views_directory . $segments[$i] . '.blade.php')) {
                $this->warn('This file already exist!');
            }
            elseif (!is_dir($this->views_directory . $segments[$i] && !is_file($this->views_directory . $segments[$i])) && array_key_exists(($i + 1), $segments)) {
                $this->createDirectory($segments, $i);
            }
            else {
                $this->createFile($this->views_directory . $segments[$i] . '.blade.php');
            }
        }
    }

    private function createDirectory(&$segments, $i)
    {
        $dir = $this->views_directory . $segments[$i];
        
        mkdir(str_replace('/', DIRECTORY_SEPARATOR, $dir));
        $info = str_replace('/', DIRECTORY_SEPARATOR, $dir);
        $this->line("Directory \"$info\" created successifull.");
        
        $this->views_directory .= $segments[$i] . '/';
        $i++;
        $this->scanner($segments, $i);
    }

    private function createFile($file)
    {
        file_put_contents($file, '');
        $filename = array_last(explode('/', $file));
        $this->line("File \"$filename\" created successifull.");
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createViewFile();
    }

}
