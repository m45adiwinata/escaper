<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Cart;
use App\ProductAvailability;
use App\Checkout;
use App\UserShop;
use App\Subscriber;
use App\TextBerjalan;
use App\TempCart;

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
            $textberjalan = TextBerjalan::where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->orderBy('created_at')->first();
            if(!$textberjalan) {
                $data['textberjalan'] = 'text here';
            }
            else {
                $data['textberjalan'] = $textberjalan->text;
            }
            return view('cart.index', $data);
        }

        return redirect('/');
    }

    public function checkout()
    {
        if(isset($_COOKIE['guest_code'])) {
            $data['carts'] = Cart::where('guest_code', $_COOKIE['guest_code'])->where('checkout', 0)->get();
            $subtotal = 0;
            for ($i=0; $i < count($data['carts']); $i++) {
                $data['carts'][$i]->avl = ProductAvailability::where('product_id', $data['carts'][$i]->product_id)
                                            ->where('size_init', $data['carts'][$i]->sizeInitial()->first()->initial)->first();
                if ($_COOKIE['currency'] == 'IDR') {
                    $subtotal += $data['carts'][$i]->avl->IDR * $data['carts'][$i]->amount;
                    $data['carts'][$i]->total = $data['carts'][$i]->avl->IDR * $data['carts'][$i]->amount;
                }
                else {
                    $subtotal += $data['carts'][$i]->avl->USD * $data['carts'][$i]->amount;
                    $data['carts'][$i]->total = $data['carts'][$i]->avl->USD * $data['carts'][$i]->amount;
                }
            }
            $textberjalan = TextBerjalan::where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->orderBy('created_at')->first();
            if(!$textberjalan) {
                $data['textberjalan'] = 'text here';
            }
            else {
                $data['textberjalan'] = $textberjalan->text;
            }
            $grandtotal = $subtotal;
            if (count(TempCart::where('guest_code', $_COOKIE['guest_code'])->get()) < 1) {
                $tc = new TempCart;
                $tc->guest_code = $_COOKIE['guest_code'];
            }
            else {
                $tc = TempCart::where('guest_code', $_COOKIE['guest_code'])->first();
            }
            $tc->subtotal = $subtotal;
            $tc->discount = 0;
            if ($_COOKIE['currency'] == 'IDR' || ($_COOKIE['currency'] == 'USD' && $subtotal > 150)) {
                $tc->shipping = 0;
            }
            else {
                $tc->shipping = 15;
                $grandtotal += 15;
            }
            $tc->grandtotal = $grandtotal;
            $tc->save();

            return view('cart.checkout', $data);
        }

        return redirect('/');
    }

    public function placeOrder(Request $request)
    {
        $tc = TempCart::where('guest_code', $_COOKIE['guest_code'])->first();
        $data = new Checkout;
        $data->guest_code = $_COOKIE['guest_code'];
        $data->currency = $_COOKIE['currency'];
        $data->first_name = $request->firstName;
        $data->last_name = $request->lastName;
        $data->company = $request->company;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->address = $request->address;
        $data->zipcode = $request->zipcode;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->discount = $tc->discount;
        $data->shipping = $tc->shipping;
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
                $user->company = $data->company;
                $user->country = $data->country;
                $user->state = $data->state;
                $user->city = $data->city;
                $user->address = $data->address;
                $user->zipcode = $data->zipcode;
                $user->phone = $data->phone;
                $user->email = $data->email;
                $user->password = md5($request->new_password);
                $user->save();
            }
            else {
                $user = UserShop::where('email', $data->email)->first();
                $user->password = md5($request->new_password);
                $user->save();
            }
        }
        $data->notes = $request->notes;
        if (isset($request->radTrfBank)) {
            $data->pembayaran = 1;
            $temp_payment = 'Bank Transfer';
        }
        else {
            $data->pembayaran = 2;
            $temp_payment = 'PayPal';
        }
        $data->save();
        $sub_total = $tc->subtotal;
        $grand_total = $tc->grandtotal;
        $carts = array();
        foreach (Cart::where('guest_code', $data->guest_code)->where('checkout', 0)->get() as $key => $d) {
            $cart = array('name' => $d->product()->first()->name, 'qty' => $d->amount, 'price' => 0, 'subtotal' => 0, 'image' => '');
            $cart['image'] = env('APP_URL').'/'.$d->product()->first()->image[0];
            $avl = ProductAvailability::where('product_id', $d->product_id)->where('size_init', $d->sizeInitial()->first()->initial)->first();
            if ($d->currency == 'IDR') {
                $total = $avl->IDR * $d->amount;
                $cart['price'] = $avl->IDR;
                $cart['subtotal'] = $total;
            }
            else {
                $total = $avl->USD * $d->amount;
                $cart['price'] = $avl->USD;
                $cart['subtotal'] = $total;
            }
            array_push($carts, $cart);
        }
        $data->sub_total = $sub_total;
        $data->grand_total = $grand_total;
        $data->save();
        // Cart::where('guest_code', $data->guest_code)->update(['checkout' => 1]);
        // $temp = array(
        //     'email' => $data->email,
        //     'first_name' => $data->first_name,
        //     'last_name' => $data->last_name,
        //     'address' => $data->address,
        //     'zipcode' => $data->zipcode,
        //     'city' => $data->city,
        //     'state' => $data->state,
        //     'country' => $data->country,
        //     'phone' => $data->phone,
        //     'guest_code' => $data->guest_code,
        //     'currency' => $data->currency,
        //     'sub_total' => $sub_total,
        //     'grand_total' => $grand_total,
        //     'payment' => $temp_payment,
        //     'discount' => $data->discount,
        //     'shipping' => $data->shipping,
        //     'carts' => $carts,
        //     'logo' => env('APP_URL').'/images/LOGO-PNG%20BLACKBG.png'
        // );
        // Mail::send('emailku', $temp, function($message) use ($temp) {
        //     $message->to($temp['email']);
        //     $message->from('info@escaper-store.com');
        //     $message->subject('Purchase '.$temp['guest_code']);
        // });

        if ($data->pembayaran == 1) {
            return redirect('/cart/upload-payment/'.$data->id);
        }
        return redirect('/home');
    }

    public function uploadPayment($id) {
        $data['checkout'] = Checkout::find($id);
        $data['textberjalan'] = TextBerjalan::where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->orderBy('created_at')->first();
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
        $data->buktitrf = 'images/userupload/'.$namafile;
        $data->save();
        $file->move('images/userupload', $namafile);
        $temp = array(
            'email' => $data->email,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'guest_code' => $data->guest_code,
            'currency' => $data->currency,
            'grand_total' => $data->grand_total,
            'image' => env('APP_URL').'/'.$data->buktitrf,
            'id' => $request->id
        );
        Mail::send('emailtransfer', $temp, function($message) use ($temp) {
            $message->to('info.escaper@gmail.com');
            $message->from('info@escaper-store.com');
            $message->subject('Purchase '.$temp['guest_code']);
        });
        
        return redirect("/home");
    }
    
    public function received($id)
    {
        $data = Checkout::find($id);
        return view('cart.received', $data);
    }

    public function submitPayment($checkout_id)
    {
        $checkout = Checkout::find($checkout_id);
        return view('submitpayment', $checkout);
    }

    public function setLunas(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'password' => 'required'
        ]);
        if(md5($request->password) == md5('escaper2017')) {
            $data = Checkout::find($request->id);
            $data->lunas = 1;
            $data->save();
            return redirect('/home');
        }
        return redirect('/submitpayment/$request->id');
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
        if ($_COOKIE['currency'] == 'IDR') {
            $grand_total = 'Rp '.number_format($grand_total, 0, ',', '.');
        }
        else {
            $grand_total = '$ '.number_format($grand_total, 2, ',', '.');
        }
        return $grand_total;
    }

    public function checkDiscount($email)
    {
        $count = count(UserShop::where('email', $email)->get());
        return $count;
    }

    public function updateTempCart(Request $request)
    {
        $tc = TempCart::where('guest_code', $_COOKIE['guest_code'])->first();
        if ($request->discount == 1) {
            $discount = $tc->subtotal * 10 / 100;
            $tc->subtotal -= $discount;
            $tc->discount = $discount;
        }
        else {
            $tc->subtotal += $tc->discount;
            $tc->discount = 0;
        }
        $tc->grandtotal = $tc->subtotal + $tc->shipping;
        $tc->save();
    }

    public function checkStockItem($product_id, $size_init)
    {
        $data = ProductAvailability::where('product_id', $product_id)->where('size_init', $size_init)->first();
        return $data->stocks;
    }
}
