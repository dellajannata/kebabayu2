<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController1 extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function home1()
    {
            return view('layouts.index')
                    ->with('title', 'Halaman Utama');
    }
}
