<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Factories extends Command
{

    private $factories = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:factories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show all factories files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllFactories()
    {
        $factories = array_filter(glob('database' . DIRECTORY_SEPARATOR . 'factories' . DIRECTORY_SEPARATOR . '*'), 'is_file');
        foreach($factories as $factory){
            $this->factories[] = $factory;
        }
    }

    public function showTableInConsole()
    {
        $this->table(['factories'], $this->factories);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->getAllFactories();
        $this->showTableInConsole();
    }

}
