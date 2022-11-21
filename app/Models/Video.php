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
     * Model's validation rules.
     * 
     * @return array
     */
    public function rules()
    {
        return array(
            'plant_id' => 'required|exists:plants,id',
            'video'    => 'required|file|mimeTypes:video/mp4'
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
     * Model's relationship with plants table.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plant()
    {
        return $this->belongsTo('App\Models\Plant', 'plant_id', 'id');
    }
}
