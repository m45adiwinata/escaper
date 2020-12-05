<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Cart;
use App\ProductAvailability;
use App\Checkout;
use App\UserShop;
use App\Subscriber;

class CartController extends Controller
{
    public function index()
    {
        if(isset($_COOKIE['guest_code'])) {
            $data['carts'] = Cart::where('guest_code', $_COOKIE['guest_code'])->where('checkout', 0)->get();
            for ($i=0; $i < count($data['carts']); $i++) {
                $data['carts'][$i]->avl = ProductAvailability::where('product_id', $data['carts'][$i]->product_id)
                                            ->where('size_init', $data['carts'][$i]->sizeInitial()->first()->initial)->first();
            }
            return view('cart.index', $data);
        }

        return redirect('/');
    }

    public function checkout()
    {
        if(isset($_COOKIE['guest_code'])) {
            $data['carts'] = Cart::where('guest_code', $_COOKIE['guest_code'])->where('checkout', 0)->get();
            for ($i=0; $i < count($data['carts']); $i++) {
                $data['carts'][$i]->avl = ProductAvailability::where('product_id', $data['carts'][$i]->product_id)
                                            ->where('size_init', $data['carts'][$i]->sizeInitial()->first()->initial)->first();
                if ($_COOKIE['currency'] == 'IDR') {
                    $data['carts'][$i]->total = $data['carts'][$i]->avl->IDR * $data['carts'][$i]->amount;
                }
                else {
                    $data['carts'][$i]->total = $data['carts'][$i]->avl->USD * $data['carts'][$i]->amount;
                }
            }
            return view('cart.checkout', $data);
        }

        return redirect('/');
    }

    public function placeOrder(Request $request)
    {
        $data = new Checkout;
        $data->guest_code = $_COOKIE['guest_code'];
        $data->currency = $_COOKIE['currency'];
        $data->first_name = $request->firstName;
        $data->last_name = $request->lastName;
        $data->company = $request->company;
        $data->country = $request->country;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->zipcode = $request->zipcode;
        $data->phone = $request->phone;
        $data->email = $request->email;
        if (isset($request->checkSubscribe)) {
            $data->subscribe = 1;
            if(count(Subscriber::where('email', $data->email)->get()) == 0) {
                $subscriber = new Subscriber;
                $subscriber->email = $data->email;
                $subscriber->save();
            }
        }
        if (isset($request->checkCreateAcc)) {
            $data->create_acc = 1;
            if(count(UserShop::where('email', $data->email)->get()) == 0) {
                $user = new UserShop;
                $user->first_name = $data->first_name;
                $user->last_name = $data->last_name;
                $user->email = $data->email;
                $user->username = $data->username;
                $user->password = md5('escaper');
                $user->save();
            }
        }
        $data->notes = $request->notes;
        if (isset($request->radTrfBank)) {
            $data->pembayaran = 1;
        }
        else {
            $data->pembayaran = 2;
        }
        $data->save();
        $grand_total = 0;
        $carts = array();
        foreach (Cart::where('guest_code', $data->guest_code)->where('checkout', 0)->get() as $key => $d) {
            $cart = array('name' => $d->product()->first()->name, 'qty' => $d->amount, 'price' => 0, 'subtotal' => 0, 'image' => '');
            $cart['image'] = env('APP_URL').'//images//'.$d->product()->first()->image[0];
            $avl = ProductAvailability::where('product_id', $d->product_id)->where('size_init', $d->sizeInitial()->first()->initial)->first();
            if ($d->currency == 'IDR') {
                $total = $avl->IDR * $d->amount;
                $cart['price'] = $avl->IDR;
                $cart['subtotal'] = $total;
            }
            else {
                $total = $avl->USD * $d->amount;
                $cart['price'] = $avl->IDR;
                $cart['subtotal'] = $total;
            }
            $grand_total += $total;
            array_push($carts, $cart);
        }
        $data->grand_total = $grand_total;
        $data->save();
        Cart::where('guest_code', $data->guest_code)->update(['checkout' => 1]);
        $temp = array(
            'email' => $data->email,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'guest_code' => $data->guest_code,
            'currency' => $data->currency,
            'grand_total' => $grand_total,
            'carts' => $carts
        );
        Mail::send('emailku', $temp, function($message) use ($temp) {
            $message->to($temp['email']);
            $message->from('info@escaper-store.com');
            $message->subject('Purchase '.$temp['guest_code']);
        });

        if ($data->pembayaran == 1) {
            return redirect('/cart/upload-payment/'.$data->id);
        }
        return redirect('https://www.paypal.me/escaperstore');

        // return redirect('/cart/received/'.$data->id);
    }

