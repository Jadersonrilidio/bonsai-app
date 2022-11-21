<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\SetRequestInputs;
use App\Http\Requests\StoreInterventionClassificationRequest;
use App\Http\Requests\UpdateInterventionClassificationRequest;
use App\Models\InterventionClassification;
use App\Repositories\InterventionClassificationRepository;
use Illuminate\Http\Request;

class InterventionClassificationController extends Controller
{
    use ErrorResponses,
        RewriteModelRules,
        SetRequestInputs;

    /**
     * InterventionClassification model instance.
     * 
     * @var App\Models\InterventionClassification
     */
    protected $interventionClassification;

    /**
     * Response header options.
     * 
     * @var array
     */
    protected $headerOptions =  array();

    /**
     * InterventionClassificationController class constructor method.
     * 
     * @param  App\Models\InterventionClassification  $interventionClassification
     * @return void
     */
    public function __construct(InterventionClassification $interventionClassification)
    {
        $this->middleware('auth.jwt');
        $this->interventionClassification = $interventionClassification;
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

        $interventionClassificationRepository = new InterventionClassificationRepository($this->interventionClassification);

        $interventionClassificationRepository
            ->filterRegistersFromModel($filter)
            ->selectColumnsFromModel($attr)
            ->selectColumnsFromRelationship($int_attr);

        $interventionClassifications = $interventionClassificationRepository->getCollection();

        return response()->json($interventionClassifications, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInterventionClassificationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreInterventionClassificationRequest $request)
    {
        $request->validate($this->interventionClassification->rules(), $this->interventionClassification->feedback());

        $newInterventionClassification = $this->interventionClassification->create($request->all());

        return response()->json($newInterventionClassification, 201, $this->headerOptions);
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
        $interventionClassification = $this->interventionClassification;

        $data = $this->setRequestQueryParams($request);
        extract($data);

        if ($attr)
            $interventionClassification = $interventionClassification->select($attr);

        if ($int_attr)
            $interventionClassification = $interventionClassification->with($int_attr);

        $interventionClassification = $interventionClassification->find($id);

        if ($interventionClassification == null)
            return $this->notFound();

        return response()->json($interventionClassification, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInterventionClassificationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateInterventionClassificationRequest $request, $id)
    {
        $interventionClassification = $this->interventionClassification->find($id);

        if ($interventionClassification == null)
            return $this->notFound();

        $rules = $this->rewriteRules($request, $interventionClassification);

        $request->validate($rules, $interventionClassification->feedback());

        $interventionClassification->fill($request->all());

        $interventionClassification->save();

        return response()->json($interventionClassification, 200, $this->headerOptions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $interventionClassification = $this->interventionClassification->find($id);

        if ($interventionClassification == null)
            return $this->notFound();

        $deletedInterventionClassification = $interventionClassification;
        $interventionClassification->delete();

        return response()->json($deletedInterventionClassification, 200, $this->headerOptions);
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
            'int_attr'  => $this->setRelAttr('interventions', 'intervention_classification_id', 'int_attr', $request)
        );

        return $inputs;
    }
}
