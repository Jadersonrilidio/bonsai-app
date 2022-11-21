<?php

namespace App\Repositories;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;

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
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Filter all registers in the model.
     * 
     * @param  array  $filters
     * @return \App\Repositories\Repository
     */
    public function filterRegistersFromModel(array $filters)
    {
        if ($this->validateArray($filters))
            foreach ($filters as $filter)
                $this->model = $this->model->where($filter[0], $filter[1], $filter[2]);

        return $this;
    }

    /**
     * Set the columns to retrieve from the model.
     * 
     * @param  array  $attr
     * @return \App\Repositories\Repository
     */
    public function selectColumnsFromModel(array $attr)
    {
        if ($this->validateArray($attr))
            $this->model = $this->model->select($attr);

        return $this;
    }

    /**
     * Set the coulmns to retrieve from the respective relation.
     * 
     * @param  string  $query
     * @return \App\Repositories\Repository
     */
    public function selectColumnsFromRelationship(string $query)
    {
        if ($this->validateString($query))
            $this->model = $this->model->with($query);

        return $this;
    }

    /**
     * Return the current model's builder.
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getBuilder()
    {
        return $this->model;
    }

    /**
     * Return the model's objects collection matcht.
     * 
     * @return \Illuminate\Database\Schema\Collection
     */
    public function getCollection()
    {
        return $this->model->get();
    }

    /**
     * Return the model's object collection matcht as a paginated object.
     * 
     * @param  int  $registersPerPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedCollection(int $registersPerPage = 10)
    {
        return $this->model->paginate($registersPerPage);
    }

    /**
     * Assure whether is a valid array argument or not.
     * 
     * @param  array  $arg
     * @return bool
     */
    private function validateArray($arg)
    {
        return (empty($arg) or !is_array($arg))
            ? false
            : true;
    }

    /**
     * Assure whether is a valid string argument or not.
     * 
     * @param  string  $arg
     * @return bool
     */
    private function validateString($arg)
    {
        return (empty($arg) or !is_string($arg))
            ? false
            : true;
    }
}
