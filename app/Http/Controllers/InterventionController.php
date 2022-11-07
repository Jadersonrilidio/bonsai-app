<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterventionRequest;
use App\Http\Requests\UpdateInterventionRequest;
use App\Models\Intervention;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\SetRequestInputs;
use App\Repositories\InterventionRepository;

class InterventionController extends Controller
{
    use ErrorResponses,
        RewriteModelRules,
        SetRequestInputs;

    /**
     * Intervention model instance.
     * 
     * @var App\Model\Intervention
     */
    protected $intervention;

    /**
     * Response header options.
     * 
     * @var array
     */
    protected $headerOptions = array();

    /**
     * InterventionController class constructor method.
     * 
     * @param  App\Models\Intervention  $intervention
     * @return void
     */
    public function __construct(Intervention $intervention)
    {
        $this->middleware('auth.jwt');
        $this->intervention = $intervention;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plant_id = 1; //TODO
        $inputs = $this->setRequestInputs($request, $plant_id);

        $interventionRepository = new InterventionRepository($this->intervention);

        $interventionRepository
            ->filterRegistersFromModel($inputs['filter'])
            ->selectColumnsFromModel($inputs['attr'])
            ->selectColumnsFromRelationship($inputs['plant_attr'])
            ->selectColumnsFromRelationship($inputs['class_attr'])
            ->selectColumnsFromRelationship($inputs['obs_attr']);

        $interventions = $interventionRepository->getCollection();

        return response()->json($interventions, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInterventionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInterventionRequest $request)
    {
        $request->validate($this->intervention->rules(), $this->intervention->feedback());

        $newIntervention = $this->intervention->create($request->all());

        return response()->json($newIntervention, 201, $this->headerOptions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $intervention = $this->intervention->find($id);

        if ($intervention == null)
            return $this->notFound();

        return response()->json($intervention, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInterventionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInterventionRequest $request, $id)
    {
        $intervention = $this->intervention->find($id);

        if ($intervention == null)
            return $this->notFound();

        $rules = $this->rewriteRules($request, $intervention);

        $request->validate($rules, $intervention);

        $intervention->fill($request->all());
        $intervention->save();

        return response()->json($intervention, 200, $this->headerOptions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $intervention = $this->intervention->find($id);

        if ($intervention == null)
            return $this->notFound();

        $deletedIntervention = $intervention;
        $intervention->delete();

        return response()->json($deletedIntervention, 200, $this->headerOptions);
    }

    /**
     * Set all necessary request inputs in a suitable-to-use associative array form.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private function setRequestInputs(Request $request, $plant_id)
    {
        $inputs = [];
        $inputs['filter'] = $this->setFilters('filter', $request);
        array_unshift($inputs['filter'], ['plant_id', '=', $plant_id]); //TODO

        $inputs['attr'] = $this->setAttr('attr', $request);
        $inputs['plant_attr'] = $this->setRelAttr('plant', 'plant_id', 'plant_attr', $request);
        $inputs['class_attr'] = $this->setRelAttr('interventionClassification', 'intervention_classification_id', 'class_attr', $request);
        $inputs['obs_attr'] = $this->setRelAttr('observations', 'id', 'obs_attr', $request);

        return $inputs;
    }
}
