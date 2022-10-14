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
        //TODO
    }

    /**
     * 
     */
    public function feedback()
    {
        //TODO
    }
}
