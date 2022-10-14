<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionClassification extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'intervention_classifications';

    /**
     * The attributes allowed to manipulate by eloquent.
     * 
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * 
     */
    public function rules()
    {
        return array(
            'title' => "required|unique:intervention_classifications,id,{$this->id}" //TODO
        );
    }

    /**
     * 
     */
    public function feedback()
    {
        return array(
            'title.required' => 'The title is required',
            'title.unique'   => 'The title must be unique'
        );
    }

    /**
     * 
     */
    public function interventions()
    {
        return $this->belongsToMany('App\Models\Intervention', 'interventions', 'intervention_classification_id', 'id');
    }
}
