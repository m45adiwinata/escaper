<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lookbook;
use App\TextBerjalan;

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
        if (!isset($_COOKIE['guest_code'])) {
            return redirect('/');
        }
        $data['lookbook'] = Lookbook::get();
        $textberjalan = TextBerjalan::where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->orderBy('created_at')->first();
        if(!$textberjalan) {
            $data['textberjalan'] = 'text here';
        }
        else {
            $data['textberjalan'] = $textberjalan->text;
        }
        return view('lookbook', $data);
    }
}
