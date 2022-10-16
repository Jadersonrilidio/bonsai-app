<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pictures';

    /**
     * The attributes allowed to manipulate by eloquent.
     * 
     * @var array
     */
    protected $fillable = [
        'plant_id',
        'picture'
    ];

    /**
     * 
     */
    public function rules()
    {
        return array(
            'plant_id' => 'required|exists:plants,id',
            'picture'  => 'required'
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
        return $this->hasOne('App\Models\Plant', 'id', 'plant_id');
    }
}
