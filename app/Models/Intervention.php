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
     * Model's validation rules.
     * 
     * @return array
     */
    public function rules()
    {
        return array(
            'plant_id'                       => 'required|exists:plants,id',
            'intervention_classification_id' => 'required|exists:intervention_classifications,id',
            'date'                           => 'required|date',
            'description'                    => 'string'
        );
    }

    /**
     * Model's rules' feedback.
     * 
     * @return array
     */
    public function feedback()
    {
        return array();
    }

    /**
     * Model's relationship with plants table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plant()
    {
        return $this->belongsTo('App\Models\Plant', 'plant_id', 'id');
    }

    /**
     * Model's relationship with intervention_classifications table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interventionClassification()
    {
        return $this->belongsTo('App\Models\InterventionClassification', 'intervention_classification_id', 'id');
    }

    /**
     * Model's relationship with observations table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function observations()
    {
        return $this->hasMany('App\Models\Observation', 'intervention_id', 'id');
    }
}
