@extends('layouts.phone')
@section('title')
 | Cart
@endsection
@section('content')
@include('components.headerphone2')
<div class="product">
    <div class="container-lg" id="cart-container">
        <div class="cart-wrapper">
            @php $grandtotal = 0; $subtotal = 0; @endphp
            @if(count($carts) > 0)
            <div id="contained">
                <div class="cart-top">
                    <a class="shopping-carts" href="">Shopping Carts</a>
                    <p>></p>
                    <p class="checkout-detail">Checkout Detail</p>
                    <p>></p>
                    <p class="order-complete">Order Complete</p>
                </div>
                <div class="cart-removed" id="">
                    <div><i class="fas fa-check"></i> (nama-product) has been removed from cart. <a href="">Undo ?</a></div>
                </div>
                <div class="row">
                    
                    <div class="col-md-8">
                        <div class="cart-detail">
                            <table>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                                @foreach($carts as $cart)
                                <tr id="cart-row-{{$cart->id}}">
                                    <td>
                                        <button id="btn-delete-{{$cart->id}}" onclick="deleteCartItem({{$cart->id}})"><i class="far fa-times-circle"></i></button>
                                        <img src="{{$cart->product()->first()->image[0]}}" alt="Image" height="60px">
                                        <a href="product?productid={{$cart->product()->first()->id}}">{{$cart->product()->first()->name}} - {{$cart->avl->size_init}}</a>
                                    </td>
                                    <td style="width:15%;">
                                        {{$_COOKIE['currency'] == 'IDR' ? 'Rp ': '$ '}}
                                        @if ($_COOKIE['currency'] == 'IDR')
                                        {{number_format($cart->avl->IDR, 0, ',', '.')}}
                                        @else
                                        {{number_format($cart->avl->USD, 2, ',', '.')}}
                                        @endif
                                    </td>
                                    <td style="width:25%;">
                                        <input type="number" class="cart-spinner" value="{{$cart->amount}}" id="qty-{{$cart->id}}" min="1" max="{{$cart->avl->stocks}}" onchange="changeQty({{$cart->id}})" required>
                                    </td>
                                    <td style="width:20%;">
                                        {{$_COOKIE['currency'] == 'IDR' ? 'Rp ': '$ '}}
                                        @if ($_COOKIE['currency'] == 'IDR')
                                        @php $total = $cart->avl->IDR * $cart->amount; $subtotal += $total; @endphp
                                        <span id="total-{{$cart->id}}">{{number_format($total, 0, ',', '.')}}</span>
                                        @else
                                        @php $total = $cart->avl->USD * $cart->amount; $subtotal += $total; @endphp
                                        <span id="total-{{$cart->id}}">{{number_format($total, 2, ',', '.')}}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <a class="btn btn-continue-shop" href="/shop"><i class="far fa-arrow-alt-circle-left"></i>Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cart-total">
                            <table>
                                <tr>
                                    <th>Cart Total</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>
                                        <b id="subtotal">
                                            {{$_COOKIE['currency'] == 'IDR' ? 'Rp ' : '$ '}}
                                            @if($_COOKIE['currency'] == 'IDR')
                                            {{number_format($subtotal,0,',','.')}}
                                            @else
                                            {{number_format($subtotal,2,',','.')}}
                                            @endif
                                        </b>
                                    </td>
                                </tr>
                                @php $grandtotal = $subtotal; @endphp
                                <tr>
                                    <td>Total</td>
                                    <td>
                                        <b id="grandtotal">
                                            {{$_COOKIE['currency'] == 'IDR' ? 'Rp ' : '$ '}}
                                            @if($_COOKIE['currency'] == 'IDR')
                                            {{number_format($grandtotal,0,',','.')}}
                                            @else
                                            {{number_format($grandtotal,2,',','.')}}
                                            @endif
                                        </b>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-to-checkout" href="/cart/checkout">Procced to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="emptycart" style="display:none;">
                <div class="cart-empty ">
                    <!-- <img src="/images/phone/sad-cart.png" alt="sad-cart"> -->
                    <p>Your cart is currently empty.</p>
                    <a class="btn btn-to-shop" href="/shop">Back to Shop</a>
                </div>
            </div>
            @else
            <div class="row">
                <div class="cart-empty">
                    <!-- <img src="/images/phone/sad-cart.png" alt="sad-cart"> -->
                    <p>Your cart is currently empty.</p>
                    <a class="btn btn-to-shop" href="/shop">Back to Shop</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@include('components.footerphone')
@endsection
@section('script')
<script>
    function changeQty(id) {
        $.get('/cart/change-amount?cart_id=' + id +'&qty=' + $('#qty-'+id).val(), function(total) {
            $('#total-'+id).html(total);
        });
        $.get('/cart/get-grand-total', function(grandtotal) {
            $('#subtotal').html(grandtotal);
            $('#grandtotal').html(grandtotal);
        });
    }
    function deleteCartItem(id) {
        $.get('/cart/delete-item?cart_id=' + id, function(response) {
            if (response == 1) {
                $('#cart-row-'+id).remove();
            }
            $.get('/cart/get-grand-total', function(grandtotal) {
                $('#grandtotal').html(grandtotal);
                $('#subtotal').html(grandtotal);
                $.get('/cart-check', function(data) {
                    if (data.count > 0) {
                        console.log('none');
                        // $('#cart').css('color', 'white');
                        $('#cart').html(data.count);
                        // $('#cart-items').empty();
                        // for (var i=0; i<data.count; i++) {
                        //     $('#cart-items').append('<li>'+data.items[i].product_name+' '+data.items[i].amount+'</li>');
                        // }
                        $('#contained').css('display', 'block');
                        $('#emptycart').css('display', 'none');
                    }
                    else {
                        // $('#cart').css('color', 'black');
                        $('#cart').html('0');
                        // $('#cart-items').empty();
                        $('#contained').css('display', 'none');
                        $('#emptycart').css('display', 'block');
                    }
                });
            });
        });
    }
    $(document).ready(function() {
        $("input[type='number']").inputSpinner({
            buttonsWidth: "0.1rem",
            groupClass: "cart-spinner",
            buttonsClass: "cart-btn-spinner",
        });
    });
</script>
@endsection