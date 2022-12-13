<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ErrorResponses;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\SetRequestInputs;
use App\Http\Controllers\Traits\StandardStorage;
use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;
use App\Models\Plant;
use App\Repositories\PlantRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlantController extends Controller
{
    use ErrorResponses,
        RewriteModelRules,
        SetRequestInputs,
        StandardStorage;

    /**
     * Plant model instance.
     * 
     * @var \App\Models\Plant
     */
    protected $plant;

    /**
     * Response header options.
     * 
     * @var array
     */
    protected $headerOptions = array();

    /**
     * Default storage variables.
     * 
     * @var array
     */
    protected $storageVars = array(
        'input' => 'main_picture',
        'path'  => 'images',
        'disk'  => 'public'
    );

    /**
     * PlantController class constructor method.
     * 
     * @param  \App\Models\Plant  $plant
     * @return void
     */
    public function __construct(Plant $plant)
    {
        $this->middleware('auth.jwt');
        $this->plant = $plant;
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

        $plantRepository = new PlantRepository($this->plant);

        $plantRepository
            ->filterRegistersFromModel($filter)
            ->selectColumnsFromModel($attr)
            ->selectColumnsFromRelationship($user_attr)
            ->selectColumnsFromRelationship($class_attr)
            ->selectColumnsFromRelationship($style_attr)
            ->selectColumnsFromRelationship($int_attr)
            ->selectColumnsFromRelationship($pics_attr)
            ->selectColumnsFromRelationship($vids_attr);

        $plants = $plantRepository->getCollection();

        return response()->json($plants, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlantRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePlantRequest $request)
    {
        $request->validate($this->plant->rules(), $this->plant->feedback());

        $inputs = $request->all();
        $inputs['user_id'] = auth()->user()->id;

        if ($request->has('main_picture')) {
            $image_urn = $this->storeImage($request, $this->storageVars);
            $inputs['main_picture'] = $image_urn;
        }

        $newPlant = $this->plant->create($inputs);

        return response()->json($newPlant, 201, $this->headerOptions);
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
        $plant = $this->plant->find($id);

        if ($plant == null)
            return $this->notFound();

        if ($plant->user_id != auth()->user()->id)
            return $this->forbidden();

        extract($this->setRequestQueryParams($request));

        $plantRepository = new PlantRepository($plant);

        $plantRepository
            ->selectColumnsFromModel($attr)
            ->selectColumnsFromRelationship($user_attr)
            ->selectColumnsFromRelationship($class_attr)
            ->selectColumnsFromRelationship($style_attr)
            ->selectColumnsFromRelationship($int_attr)
            ->selectColumnsFromRelationship($pics_attr)
            ->selectColumnsFromRelationship($vids_attr);

        $plant = $plantRepository->getCollection();

        return response()->json($plant, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePlantRequest $request, $id)
    {
        $plant = $this->plant->find($id);

        if ($plant == null)
            return $this->notFound();

        if ($plant->user_id != auth()->user()->id)
            return $this->forbidden();

        $rules = $this->rewriteRules($request, $plant);

        $request->validate($rules, $plant->feedback());

        if (isset($rules['main_picture']) and $rules['main_picture'])
            Storage::disk('public')->delete($plant->main_picture);

        $plant->fill($request->all());

        if (isset($rules['main_picture']) and $rules['main_picture']) {
            $main_picture = $this->storeImage($request, $this->storageVars);
            $plant->main_picture = $main_picture;
        }

        $plant->save();

        return response()->json($plant, 200, $this->headerOptions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $plant = $this->plant->find($id);

        if ($plant == null)
            return $this->notFound();

        if ($plant->user_id != auth()->user()->id)
            return $this->forbidden();

        $deletedPlant = $plant;
        $plant->delete();

        return response()->json($deletedPlant, 200, $this->headerOptions);
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
            'user_attr'  => $this->setRelAttr('user', 'id', 'user_attr', $request),
            'class_attr' => $this->setRelAttr('plantClassification', 'id', 'class_attr', $request),
            'style_attr' => $this->setRelAttr('bonsaiStyle', 'id', 'style_attr', $request),
            'int_attr'   => $this->setRelAttr('interventions', 'plant_id', 'int_attr', $request),
            'pics_attr'  => $this->setRelAttr('pictures', 'plant_id', 'pics_attr', $request),
            'vids_attr'  => $this->setRelAttr('videos', 'plant_id', 'vids_attr', $request)
        );

        array_unshift($inputs['filter'], ['user_id', '=', auth()->user()->id]);

        return $inputs;
    }
}
