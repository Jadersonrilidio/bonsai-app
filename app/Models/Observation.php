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
     * 
     */
    public function rules()
    {
        return array(
            'intervention_id' => 'required|exists:interventions,id',
            'observation'     => 'required|string'
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
    public function intervention()
    {
        return $this->belongsTo('App\Models\Intervention', 'intervention_id', 'id');
    }
}
