<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Models extends Command
{

    private $models_strtolower = [];
    private $models_ucfirst    = [];
    private $tableWidth        = 0;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'models{--r|relationships}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show info for models';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * set all models from default location "app\"
     * 
     * @return $this
     */
    private function setAllModels()
    {
        $models = array_filter(glob(app_path() . DIRECTORY_SEPARATOR . '*'), 'is_file');
        foreach ($models as $m)
        {
            $m                         = explode('\\', $m);
            $m                         = end($m);
            $m                         = str_replace('.php', '', $m);
            $this->tableWidth          = $this->tableWidth <= strlen($m) ? strlen($m) : $this->tableWidth;
            $this->models_ucfirst[]    = ucfirst($m);
            $this->models_strtolower[] = strtolower($m);
        }

        return $this;
    }

    private function dashes()
    {
        $dashes = '+----------';
        for($i=0;$i<=$this->tableWidth;$i++){
            $dashes .= '-';
        }
        $dashes .= '+';
        
        return $dashes;
    }
    
    private function generateViewTable()
    {
        $this->info("\n");
        $this->info($this->dashes());
        $this->info('|     models:');
        $this->info($this->dashes());
        $this->info('|');
        $this->info($this->dashes());
        $i = 0;
        foreach ($this->models_ucfirst as $m)
        {
            
            $this->info('|        ' . $m);
            $this->info($this->dashes());
            $i++;
        }
        $this->info("|");
        $this->info($this->dashes());
        $this->info("|  total models: " . $i);
        $this->info($this->dashes());
        $this->info("\n");
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setAllModels();
        $this->generateViewTable();
    }

}
