<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterventionClassificationRequest;
use App\Http\Requests\UpdateInterventionClassificationRequest;
use App\Models\InterventionClassification;
use Illuminate\Http\Request;
use App\Repositories\InterventionClassificationRepository;
use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;

class InterventionClassificationController extends Controller
{
    use ErrorResponses, RewriteModelRules;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attr = $request->get('attr') ?? '';
        $filter = $request->get('filter') ?? '';

        $interventionClassificationRepository = new InterventionClassificationRepository($this->interventionClassification);

        if ($filter)
            $interventionClassificationRepository->filterRegistersFromModel($filter);

        if ($attr)
            $interventionClassificationRepository->selectColumnsFromModel($attr);

        $interventionClassifications = $interventionClassificationRepository->getCollection();

        return response()->json($interventionClassifications, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInterventionClassificationRequest  $request
     * @return \Illuminate\Http\Response
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $interventionClassification = $this->interventionClassification->find($id);

        if ($interventionClassification == null)
            return $this->notFound();
        
        return response()->json($interventionClassification, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInterventionClassificationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
}
