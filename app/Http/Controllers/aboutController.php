<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewAbout;
use App\TextBerjalan;

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
        if (!isset($_COOKIE['guest_code'])) {
            return redirect('/');
        }
        $data['about'] = ViewAbout::where('status', '1')->orderBy('created_at')->first();
        $textberjalan = TextBerjalan::where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->orderBy('created_at')->first();
        if(!$textberjalan) {
            $data['textberjalan'] = 'text here';
        }
        else {
            $data['textberjalan'] = $textberjalan->text;
        }
        // dd(url('images/'.$data['about']->background));
        return view('about', $data);
    }
}
