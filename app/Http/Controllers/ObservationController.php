<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\SetRequestInputs;
use App\Http\Requests\StoreObservationRequest;
use App\Http\Requests\UpdateObservationRequest;
use App\Models\Observation;
use App\Repositories\ObservationRepository;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    use ErrorResponses,
        RewriteModelRules,
        SetRequestInputs;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $this->setRequestQueryParams($request);
        extract($data);

        $observationRepository = new ObservationRepository($this->observation);

        $observationRepository
            ->filterRegistersFromModel($filter)
            ->selectColumnsFromModel($attr);

        $observations = $observationRepository->getCollection();

        return response()->json($observations, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreObservationRequest  $request
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
            'attr'       => $this->setAttr('attr', $request)
            // 'int_attr'   => $this->setRelAttr('intervention', 'id', 'int_attr', $request)
        );

        return $inputs;
    }
}
