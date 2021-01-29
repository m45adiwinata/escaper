<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EscaperEmail;
use App\ViewContact;
use App\Checkout;
use App\TextBerjalan;
use App\Comment;
use App\ProductType;

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
        $textberjalan = TextBerjalan::where('currency', $_COOKIE['currency'])->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->orderBy('created_at')->get();
        if(!$textberjalan) {
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

        return view('contact', $data);
    }

    public function sendEmail()
    {
        // Mail::to("m45adiwinata@gmail.com")->send(new EscaperEmail());
        // return "Email telah dikirim";
        
        $data = Checkout::first();
        return view('emailku', $data);
    }

    public function sendComment(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required'
        ]);
        $data = new Comment;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->comment = $request->comment;
        $data->save();
        
        return redirect('/home');
    }
}
