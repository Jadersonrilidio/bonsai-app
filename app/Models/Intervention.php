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
        return array(
            'plant_id'                       => 'required|exists:plants,id',
            'intervention_classification_id' => 'required|exists:intervention_classifications,id',
            'date'                           => 'required|date',
            'description'                    => ''
        );
    }

    /**
     * 
     */
    public function feedback()
    {
        return array();
    }

    /**
     * 
     */
    public function plant()
    {
        return $this->hasOne('App\Models\Plant', 'id', 'plant_id');
    }

    /**
     * 
     */
    public function interventionClassification()
    {
        return $this->hasOne('App\Models\InterventionClassification', 'id', 'intervention_classification_id');
    }

    /**
     * 
     */
    public function observations()
    {
        return $this->belongsTo('App\Models\Observation', 'intervention_id', 'id');
    }
}
