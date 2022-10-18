<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantClassificationRequest;
use App\Http\Requests\UpdatePlantClassificationRequest;
use App\Models\PlantClassification;

use \Illuminate\Http\Request;
use App\Repositories\PlantClassificationRepository;
use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;

/**
 * Controller class for api routes of model PlantClassification
 * 
 * @method index(Request $request) : JsonResponse
 * @method store(StorePlantClassificationRequest $request) : JsonResponse
 * @method show(integer $id) : JsonResponse
 * @method update(UpdatePlantClassificationRequest $request, integer $id) : JsonResponse
 * @method destroy(integer $id) : JsonResponse
 */
class PlantClassificationController extends Controller
{
    use ErrorResponses, RewriteModelRules;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attr = $request->get('attr') ?? '';
        $filter = $request->get('filter') ?? '';

        $plantClassificationRepository = new PlantClassificationRepository($this->plantClassification);

        if ($filter)
            $plantClassificationRepository->filterRegistersFromModel($filter);

        if ($attr)
            $plantClassificationRepository->selectColumnsFromModel($attr);

        $plantClassifications = $plantClassificationRepository->getCollection();

        return response()->json($plantClassifications, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlantClassificationRequest  $request
     * @return \Illuminate\Http\Response
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plantClassification = $this->plantClassification->find($id);

        if ($plantClassification == null)
            return $this->notFound();

        return response()->json($plantClassification, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlantClassificationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
}
