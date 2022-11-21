<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\SetRequestInputs;
use App\Http\Requests\StorePlantClassificationRequest;
use App\Http\Requests\UpdatePlantClassificationRequest;
use App\Models\PlantClassification;
use App\Repositories\PlantClassificationRepository;
use \Illuminate\Http\Request;

class PlantClassificationController extends Controller
{
    use ErrorResponses,
        RewriteModelRules,
        SetRequestInputs;

    /**
     * PlantClassification model instance.
     * 
     * @var App\Models\PlantClassification
     */
    protected $plantClassification;

    /**
     * Response header options.
     * 
     * @var array
     */
    protected $headerOptions = array();

    /** 
     * PlantClassificationController class constructor method.
     * 
     * @param  App\Models\PlantClassification  $plantClassification
     * @return void
     */
    public function __construct(PlantClassification $plantClassification)
    {
        $this->middleware('auth.jwt');
        $this->plantClassification = $plantClassification;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $this->setRequestQueryParams($request);
        extract($data);

        $plantClassificationRepository = new PlantClassificationRepository($this->plantClassification);

        $plantClassificationRepository
            ->filterRegistersFromModel($filter)
            ->selectColumnsFromModel($attr)
            ->selectColumnsFromRelationship($plant_attr);

        $plantClassifications = $plantClassificationRepository->getCollection();

        return response()->json($plantClassifications, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlantClassificationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePlantClassificationRequest $request)
    {
        $request->validate($this->plantClassification->rules(), $this->plantClassification->feedback());

        $newPlantClassification = $this->plantClassification->create($request->all());

        return response()->json($newPlantClassification, 201, $this->headerOptions);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $plantClassification = $this->plantClassification;

        $data = $this->setRequestQueryParams($request);
        extract($data);

        if ($attr)
            $plantClassification = $plantClassification->select($attr);

        if ($plant_attr)
            $plantClassification = $plantClassification->with($plant_attr);

        $plantClassification = $plantClassification->find($id);

        if ($plantClassification == null)
            return $this->notFound();

        return response()->json($plantClassification, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlantClassificationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePlantClassificationRequest $request, $id)
    {
        $plantClassification = $this->plantClassification->find($id);

        if ($plantClassification == null)
            return $this->notFound();

        $rules = $this->rewriteRules($request, $plantClassification);

        $request->validate($rules, $plantClassification->feedback());

        $plantClassification->fill($request->all());
        $plantClassification->save();

        return response()->json($plantClassification, 200, $this->headerOptions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $plantClassification = $this->plantClassification->find($id);

        if ($plantClassification == null)
            return $this->notFound();

        $deletedPlantClassification = $plantClassification;
        $plantClassification->delete();

        return response()->json($deletedPlantClassification, 200, $this->headerOptions);
    }

    /**
     * Set all acceptable request query parameters in a suitable-to-use associative array form.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private function setRequestQueryParams(Request $request)
    {
        $inputs = array(
            'filter'     => $this->setFilters('filter', $request),
            'attr'       => $this->setAttr('attr', $request),
            'plant_attr'  => $this->setRelAttr('plants', 'plant_classification_id', 'plant_attr', $request)
        );

        return $inputs;
    }
}
