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
        $models = $this->getAllModels();
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
            $this->model['morphTo']       = '';
            $this->model['able']          = '';
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
        $this->trimmer($this->model['hasOne']);
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
        $this->trimmer($this->model['hasMany']);
    }

    public function setBelongsTo($model)
    {
        $m1 = new $this->modelFull();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $m2)) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model . 's') || \method_exists($m3, $model . 'ses')) {
                    $this->model['belongsTo'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->trimmer($this->model['belongsTo']);
    }

    public function setBelongsToMany($model)
    {
        $m1 = new $this->modelFull();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $m2 . 's')) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model . 's') || \method_exists($m3, $model . 'ses')) {
                    $this->model['belongsToMany'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->trimmer($this->model['belongsToMany']);
    }

    public function setMorphTo($model)
    {
        $m1 = new $this->modelFull();
        foreach ($this->models_strtolower as $m2)
        {
            if (\method_exists($m1, $m2) || \method_exists($m1, $m2 . 's') || \method_exists($m1, $m2 . 'ses')) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (method_exists($m3, $m2 . 'able')) {
                    $this->model['morphTo'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->trimmer($this->model['morphTo']);
    }
    
    public function setAble($model)
    {
        $m1 = new $this->modelFull();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $model . 'able')) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model) || \method_exists($m3, $model . 's') || \method_exists($m3, $model . 'ses')) {
                    $this->model['able'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->trimmer($this->model['able']);
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
            $this->setAllRealationsForCurrentModel($this->model['modelName']);
            $this->showTableInConsole([$this->model]);
        }
        else {
            $this->error('Model ' . $this->modelFull . ' not found');
        }
    }

}
