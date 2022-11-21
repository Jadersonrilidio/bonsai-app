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
     * Model's validation rules.
     * 
     * @return array
     */
    public function rules()
    {
        return array(
            'plant_classification_id' => 'required|exists:plant_classifications,id',
            'bonsai_style_id'         => 'required|exists:bonsai_styles,id',
            'name'                    => 'required|min:3|max:128',
            'specimen'                => 'string|max:128',
            'age'                     => 'date',
            'description'             => 'string',
            'main_picture'            => 'file|mimes:png,jpeg,jpg',
            'height'                  => 'numeric'
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
     * Model's relationship with users table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Model's relationship with plant_classifications table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantClassification()
    {
        return $this->belongsTo('App\Models\PlantClassification', 'plant_classification_id', 'id');
    }

    /**
     * Model's relationship with bonsai_styles table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bonsaiStyle()
    {
        return $this->belongsTo('App\Models\BonsaiStyle', 'bonsai_style_id', 'id');
    }

    /**
     * Model's relationship with interventions table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interventions($int_class = 'interventionClassification', $obs = 'observations')
    {
        return $this->hasMany('App\Models\Intervention', 'plant_id', 'id')->with($int_class)->with($obs);
    }

    /**
     * Model's relationship with pictures table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pictures()
    {
        return $this->hasMany('App\Models\Picture', 'plant_id', 'id');
    }

    /**
     * Model's relationship with videos table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany('App\Models\Video', 'plant_id', 'id');
    }
}
