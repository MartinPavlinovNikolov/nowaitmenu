<?php

namespace App\Console\Commands;

use App\Console\Commands\Models;

class Model extends Models
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature       = 'show:model{model : The name of the model}';
    private $models_strtolower = [];
    protected $model           = [];
    protected $modelFull       = [];
    protected $models          = [];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show info for specific model.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function exist()
    {
        if (class_exists($this->modelFull)) {
            return true;
        }
        return false;
    }

    /**
     * set all models from default location "app\"
     * 
     * @return $this
     */
    private function setAllModels()
    {
        $models = array_filter(glob(app_path() . DIRECTORY_SEPARATOR . '*'), 'is_file');
        if (\is_dir('App\models')) {
            $models = \array_push(array_filter(glob(app_path() . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . '*'), 'is_file'));
        }
        foreach ($models as $m)
        {
            $m                            = explode('\\', $m);
            $m                            = end($m);
            $m                            = str_replace('.php', '', $m);
            $this->models_strtolower[]    = strtolower($m);
            $this->model['modelName']     = ucfirst($this->argument('model'));
            $this->model['hasOne']        = '';
            $this->model['hasMany']       = '';
            $this->model['belongsTo']     = '';
            $this->model['belongsToMany'] = '';
        }
        return $this;
    }

    public function setHasOne($model)
    {
        $m1 = new $this->modelFull();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $m2)) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model)) {
                    $this->model['hasOne'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->model['hasOne'] = rtrim($this->model['hasOne'], ' ');
        $this->model['hasOne'] = rtrim($this->model['hasOne'], ',');
    }

    public function setHasMany($model)
    {
        $m1 = new $this->modelFull();
        foreach ($this->models_strtolower as $m2)
        {
            if (\method_exists($m1, $m2 . 's')) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model)) {
                    $this->model['hasMany'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->model['hasMany'] = rtrim($this->model['hasMany'], ' ');
        $this->model['hasMany'] = rtrim($this->model['hasMany'], ',');
    }

    public function setBelongsTo($model)
    {
        $m1 = new $this->modelFull();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $m2)) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model . 's')) {
                    $this->model['belongsTo'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->model['belongsTo'] = rtrim($this->model['belongsTo'], ' ');
        $this->model['belongsTo'] = rtrim($this->model['belongsTo'], ',');
    }

    public function setBelongsToMany($model)
    {
        $m1 = new $this->modelFull();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $m2 . 's')) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model . 's')) {
                    $this->model['belongsToMany'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->model['belongsToMany'] = rtrim($this->model['belongsToMany'], ' ');
        $this->model['belongsToMany'] = rtrim($this->model['belongsToMany'], ',');
    }

    private function setRelationships($data)
    {
        $this->setHasOne($data);
        $this->setHasMany($data);
        $this->setBelongsTo($data);
        $this->setBelongsToMany($data);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (is_dir('App' . DIRECTORY_SEPARATOR . 'models')) {
            $this->modelFull = 'App' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . ucfirst($this->argument('model'));
        }
        else {
            $this->modelFull = 'App' . DIRECTORY_SEPARATOR . ucfirst($this->argument('model'));
        }

        if ($this->exist()) {
            $this->setAllModels();
            $this->setRelationships($this->model['modelName']);
            $headers = ['models', '1 -> 1', '1 -> ∞', '∞ -> 1', '∞ -> ∞'];
            $rows    = [$this->model];

            $this->table($headers, $rows);
        }
        else {
            $this->error('Model ' . $this->modelFull . ' not found');
        }
    }

}
