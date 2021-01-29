<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lookbook;
use App\TextBerjalan;
use App\ProductType;

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
        $textberjalan = TextBerjalan::where('currency', $_COOKIE['currency'])->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->orderBy('created_at')->get();
        if(count($textberjalan) == 0) {
            $data['textberjalan'] = 'text here';
        }
        else {
            $text = '';
            foreach ($textberjalan as $key => $tb) {
                $text .= $tb->text;
                $text .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            $data['textberjalan'] = $text;
        }
        $data['producttypes'] = ProductType::get();
        
        return view('lookbook', $data);
    }
}
