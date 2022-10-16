<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plants';

    /**
     * The attributes allowed to manipulate by eloquent.
     * 
     * @var array
     */
    protected $fillable = [
        'user_id',
        'plant_classification_id',
        'bonsai_style_id',
        'name',
        'specimen',
        'age',
        'description',
        'main_picture',
        'height'
    ];

    /**
     * 
     */
    public function rules()
    {
        return array(
            'user_id'                 => 'required|exists:users,id',
            'plant_classification_id' => 'required|exists:plant_classifications,id',
            'bonsai_style_id'         => 'required|exists:bonsai_styles,id',
            'name'                    => 'required|min:3|max:64',
            'specimen'                => 'string|max:128',
            'age'                     => 'date',
            'description'             => 'string',
            'main_picture'            => 'file|mimes:png,jpeg,jpg',
            'height'                  => 'numeric'
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
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    /**
     * 
     */
    public function plantClassification()
    {
        return $this->hasOne('App\Models\PlantClassification', 'id', 'plant_classification_id');
    }

    /**
     * 
     */
    public function bonsaiStyle()
    {
        return $this->hasOne('App\Models\BonsaiStyle', 'id', 'bonsai_style_id');
    }

    /**
     * 
     */
    public function interventions()
    {
        return $this->belongsTo('App\Models\Intervention', 'plant_id', 'id');
    }

    /**
     * 
     */
    public function pictures()
    {
        return $this->belongsTo('App\Models\Picture', 'plant_id', 'id');
    }

    /**
     * 
     */
    public function videos()
    {
        return $this->belongsTo('App\Models\Video', 'plant_id', 'id');
    }
}
