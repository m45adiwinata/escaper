<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EscaperEmail;
use App\ViewContact;
use App\Checkout;
use App\TextBerjalan;

class contactController extends Controller
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
        $data['contact'] = ViewContact::where('status', 1)->orderBy('updated_at')->first();
        $textberjalan = TextBerjalan::where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->orderBy('created_at')->first();
        if(!$textberjalan) {
            $data['textberjalan'] = 'text here';
        }
        else {
            $data['textberjalan'] = $textberjalan->text;
        }
        return view('contact', $data);
    }

    public function sendEmail()
    {
        // Mail::to("m45adiwinata@gmail.com")->send(new EscaperEmail());
        // return "Email telah dikirim";
        
        $data = Checkout::first();
        return view('emailku', $data);
    }
}
