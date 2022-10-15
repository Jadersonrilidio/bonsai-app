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
        return array(
            'title' => "required|unique:bonsai_styles,title,{$this->id}"
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
        return $this->belongsToMany('App\Models\Plant', 'plants', 'bonsai_style_id', 'id');
    }
}
