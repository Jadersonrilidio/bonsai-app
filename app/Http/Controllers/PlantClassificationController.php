<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantClassificationRequest;
use App\Http\Requests\UpdatePlantClassificationRequest;
use App\Models\PlantClassification;

class PlantClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePlantClassificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlantClassificationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlantClassification  $plantClassification
     * @return \Illuminate\Http\Response
     */
    public function show(PlantClassification $plantClassification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlantClassification  $plantClassification
     * @return \Illuminate\Http\Response
     */
    public function edit(PlantClassification $plantClassification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlantClassificationRequest  $request
     * @param  \App\Models\PlantClassification  $plantClassification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlantClassificationRequest $request, PlantClassification $plantClassification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlantClassification  $plantClassification
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlantClassification $plantClassification)
    {
        //
    }
}
