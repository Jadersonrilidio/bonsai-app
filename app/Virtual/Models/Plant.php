<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Plant",
 *     description="Plant item model",
 *     @OA\Json(
 *         name="Plant"
 *     )
 * )
 */
class Plant
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Plant id",
     *     format="int64",
     *     example=1
     * )
     * 
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     title="id",
     *     description="Plant id",
     *     format="int64",
     *     example=1
     * )
     * 
     * @var integer
     */
    public $user_id;

    /**
     * @OA\Property(
     *     title="id",
     *     description="Plant id",
     *     format="int64",
     *     example=1
     * )
     * 
     * @var integer
     */
    public $plant_classification_id;

    /**
     * @OA\Property(
     *     title="id",
     *     description="Plant id",
     *     format="int64",
     *     example=1
     * )
     * 
     * @var integer
     */
    public $bonsai_style_id;

    /**
     * 
     * 
     * @var string
     */
    public $name;

    /**
     * 
     * 
     * @var string
     */
    public $specimen;

    /**
     * 
     * 
     * @var string
     */
    public $description;

    /**
     * 
     * 
     * @var date
     */
    public $age;

    /**
     * 
     * 
     * @var float
     */
    public $height;

    /**
     * 
     * 
     * @var string
     */
    public $main_picture;

    /**
     * 
     * @var timestamp
     */
    public $created_at;

    /**
     * 
     * 
     * @var timestamp
     */
    public $updated_at;

    /**
     * 
     * @var \App\Virtual\Models\User
     */
    public function user()
    {
    }

    /**
     * 
     * 
     * @var \App\Virtual\Models\PlantClassification
     */
    public function plantClassification()
    {
    }

    /**
     * 
     * 
     * @var \App\Virtual\Models\BonsaiStyle
     */
    public function bonsaiStyle()
    {
    }

    /**
     * 
     * 
     * @var array|\App\Virtual\Models\Picture
     */
    public function pictures()
    {
    }

    /**
     * 
     * 
     * @var array|\App\Virtual\Models\Video
     */
    public function videos()
    {
    }

    /**
     * 
     * 
     * @var array|\App\Virtual\Models\Intervention
     */
    public function interventions()
    {
    }
}
