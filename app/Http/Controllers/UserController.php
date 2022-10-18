<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
     * Class instance constructor method.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Render preference settings view.
     * 
     * @return Illuminate\Http\Response
     */
    public function settings()
    {
        return view ('user.settings');
    }

    /**
     * Render profile view.
     * 
     * @return Illuminate\Http\Response
     */
    public function profile()
    {
        return view ('user.profile');
    }

    /**
     * Render profile view.
     * 
     * @return Illuminate\Http\Response
     */
    public function editProfile()
    {
        return view ('user.profile-edit');
    }
}
