<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePictureRequest;
use App\Http\Requests\UpdatePictureRequest;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\StandardStorage;
use App\Http\Controllers\Traits\ErrorResponses;
use App\Repositories\PictureRepository;
use Illuminate\Support\Facades\Storage;


class PictureController extends Controller
{
    use ErrorResponses, RewriteModelRules, StandardStorage;

    /**
     * Picture model instance.
     * 
     * @var App\Models\Picture
     */
    protected $picture;

    /**
     * Response header options.
     * 
     * @var array
     */
    protected $headerOptions = array();

    /**
     * Storage variables.
     * 
     * @var array
     */
    protected $storageVars = array(
        'input' => 'picture',
        'path'  => 'images/pictures',
        'disk'  => 'public'
    );

    /**
     * PictureController class constructor method.
     * 
     * @param  App\Models\picture  $picture
     * @return void
     */
    public function __construct(Picture $picture)
    {
        $this->middleware('auth.jwt');
        $this->picture = $picture;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter') ?? '';
        $attr = $request->get('attr') ?? '';
        $plant_attr = $request->get('plant_attr') ?? '';

        $pictureRepository = new PictureRepository($this->picture);

        if ($filter)
            $pictureRepository->filterRegistersFromModel($filter);

        if ($attr)
            $pictureRepository->selectColumnsFromModel($attr);

        if (str_contains($attr, 'plant_id'))
            $pictureRepository->selectColumnsFromRelationship('plant', $plant_attr);

        $pictures = $pictureRepository->getCollection();

        return response()->json($pictures, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePictureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePictureRequest $request)
    {
        $request->validate($this->picture->rules(), $this->picture->feedback());

        $inputs = $request->all();

        if ($request->has('picture')) {
            $picture = $this->storeImage($request, $this->storageVars);
            $inputs = array_merge($inputs, ['picture' => $picture]);
        }

        $newPicture = $this->picture->create($inputs);

        return response()->json($newPicture, 201, $this->headerOptions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $picture = $this->picture->find($id);

        if ($picture == null)
            return $this->notFound();

        return response()->json($picture, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePictureRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePictureRequest $request, $id)
    {
        $picture = $this->picture->find($id);

        if ($picture == null)
            return $this->notFound();

        $rules = $this->rewriteRules($request, $picture);

        $request->validate($rules, $picture->feedback());

        if ($request->has('picture') or $rules['picture'])
            Storage::disk('public')->delete($picture->picture);

        $picture->fill($request->all());

        if ($request->has('picture') or $rules['picture']) {
            $picture_image = $this->storeImage($request, $this->storageVars);
            $picture->picture = $picture_image;
        }

        $picture->save();

        return response()->json($picture, 200, $this->headerOptions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picture = $this->picture->find($id);

        if ($picture == null)
            return $this->notFound();

        $deletedPicture = $picture;
        $picture->delete();

        return response()->json($deletedPicture, 200, $this->headerOptions);
    }
}
