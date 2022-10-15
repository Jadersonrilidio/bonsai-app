<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\PlantClassification;

class StorePlantClassificationRequest extends FormRequest
{
    /**
     * //TODO
     */
    protected $plantClassification;

    /**
     * //TODO
     */
    public function __construct(PlantClassification $plantClassification)
    {
        $this->plantClassification = $plantClassification;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * //TODO
     *
     * @return array
     */
    public function rules()
    {
        return $this->plantClassification->rules();
    }
}
