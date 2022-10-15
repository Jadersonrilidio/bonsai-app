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
     * //TODO
     * 
     * @var array
     */
    protected $storageVars = array(
        'input' => 'image',
        'path' => 'images',
        'disk' => 'public'
    );

    /**
     * Request header options.
     * 
     * @var array
     */
    protected $headerOptions = array(
        'Content-Type' => 'application/json'
    );

    /**
     * BonsaiStyleController constructor method.
     * 
     * @param  App\Models\BonsaiStyle  $bonsaiStyle
     * @return void
     */
    public function __construct(BonsaiStyle $bonsaiStyle)
    {
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBonsaiStyleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBonsaiStyleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BonsaiStyle  $bonsaiStyle
     * @return \Illuminate\Http\Response
     */
    public function show(BonsaiStyle $bonsaiStyle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BonsaiStyle  $bonsaiStyle
     * @return \Illuminate\Http\Response
     */
    public function edit(BonsaiStyle $bonsaiStyle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBonsaiStyleRequest  $request
     * @param  \App\Models\BonsaiStyle  $bonsaiStyle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBonsaiStyleRequest $request, BonsaiStyle $bonsaiStyle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonsaiStyle  $bonsaiStyle
     * @return \Illuminate\Http\Response
     */
    public function destroy(BonsaiStyle $bonsaiStyle)
    {
        //
    }
}
