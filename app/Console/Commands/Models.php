<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Models extends Command
{

    private $models_ucfirst    = [];
    private $models_strtolower = [];
    private $models            = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show relationships for all models';

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
     * remove ' ' and ',' from the right side of the string.
     * @param type $dataForTriming
     */
    public function trimmer(&$dataForTriming)
    {
        $dataForTriming = rtrim(rtrim($dataForTriming, ' '), ',');
    }

    public function setHasOne($model)
    {
        $class1 = 'App\\' . ucfirst($model);
        $m1     = new $class1();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $m2)) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model)) {
                    $this->models[$model]['hasOne'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->trimmer($this->models[$model]['hasOne']);
    }

    public function setHasMany($model)
    {
        $class1 = 'App\\' . ucfirst($model);
        $m1     = new $class1();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $m2 . 's') || method_exists($m1, $m2 . 'ses')) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model)) {
                    $this->models[$model]['hasMany'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->trimmer($this->models[$model]['hasMany']);
    }

    public function setBelongsTo($model)
    {
        $class1 = 'App\\' . ucfirst($model);
        $m1     = new $class1();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $m2)) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model . 's') || \method_exists($m3, $model . 'ses')) {
                    $this->models[$model]['belongsTo'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->trimmer($this->models[$model]['belongsTo']);
    }

    public function setBelongsToMany($model)
    {
        $class1 = 'App\\' . ucfirst($model);
        $m1     = new $class1();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $m2 . 's')) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model . 's') || \method_exists($m3, $model . 'ses')) {
                    $this->models[$model]['belongsToMany'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->trimmer($this->models[$model]['belongsToMany']);
    }

    public function setMorphTo($model)
    {
        $class1 = 'App\\' . ucfirst($model);
        $m1     = new $class1();
        foreach ($this->models_strtolower as $m2)
        {
            if (\method_exists($m1, $m2) || \method_exists($m1, $m2 . 's') || \method_exists($m1, $m2 . 'ses')) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (method_exists($m3, $m2 . 'able')) {
                    $this->models[$model]['morphTo'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->trimmer($this->models[$model]['morphTo']);
    }

    public function setAble($model)
    {
        $class1 = 'App\\' . ucfirst($model);
        $m1     = new $class1();
        foreach ($this->models_strtolower as $m2)
        {
            if (method_exists($m1, $model . 'able')) {
                $class2 = 'App\\' . ucfirst($m2);
                $m3     = new $class2();
                if (\method_exists($m3, $model) || \method_exists($m3, $model . 's') || \method_exists($m3, $model . 'ses')) {
                    $this->models[$model]['able'] .= ucfirst($m2) . ', ';
                }
            }
        }
        $this->trimmer($this->models[$model]['able']);
    }

    /**
     * get all models names
     * @return array
     */
    public function getAllModels()
    {
        $models = array_filter(glob(app_path() . DIRECTORY_SEPARATOR . '*'), 'is_file');
        if (\is_dir('App\models')) {
            $models = \array_push(array_filter(glob(app_path() . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . '*'), 'is_file'));
        }
        return (array) $models;
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
            $m                            = explode(DIRECTORY_SEPARATOR, $m);
            $m                            = end($m);
            $m                            = str_replace('.php', '', $m);
            $this->models_ucfirst[]       = [ucfirst($m)];
            $this->models_strtolower[]    = strtolower($m);
            $this->models[strtolower($m)] = [
                'modelName'     => ucfirst($m),
                'hasOne'        => '',
                'hasMany'       => '',
                'belongsTo'     => '',
                'belongsToMany' => '',
                'morphTo'       => '',
                'able'          => ''
            ];
        }
        return $this;
    }

    public function setAllRealationsForCurrentModel($data)
    {
        $this->setHasOne($data);
        $this->setHasMany($data);
        $this->setBelongsTo($data);
        $this->setBelongsToMany($data);
        $this->setMorphTo($data);
        $this->setAble($data);
    }

    public function setAllRelations($data)
    {
        foreach ($data as $model)
        {
            $this->setAllRealationsForCurrentModel($model);
        }
    }

    public function showTableInConsole($data)
    {
        $headers = ['models', '1 -> 1', '1 -> ∞', '∞ -> 1', '∞ -> ∞', '1 -> morph', 'morph -> ∞'];
        $rows    = $data;

        $this->table($headers, $rows);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setAllModels();
        $this->setAllRelations($this->models_strtolower);

        $this->showTableInConsole($this->models);
    }

}
