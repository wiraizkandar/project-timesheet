<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Main home page
     *
     * @return void
     */
    public function index()
    {
        return view('public.home');
    }
}
