<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantClassification extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plant_classifications';

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
    public function plants()
    {
        return $this->belongsToMany('App\Models\Plant', 'plants', 'plant_classification_id', 'id');
    }
}
