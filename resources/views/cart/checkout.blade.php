@extends('layouts.main')

@section('content')
@include('components.header2')
<div class="product">
    <div class="container">
        <table class="tbl">
            <tr>
                <td><a href="/cart">SHOPPING CART</a></td>
                <td>></td>
                <td><a href="/cart/checkout">CHECKOUT DETAILS</td>
                <td>></td>
                <td>ORDER COMPLETE</td>
            </tr>
        </table>
        <div class="message-container container medium-text-center">
            Returning customer? <a href="#" class="showlogin hitam-ke-orange" id="showlogin">Click here to login</a>
            <div id="login" style="display:none;">
                <form action="" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username"><b>Username or email *</b></label>
                            <input type="email" class="form-control" name="username" id="username" placeholder="" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password"><b>Password *</b></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkRemember" name="checkRemember">
                            <label class="form-check-label" for="checkRemember">
                                <b>Remember me</b>
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div>
            Have a coupon? <a href="#" class="showlogin hitam-ke-orange" id="showcoupon">Click here to enter your code</a>
            <div id="coupon" style="display:none;">
                <form action="" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="coupon">If you have a coupon code, please apply it below.</label>
                            <input type="text" id="coupon" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="coupon"><span style="color:white;">.</span></label>
                            <br>
                            <button class="btn" type="submit">APPLY COUPON</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12"><h4>BILLING & SHIPPING</h4></div>
        </div>
        <form action="/cart/place-order" method="POST">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputFirstName"><b>First Name</b></label>
                                <input type="text" class="form-control" name="firstName" id="inputFirstName" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputLastName"><b>Last Name (optional)</b></label>
                                <input type="text" class="form-control" name="lastName" id="inputLastName" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCompany"><b>Company/Organization (optional)</b></label>
                            <input type="text" class="form-control" name="company" id="inputCompany" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="selectCountry"><b>Country *</b></label>
                            <select class="form-control" id="selectCountry" name="country"><option value="" selected="selected" disabled></option></select>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress"><b>Address *</b></label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="" name="address">
                        </div>
                        <div class="form-group">
                            <label for="inputCity"><b>City *</b></label>
                            <input type="text" class="form-control" id="inputCity" placeholder="" name="city">
                        </div>
                        <div class="form-group">
                            <label for="inputZipCode"><b>Zip Code (optional)</b></label>
                            <input type="text" class="form-control" id="inputZipCode" placeholder="" name="zipcode">
                        </div>
                        <div class="form-group">
                            <label for="inputPhone"><b>Phone *</b></label>
                            <input type="text" class="form-control" id="inputPhone" placeholder="" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail"><b>Email address *</b></label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="" name="email">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="subscribe" id="checkSubscribe" name="checkSubscribe" checked>
                                <label class="form-check-label" for="checkSubscribe">
                                <b>Subscribe to our newsletter</b>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="createAcc" id="checkCreateAcc" name="checkCreateAcc">
                                <label class="form-check-label" for="checkCreateAcc">
                                Create an account?
                            </label>
                        </div>
                        <br>
                        <h4>ADDITIONAL INFORMATION</h4>
                        <div class="form-group">
                            <label for="inputNotes"><b>Order notes (optional)</b></label>
                            <textarea class="form-control" id="inputNotes" rows="4" name="notes"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div style="font-size:14px; border: 3px solid black; padding:15px;">
                            <h4>YOUR ORDER</h4>
                            <table class="table">
                                <tr>
                                    <th class="text-left">PRODUCT</th>
                                    <th class="text-right">SUBTOTAL</th>
                                </tr>
                                @php $subtotal = 0; @endphp
                                @foreach($carts as $cart)
                                <tr>
                                    <td class="text-left">{{$cart->product()->first()->name}} <b>x {{$cart->amount}}</b></td>
                                    <td class="text-right">
                                        <b>
                                            @php $subtotal+= $cart->total; @endphp
                                            {{($_COOKIE['currency'] == 'IDR') ? 'Rp ' : '$'}}
                                            {{number_format($cart->total, 2, ',', '.')}}
                                        </b>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="text-left"><b>Subtotal</b></td>
                                    <td class="text-right">
                                        <b>
                                            {{($_COOKIE['currency'] == 'IDR') ? 'Rp ' : '$'}}
                                            {{number_format($subtotal, 2, ',', '.')}}
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left"><b>Shipping</b></td>
                                    <td class="text-right">
                                        <b>
                                            @php $shipping = 0; @endphp
                                            Free shipping.
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left"><b>Total</b></td>
                                    <td class="text-right">
                                        <b>
                                            @php $grandtotal = $subtotal + $shipping; @endphp
                                            {{($_COOKIE['currency'] == 'IDR') ? 'Rp ' : '$'}} {{number_format($grandtotal, 2, ',', '.')}}
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radTrfBank" id="radTrfBank" value="option1" checked>
                                            <label class="form-check-label" for="radTrfBank">
                                                <b>Transfer BCA 6115373947 a/n I Made Bayu Dharma Wibawa</b>
                                            </label>
                                            <br>
                                            Make your payment directly into our bank account. 
                                            Please use your Order ID as the payment reference to escaper@gmail.com. 
                                            Your order will not be shipped until the funds have cleared in our account.
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radPayPal" id="radPayPal" value="option2">
                                            <label class="form-check-label" for="radPayPal">
                                                <b>PayPal</b>
                                                <img src="{{asset('images/paypal icon.png')}}" alt="PayPal Icon" style="width:84px;height:37px;">
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="submit" class="btn btn-primary">PLACE ORDER</button></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@include('components.footer')
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $.get('https://restcountries.eu/rest/v2/all', function(countries) {
            countries.forEach(country => {
                $('#selectCountry').append('<option value="'+country.name+'">'+country.name+'</option>');
            });
        });
        $('#selectCountry').select2();
        $('#radPayPal').change(function() {
            $('#radTrfBank').removeAttr("checked");
        });
        $('#radTrfBank').change(function() {
            $('#radPayPal').removeAttr("checked");
        });
        $('#showlogin').click(function() {
            $('#login').css('display', 'block');
        });
        $('#showcoupon').click(function() {
            $('#coupon').css('display', 'block');
        });
    });
</script>
@endsection