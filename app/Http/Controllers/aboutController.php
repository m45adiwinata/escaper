<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewAbout;

class aboutController extends Controller
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
        $data['about'] = ViewAbout::where('status', '1')->orderBy('created_at')->first();
        // dd(url('images/'.$data['about']->background));
        return view('about', $data);
    }
}
