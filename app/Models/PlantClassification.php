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
        return array(
            'title' => "required|unique:plant_classifications,title,{$this->id}" //TODO
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
    public function plants()
    {
        return $this->belongsToMany('App\Models\Plant', 'plants', 'plant_classification_id', 'id');
    }
}
