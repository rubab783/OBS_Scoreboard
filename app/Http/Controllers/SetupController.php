<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function sport()
    {
        return view('setup.sport');
    }

    public function overlay()
    {
        return view('setup.overlay');
    }

    public function match()
    {
        return view('setup.match');
    }
}