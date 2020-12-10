<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\TextBerjalan;
use DateTime;

class homeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    
    public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        foreach (Cart::get() as $data) {
            if (date('Y-m-d H:i:s', strtotime($data->created_at . '+1 days')) <= date('Y-m-d H:i:s')) {
                $data->delete();
            }
        }
        if (!isset($_COOKIE['guest_code'])) {
            return redirect('/');
        }
        $data['textberjalan'] = TextBerjalan::where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->orderBy('created_at')->first();
        return view('homepage', $data);
    }

    public function welcome(Request $request)
    {
        if (!isset($_COOKIE['guest_code'])) {
            $id = md5($_SERVER["REMOTE_ADDR"]);
            $id = substr($id, 8, 5);
            do {
                $random = rand(1, 1000);
                if ($random < 10) {
                    $random = "000{$random}";
                }
                else if ($random < 100) {
                    $random = "00{$random}";
                }
                else if ($random < 1000) {
                    $random = "0{$random}";
                }
                $new_guest_code = "{$id}-{$random}";
            } while (count(Cart::where('guest_code', $new_guest_code)->get()) > 0);
            setcookie("guest_code", $new_guest_code, time() + 86400);
            setcookie("currency", $request->currency, time() + 86400);
        }
        else if ($_COOKIE['currency'] != $request->currency) {
            setcookie('currency', $request->currency);
        }

        return redirect('home');
    }
}
