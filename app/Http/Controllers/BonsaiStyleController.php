<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\SetRequestInputs;
use App\Http\Controllers\Traits\StandardStorage;
use App\Http\Requests\StoreBonsaiStyleRequest;
use App\Http\Requests\UpdateBonsaiStyleRequest;
use App\Models\BonsaiStyle;
use App\Repositories\BonsaiStyleRepository;
use Illuminate\Http\Request;

class BonsaiStyleController extends Controller
{
    use ErrorResponses,
        RewriteModelRules,
        SetRequestInputs,
        StandardStorage;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $this->setRequestQueryParams($request);
        extract($data);

        $bonsaiStyleRepository = new BonsaiStyleRepository($this->bonsaiStyle);

        $bonsaiStyleRepository
            ->filterRegistersFromModel($filter);

        $bonsaiStyles = $bonsaiStyleRepository->getCollection();

        return response()->json($bonsaiStyles, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBonsaiStyleRequest  $request
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
            // 'attr'       => $this->setAttr('attr', $request)
            // 'plant_attr' => $this->setRelAttr('plants', 'bonsai_style_id', 'plant_attr', $request)
        );

        return $inputs;
    }
}
