<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'interventions';

    /**
     * The attributes allowed to manipulate by eloquent.
     * 
     * @var array
     */
    protected $fillable = [
        'plant_id',
        'intervention_classification_id',
        'date',
        'description'
    ];

    /**
     * 
     */
    public function rules()
    {
        //TODO
    }

    /**
     * 
     */
    public function feedback()
    {
        //TODO
    }

    /**
     * 
     */
    public function plant()
    {
        return $this->hasOne('App\Models\Plant', 'plant_id', 'id');
    }

    /**
     * 
     */
    public function interventionClassification()
    {
        return $this->hasOne('App\Models\InterventionClassification', 'intervention_classification_id', 'id');
    }

    /**
     * 
     */
    public function observations()
    {
        return $this->belongsToMany('App\Models\Observation', 'observations', 'intervention_id', 'id');
    }
}

