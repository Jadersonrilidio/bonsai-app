<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'observations';

    /**
     * The attributes allowed to manipulate by eloquent.
     * 
     * @var array
     */
    protected $fillable = [
        'intervention_id',
        'observation'
    ];

    /**
     * Model's validation rules.
     * 
     * @return array
     */
    public function rules()
    {
        return array(
            'intervention_id' => 'required|exists:interventions,id',
            'observation'     => 'required|string'
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
     * Model's relationship with interventions table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function intervention()
    {
        return $this->belongsTo('App\Models\Intervention', 'intervention_id', 'id');
    }
}
