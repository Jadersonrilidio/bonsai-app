<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonsaiStyle extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bonsai_styles';

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
        return $this->belongsToMany('App\Models\Plant', 'plants', 'bonsai_style_id', 'id');
    }
}