    public function uploadPayment($id) {
        $data['checkout'] = Checkout::find($id);
        return view('upload', $data);
    }

    public function postUpload(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
			'file' => 'required'
        ]);
        $data = Checkout::find($request->id);
        $file = $request->file('file');
        $namafile = time().$file->getClientOriginalName();
        $data->buktitrf = $namafile;
        $data->save();
        $file->move('images/userupload', $namafile);
        $temp = array(
            'email' => $data->email,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'guest_code' => $data->guest_code,
            'currency' => $data->currency,
            'grand_total' => $data->grand_total,
            'image' => $data->buktitrf,
            'id' => $request->id
        );
        Mail::send('emailtransfer', $temp, function($message) use ($temp) {
            $message->to('info.escaper@gmail.com');
            $message->from('info@escaper-store.com');
            $message->subject('Purchase '.$temp['guest_code']);
        });

        return redirect("/");
    }

    public function setLunas(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        $data = Checkout::find($request->id);
        $data->lunas = 1;
        $data->save();

        return redirect('');
    }

    public function testEmail()
    {
        $data = Checkout::first();
        $grand_total = 0;
        $carts = array();
        foreach (Cart::where('guest_code', $data->guest_code)->get() as $key => $d) {
            $cart = array('name' => $d->product()->first()->name, 'qty' => $d->amount, 'price' => 0, 'subtotal' => 0, 'image' => '');
            $cart['image'] = $d->product()->first()->image[0];
            $avl = ProductAvailability::where('product_id', $d->product_id)->where('size_init', $d->sizeInitial()->first()->initial)->first();
            if ($d->currency == 'IDR') {
                $total = $avl->IDR * $d->amount;
                $cart['price'] = $avl->IDR;
                $cart['subtotal'] = $total;
            }
            else {
                $total = $avl->USD * $d->amount;
                $cart['price'] = $avl->IDR;
                $cart['subtotal'] = $total;
            }
            $grand_total += $total;
            array_push($carts, $cart);
        }
        
        $temp = array(
            'email' => $data->email,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'guest_code' => $data->guest_code,
            'currency' => $data->currency,
            'grand_total' => $grand_total,
            'carts' => $carts
        );
        
        Mail::send('emailku', $temp, function($message) use ($temp) {
            $message->to('m45adiwinata@gmail.com');
            $message->from('info@escaper-store.com');
            $message->subject('Purchase '.$temp['guest_code']);
        });
    }

    public function received($id)
    {
        $data = Checkout::find($id);
        return view('cart.received', $data);
    }

    public function changeAmt()
    {
        Cart::where('id', $_GET['cart_id'])->update(['amount' => $_GET['qty']]);
        $data = Cart::find($_GET['cart_id']);
        $avl = ProductAvailability::where('product_id', $data->product_id)->where('size_init', $data->sizeInitial()->first()->initial)->first();
        if ($_COOKIE['currency'] == 'IDR') {
            $total = $avl->IDR * $data->amount;
        }
        else {
            $total = $avl->USD * $data->amount;
        }
        $total = number_format($total, 2, ',', '.');
        return $total;
    }

    public function deleteItem()
    {
        Cart::find($_GET['cart_id'])->delete();
        return 1;
    }

    public function getGrandTotal()
    {
        $datas = Cart::where('guest_code', $_COOKIE['guest_code'])->where('checkout', 0)->get();
        $grand_total = 0;
        foreach ($datas as $key => $data) {
            $avl = ProductAvailability::where('product_id', $data->product_id)->where('size_init', $data->sizeInitial()->first()->initial)->first();
            if ($_COOKIE['currency'] == 'IDR') {
                $total = $avl->IDR * $data->amount;
            }
            else {
                $total = $avl->USD * $data->amount;
            }
            $grand_total += $total;
        }
        $grand_total = number_format($grand_total, 2, ',', '.');
        ($_COOKIE['currency'] == 'IDR') ? $grand_total = 'Rp '.$grand_total : $grand_total = $grand_total.' $';
        return $grand_total;
    }
}
