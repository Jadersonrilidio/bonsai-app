<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;
use App\Models\Plant;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\StandardStorage;
use App\Http\Controllers\Traits\ErrorResponses;
use App\Repositories\PlantRepository;
use Illuminate\Support\Facades\Storage;

class PlantController extends Controller
{
    use ErrorResponses, RewriteModelRules, StandardStorage;

    /**
     * Plant model instance.
     * 
     * @var App\Models\Plant
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
     * @param  App\Models\Plant  $plant
     * @return void
     */
    public function __construct(Plant $plant)
    {
        $this->plant = $plant;
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
        $user_attr = $request->get('user_attr') ?? '';
        $class_attr = $request->get('class_attr') ?? '';
        $style_attr = $request->get('style_attr') ?? '';
        $int_attr = $request->get('int_attr') ?? '';
        $pics_attr = $request->get('pics_attr') ?? '';
        $vids_attr = $request->get('vids_attr') ?? '';

        $plantRepository = new PlantRepository($this->plant);

        if ($filter)
            $plantRepository->filterRegistersFromModel($filter);
        
        if ($attr)
            $plantRepository->selectColumnsFromModel($attr);
        
        if (str_contains($attr, 'user_id'))
            $plantRepository->selectColumnsFromRelationship('user', $user_attr);

        if (str_contains($attr, 'plant_classification_id'))
            $plantRepository->selectColumnsFromRelationship('plantClassification', $class_attr);

        if (str_contains($attr, 'bonsai_style_id'))
            $plantRepository->selectColumnsFromRelationship('bonsaiStyle', $style_attr);

        if ($int_attr)
            $plantRepository->selectColumnsFromRelationship('interventions', $int_attr);

        if ($pics_attr)
            $plantRepository->selectColumnsFromRelationship('pictures', $pics_attr);

        if ($vids_attr)
            $plantRepository->selectColumnsFromRelationship('videos', $vids_attr);

        $plants = $plantRepository->getCollection();

        return response()->json($plants, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlantRequest $request)
    {
        $request->validate($this->plant->rules(), $this->plant->feedback());

        $inputs = $request->all();

        if ($request->has('main_picture')) {
            $image_urn = $this->storeImage($request, $this->storageVars);
            $inputs = array_merge($inputs, ['main_picture' => $image_urn]);
        }

        $newPlant = $this->plant->create($inputs);

        return response()->json($newPlant, 201, $this->headerOptions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plant = $this->plant->find($id);

        if ($plant == null)
            return $this->notFound();

        return response($plant, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlantRequest $request, $id)
    {
        $plant = $this->plant->find($id);

        if ($plant == null)
            return $this->notFound();

        $rules = $this->rewriteRules($request, $plant);

        $request->validate($rules, $plant->feedback());

        if ($rules['main_picture'])
            Storage::disk('public')->delete($plant->main_picture);

        $plant->fill($request->all());

        if ($rules['main_picture']) {
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plant = $this->plant->find($id);

        if ($plant == null)
            return $this->notFound();

        $deletedPlant = $plant;
        $plant->delete();

        return response()->json($deletedPlant, 200, $this->headerOptions);
    }
}
