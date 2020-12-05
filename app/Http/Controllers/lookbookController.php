<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lookbook;

class lookbookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['lookbook'] = Lookbook::get();
        return view('lookbook', $data);
    }
}
