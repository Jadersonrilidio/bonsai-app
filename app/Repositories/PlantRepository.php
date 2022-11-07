<?php

namespace App\Repositories;

use \App\Repositories\Repository;

class PlantRepository extends Repository
{
    /**
     * Overriding parent class constructor method.
     * 
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function __construct($model)
    {
        $this->model = ($model->id)
            ? $model->where('id', '=', $model->id)
            : $model;
    }
}
