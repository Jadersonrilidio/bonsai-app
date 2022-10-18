<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObservationRequest;
use App\Http\Requests\UpdateObservationRequest;
use App\Models\Observation;

use Illuminate\Http\Request;
use App\Repositories\ObservationRepository;
use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;

class ObservationController extends Controller
{
    use ErrorResponses, RewriteModelRules;

    /**
     * Observation model instance.
     * 
     * @var App\Models\Observation
     */
    protected $observation;

    /**
     * Response header options.
     * 
     * @var array
     */
    protected $headerOptions = array();

    /**
     * ObservationController class constructor method.
     * 
     * @param  App\Models\Observation  $observation
     * @return void
     */
    public function __construct(Observation $observation)
    {
        $this->middleware('auth.jwt');
        $this->observation = $observation;
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
        $int_attr = $request->get('int_attr') ?? '';

        $observationRepository = new ObservationRepository($this->observation);

        if ($filter)
            $observationRepository->filterRegistersFromModel($filter);

        if ($attr)
            $observationRepository->selectColumnsFromModel($attr);

        if (str_contains($attr, 'intervention_id'))
            $observationRepository->selectColumnsFromRelationship('intervention', $int_attr);

        $observations = $observationRepository->getCollection();

        return response()->json($observations, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreObservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreObservationRequest $request)
    {
        $request->validate($this->observation->rules(), $this->observation->feedback());

        $newObservation = $this->observation->create($request->all());

        return response()->json($newObservation, 201, $this->headerOptions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $observation = $this->observation->find($id);

        if ($observation == null)
            return $this->notFound();

        return response()->json($observation, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateObservationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateObservationRequest $request, $id)
    {
        $observation = $this->observation->find($id);

        if ($observation == null)
            return $this->notFound();

        $rules = $this->rewriteRules($request, $observation);

        $request->validate($rules, $observation->feedback());

        $observation->fill($request->all());
        $observation->save();

        return response()->json($observation, 200, $this->headerOptions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $observation = $this->observation->find($id);

        if ($observation == null)
            return $this->notFound();

        $deletedObservation = $observation;
        $observation->delete();

        return response()->json($deletedObservation, 200, $this->headerOptions);
    }
}
