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
     * Model's validation rules.
     * 
     * @return array
     */
    public function rules()
    {
        return array(
            'title' => "required|unique:bonsai_styles,title,{$this->id}"
        );
    }

    /**
     * Model's rules' feedback.
     * 
     * @return array
     */
    public function feedback()
    {
        return array(
            'title.required' => 'The title is required',
            'title.unique'   => 'The title must be unique'
        );
    }

    /**
     * Model's relationship with plants table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plants()
    {
        return $this->hasMany('App\Models\Plant', 'bonsai_style_id', 'id');
    }
}
