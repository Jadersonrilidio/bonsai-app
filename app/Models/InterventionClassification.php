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
     * Model's validation rules.
     * 
     * @return array
     */
    public function rules()
    {
        return array(
            'title' => "required|unique:intervention_classifications,title,{$this->id}"
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
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interventions()
    {
        return $this->hasMany('App\Models\Intervention', 'intervention_classification_id', 'id');
    }
}
