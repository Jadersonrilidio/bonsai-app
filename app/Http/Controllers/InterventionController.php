<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\SetRequestInputs;
use App\Http\Requests\StoreInterventionRequest;
use App\Http\Requests\UpdateInterventionRequest;
use App\Models\Intervention;
use App\Repositories\InterventionRepository;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $this->setRequestQueryParams($request);
        extract($data);

        $interventionRepository = new InterventionRepository($this->intervention);

        $interventionRepository
            ->filterRegistersFromModel($filter)
            ->selectColumnsFromModel($attr)
            ->selectColumnsFromRelationship($plant_attr)
            ->selectColumnsFromRelationship($class_attr)
            ->selectColumnsFromRelationship($obs_attr);

        $interventions = $interventionRepository->getCollection();

        return response()->json($interventions, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInterventionRequest  $request
     * @return \Illuminate\Http\JsonResponse
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $intervention = $this->intervention->find($id);

        if ($intervention == null)
            return $this->notFound();

        $data = $this->setRequestQueryParams($request);
        extract($data);

        $interventionRepository = new InterventionRepository($intervention);

        $interventionRepository
            ->selectColumnsFromModel($attr)
            ->selectColumnsFromRelationship($plant_attr)
            ->selectColumnsFromRelationship($class_attr)
            ->selectColumnsFromRelationship($obs_attr);
        
        $intervention = $interventionRepository->getCollection();
        
        return response()->json($intervention, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInterventionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
            'plant_attr' => $this->setRelAttr('plant', 'id', 'plant_attr', $request),
            'class_attr' => $this->setRelAttr('interventionClassification', 'id', 'class_attr', $request),
            'obs_attr'   => $this->setRelAttr('observations', 'intervention_id', 'obs_attr', $request)
        );

        return $inputs;
    }
}
