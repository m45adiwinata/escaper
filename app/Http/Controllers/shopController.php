<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\ProductSize;
use App\TextBerjalan;
use App\ProductType;

class shopController extends Controller
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
        if (isset($_COOKIE['guest_code']) && isset($_COOKIE['currency'])) {
            if (count($_GET) > 0) {
                $data['products'] = Product::where('product_type_id', $_GET['type_id'])->get();
                $data['typeselected'] = ProductType::find($_GET['type_id']);
            }
            else {
                $data['products'] = Product::get();
                $data['typeselected'] = null;
            }
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

            return view('shop/shop', $data);
        }
        else {
            return redirect('/');
        }
    }

    public function product()
    {
        if (isset($_COOKIE['guest_code']) && isset($_COOKIE['currency'])) {
            $data['product'] = Product::find($_GET["productid"]);
            $data ['product']->stocks = $data['product']->availability()->first()->stocks;
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

            return view('shop/product', $data);
        }
        else {
            return redirect('/');
        }
    }

    public function getPrice($id, $size)
    {
        $data = Product::find($id)->availability()->where('size_init', $size)->first();
        $data->IDR = number_format($data->IDR, 2, ',', '.');
        $data->USD = number_format($data->USD, 2, ',', '.');
        return $data;
    }

    public function add2Cart($id, $size, $amount)
    {
        $size = ProductSize::where('initial', $size)->first()->id;
        $data = new Cart;
        $data->guest_code = $_COOKIE['guest_code'];
        $data->currency = $_COOKIE['currency'];
        $data->product_id = $id;
        $data->product_size_id = $size;
        $data->amount = $amount;
        $data->save();

        return 1;
    }

    public function cartCheck()
    {
        session_start();
        $data['items'] = Cart::where('guest_code', $_COOKIE['guest_code'])->where('checkout', 0)->get();
        for ($i=0; $i<count($data['items']); $i++) {
            $data['items'][$i]->product_name = $data['items'][$i]->product()->first()->name;
        }
        $data['count'] = count($data['items']);

        return $data;
    }
}
