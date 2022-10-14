<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBonsaiStyleRequest;
use App\Http\Requests\UpdateBonsaiStyleRequest;
use App\Models\BonsaiStyle;

class BonsaiStyleController extends Controller
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
