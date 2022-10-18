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

class BonsaiStyleController extends Controller
{
    use ErrorResponses, StandardStorage, RewriteModelRules;

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
        $filter =  $request->get('filter') ?? '';
        $attr = $request->get('attr') ?? '';

        $bonsaiStyleRepository = new BonsaiStyleRepository($this->bonsaiStyle);

        if ($filter)
            $bonsaiStyleRepository->filterRegistersFromModel($filter);

        if ($attr)
            $bonsaiStyleRepository->selectColumnsFromModel($attr);

        $bonsaiStyles = $bonsaiStyleRepository->getCollection();

        return response()->json($bonsaiStyles, 200, $this->headerOptions);
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
