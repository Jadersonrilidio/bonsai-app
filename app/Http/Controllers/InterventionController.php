<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterventionRequest;
use App\Http\Requests\UpdateInterventionRequest;
use App\Models\Intervention;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Repositories\InterventionRepository;

class InterventionController extends Controller
{
    use ErrorResponses, RewriteModelRules;

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
        $filter = $request->get('filter') ?? '';
        $attr = $request->get('attr') ?? '';
        $plant_attr = $request->get('plant_attr') ?? '';
        $class_attr = $request->get('class_attr') ?? '';
        $obs_attr = $request->get('obs_attr') ?? '';

        $interventionRepository = new InterventionRepository($this->intervention);

        if ($filter)
            $interventionRepository->filterRegistersFromModel($filter);

        if ($attr)
            $interventionRepository->selectColumnsFromModel($attr);
        
        if (str_contains($attr, 'plant_id'))
            $interventionRepository->selectColumnsFromRelationship('plant', $plant_attr);

        if (str_contains($attr, 'intervention_classification_id'))
            $interventionRepository->selectColumnsFromRelationship('interventionClassification', $class_attr);

        $interventionRepository->selectColumnsFromRelationship('observations', $obs_attr);

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
}
