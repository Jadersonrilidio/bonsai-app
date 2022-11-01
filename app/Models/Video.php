<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'videos';

    /**
     * The attributes allowed to manipulate by eloquent.
     * 
     * @var array
     */
    protected $fillable = [
        'plant_id',
        'video'
    ];

    /**
     * 
     */
    public function rules()
    {
        return array(
            'plant_id' => 'required|exists:plants,id',
            'video'    => 'required|file|mimes:mp4'
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
        return $this->belongsTo('App\Models\Plant', 'plan_id', 'id');
    }
}
