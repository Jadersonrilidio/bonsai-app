<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\RewriteModelRules;
use App\Http\Controllers\Traits\StandardStorage;
use App\Http\Controllers\Traits\ErrorResponses;
use App\Repositories\VideoRepository;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    use ErrorResponses, RewriteModelRules, StandardStorage;

    /**
     * Video model instance.
     * 
     * @var App\Models\Video
     */
    protected $video;

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
        'input' => 'video',
        'path'  => 'videos',
        'disk'  => 'public'
    );

    /**
     * VideoController class constructor method.
     * 
     * @param  App\Models\Video  $video
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->middleware('auth.jwt');
        $this->video = $video;
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

        $videoRepository = new VideoRepository($this->video);

        if ($filter)
            $videoRepository->filterRegistersFromModel($filter);

        if ($attr)
            $videoRepository->selectColumnsFromModel($attr);

        if (str_contains($attr, 'plant_id'))
            $videoRepository->selectColumnsFromRelationship('plant', $plant_attr);

        $videos = $videoRepository->getCollection();

        return response()->json($videos, 200, $this->headerOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        $request->validate($this->video->rules(), $this->video->feedback());
        
        $inputs = $request->all();

        if ($request->has('video')) {
            $video_urn = $this->storeVideo($request, $this->storageVars);
            $inputs = array_merge($inputs, ['video' => $video_urn]);
        }

        $newVideo = $this->video->create($inputs);

        return response()->json($newVideo, 201, $this->headerOptions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = $this->video->find($id);

        if ($video == null)
            return $this->notFound();

        return response()->json($video, 200, $this->headerOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVideoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoRequest $request, $id)
    {
        $video = $this->video->find($id);

        if ($video == null)
            return $this->notFound();

        $rules = $this->rewriteRules($request, $video);

        $request->validate($rules, $video->feedback());

        if ($request->has('video') or $rules['video'])
            Storage::disk('public')->delete($video->video);

        $video->fill($request->all());

        if ($request->has('video') or $rules['video']) {
            $video_urn = $this->storeVideo($request, $this->storageVars);
            $video->video = $video_urn;
        }

        $video->save();

        return response()->json($video, 200, $this->headerOptions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = $this->video->find($id);

        if ($video == null)
            return $this->notFound();

        $deletedVideo = $video;
        $video->delete();

        return response($deletedVideo, 200, $this->headerOptions);
    }
}
