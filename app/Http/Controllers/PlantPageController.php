<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantPageController extends Controller
{
    /**
     * Class instance constructor method.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Render view index.
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('plant.index');
    }

    /**
     * Render view create.
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('plant.create');
    }

    /**
     * Render view show.
     * 
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('plant.show', [
            'plant_id' => $id
        ]);
    }

    /**
     * Render view edit.
     * 
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('plant.edit', [
            'plant_id' => $id
        ]);
    }
}
