<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EscaperEmail;
use App\ViewContact;
use App\Checkout;

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
        $data['contact'] = ViewContact::where('status', 1)->orderBy('updated_at')->first();

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
