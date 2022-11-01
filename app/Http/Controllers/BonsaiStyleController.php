<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBonsaiStyleRequest;
use App\Http\Requests\UpdateBonsaiStyleRequest;
use App\Models\BonsaiStyle;

use App\Repositories\BonsaiStyleRepository;
use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\StandardStorage;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\SetRequestInputs;

class BonsaiStyleController extends Controller
{
    use ErrorResponses, StandardStorage, RewriteModelRules, SetRequestInputs;

    /**
     * BonsaiStyle model instance.
     * 
     * @var App\Models\BonsaiStyle
     */
    public $bonsaiStyle;

    /**
     * Request header options.
     * 
     * @var array
     */
    protected $headerOptions = array();

    /**
     * BonsaiStyleController constructor method.
     * 
     * @param  App\Models\BonsaiStyle  $bonsaiStyle
     * @return void
     */
    public function __construct(BonsaiStyle $bonsaiStyle)
    {
        $this->middleware('auth.jwt');
        $this->bonsaiStyle = $bonsaiStyle;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $this->setFilters($request->get('filter'));
        $attr = $this->setAttr($request->get('attr'));
        $plant_attr = $this->setRelAttr('plants', 'bonsai_style_id', $request);

        $bonsaiStyleRepository = new BonsaiStyleRepository($this->bonsaiStyle);

        if ($filter)
            $bonsaiStyleRepository->NEWfilterRegistersFromModel($filter);

        if ($attr)
            $bonsaiStyleRepository->NEWselectColumnsFromModel($attr);

        if ($plant_attr)
            $bonsaiStyleRepository->NEWselectColumnsFromRelationship($plant_attr);

        $bonsaiStyles = $bonsaiStyleRepository->getCollection();

        return response()->json($bonsaiStyles, 200, $this->headerOptions);
    }

    /**
     * //TODO set it in the right trait
     */
    private function setPlantAttr($request)
    {
        return $request->get('plant_attr')
            ? 'plants:bonsai_style_id,' . $request->get('plant_attr')
            : '';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBonsaiStyleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBonsaiStyleRequest $request)
    {
        $request->validate($this->bonsaiStyle->rules(), $this->bonsaiStyle->feedback());

        $newBonsaiStyle = $this->bonsaiStyle->create($request->all());

        return response()->json($newBonsaiStyle, 201, $this->headerOptions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bonsaiStyle = $this->bonsaiStyle->find($id);

        if ($bonsaiStyle == null)
            return $this->notFound();

        return response()->json($bonsaiStyle, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBonsaiStyleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBonsaiStyleRequest $request, $id)
    {
        $bonsaiStyle = $this->bonsaiStyle->find($id);

        if ($bonsaiStyle == null)
            return $this->notFound();

        $rules = $this->rewriteRules($request, $bonsaiStyle);

        $request->validate($rules, $bonsaiStyle->feedback());

        $bonsaiStyle->fill($request->all());

        $bonsaiStyle->save();

        return response()->json($bonsaiStyle, 200, $this->headerOptions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bonsaiStyle = $this->bonsaiStyle->find($id);

        if ($bonsaiStyle == null)
            return $this->notFound();

        $deletedBonsaiStyle = $bonsaiStyle;
        $bonsaiStyle->delete();

        return response()->json($deletedBonsaiStyle, 200, $this->headerOptions);
    }
}
