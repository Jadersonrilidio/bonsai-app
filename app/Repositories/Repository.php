<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class Repository
{
    /**
     * Model's instance.
     * 
     * @var Model|Builder
     */
    protected $model;

    /**
     * Repository class constructor method.
     * 
     * @param  Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Filter all registers in the model.
     * 
     * @param  string  $filters
     * @return void
     */
    public function filterRegistersFromModel(string $filters)
    {
        $filters = explode(';', $filters);

        foreach ($filters as $filter) {
            $filter = explode(':', $filter);
            $this->model = $this->model->where($filter[0], $filter[1], $filter[2]);
        }
    }

    /**
     * Set the columns to retrieve from the model.
     * 
     * @param  string  $attr
     * @return void
     */
    public function selectColumnsFromModel(string $attr)
    {
        $attr = explode(',', $attr);
        array_push($attr, 'id');

        $this->model = $this->model->select($attr);
    }

    /**
     * Set the coulmns to retrieve from the respective relation.
     * 
     * @param  string  $relationship
     * @param  string  $attr
     * @return void
     */
    public function selectColumnsFromRelationship(string $relationship, string $attr = '')
    {
        $query = ($attr and $attr != '')
            ? $relationship . ':id,' . $attr
            : $relationship;

        $this->model = $this->model->with($query);
    }

    /**
     * Return the model's objects collection matcht.
     * 
     * @return Illuminate\Database\Schema\Collection
     */
    public function getCollection()
    {
        return $this->model->get();
    }

    /**
     * Return the model's object collection matcht as a paginated object.
     * 
     * @param  int  $registersPerPage
     * @return Illuminate\Database\Schema\Collection
     */
    public function getPaginatedCollection(int $registersPerPage = 10)
    {
        return $this->model->paginate($registersPerPage);
    }
}
