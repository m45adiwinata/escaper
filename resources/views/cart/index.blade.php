@extends('layouts.main')
@section('title')
 | Cart
@endsection
@section('content')
@include('components.header2')
<div class="product">
    <div class="container" id="cart-container">
        @php $grandtotal = 0; $subtotal = 0; @endphp
        @if(count($carts) > 0)
        <div class="row" id="contained">
            <div class="col-md-12">
                <table class="tbl">
                    <tr>
                        <td><a href="/cart">SHOPPING CART</a></td>
                        <td>></td>
                        <td>CHECKOUT DETAILS</td>
                        <td>></td>
                        <td>ORDER COMPLETE</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <thead class="border-bottom">
                        <tr>
                            <td class="font-weight-bold" style="width:40%;">PRODUCT</td>
                            <td class="font-weight-bold" style="width:20%;">PRICE</td>
                            <td class="font-weight-bold" style="width:20%;">QUANTITY</td>
                            <td class="font-weight-bold" style="width:20%;">SUBTOTAL</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $cart)
                        <tr id="cart-row-{{$cart->id}}">
                            <td>
                                <button class="tombol-delete-cart" id="btn-delete-{{$cart->id}}" onclick="deleteCartItem({{$cart->id}})">x</button>
                                <img src="{{$cart->product()->first()->image[0]}}" alt="Image" class="img-fluid" style="width:75px; height:75px;">
                                <a class="hitam-ke-orange" href="product?productid={{$cart->product()->first()->id}}">{{$cart->product()->first()->name}} - {{$cart->avl->size_init}}</a>
                            </td>
                            <td class="align-middle">
                                {{$_COOKIE['currency'] == 'IDR' ? 'Rp ': '$ '}}
                                @if ($_COOKIE['currency'] == 'IDR')
                                {{number_format($cart->avl->IDR, 0, ',', '.')}}
                                @else
                                {{number_format($cart->avl->USD, 2, ',', '.')}}
                                @endif
                            </td>
                            <td class="align-middle">
                                <input type="number" placeholder="First name" value="{{$cart->amount}}" id="qty-{{$cart->id}}" min="1" max="{{$cart->avl->stocks}}" onchange="changeQty({{$cart->id}})" required>
                            </td>
                            <td class="align-middle">
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
                    </tbody>
                </table>
                <hr>
                <a href="/shop" class="btn btn-black btn-outline-black rounded-0">&#8592; CONTINUE SHOPPING</a>
            </div>
            <div class="col-md-4 border-left border-right">
                <table class="table table-borderless">
                    <thead class="border-bottom">
                        <tr>
                            <td class="font-weight-bold">CART TOTALS</td>
                        </tr>
                    </thead>
                </table>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <span>Subtotal</span>
                    </div>
                    <div class="col-md-6 text-right">
                        <b id="subtotal">
                            {{$_COOKIE['currency'] == 'IDR' ? 'Rp ' : '$ '}}
                            @if($_COOKIE['currency'] == 'IDR')
                            {{number_format($subtotal,0,',','.')}}
                            @else
                            {{number_format($subtotal,2,',','.')}}
                            @endif
                        </b>
                    </div>
                </div>
                @php $grandtotal = $subtotal; @endphp
                <div class="row">
                    <div class="col-md-6 text-left">
                        <span>Total</span>
                    </div>
                    <div class="col-md-6 text-right">
                        <b id="grandtotal">
                            {{$_COOKIE['currency'] == 'IDR' ? 'Rp ' : '$ '}}
                            @if($_COOKIE['currency'] == 'IDR')
                            {{number_format($grandtotal,0,',','.')}}
                            @else
                            {{number_format($grandtotal,2,',','.')}}
                            @endif
                        </b>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="/cart/checkout" class="btn w-100" style="background:black; color:white;">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="emptycart" style="display:none;">
            <div class="col-md-12">
                Your cart is currently empty. <a href="/shop">back to shop.</a>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-12">
                Your cart is currently empty. <a href="/shop">back to shop.</a>
            </div>
        </div>
        @endif
    </div>
</div>
@include('components.footer')
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
                        $('#cart-black').html(data.count);
                        // $('#cart-items').empty();
                        // for (var i=0; i<data.count; i++) {
                        //     $('#cart-items').append('<li>'+data.items[i].product_name+' '+data.items[i].amount+'</li>');
                        // }
                        $('#contained').css('display', 'none');
                        $('#emptycart').css('display', 'block');
                    }
                    else {
                        // $('#cart').css('color', 'black');
                        $('#cart-black').html('0');
                        // $('#cart-items').empty();
                        // $('#contained').css('display', 'none');
                        // $('#emptycart').css('display', 'block');
                    }
                });
            });
        });
    }
    $(document).ready(function() {
        $("input[type='number']").inputSpinner();
    });
</script>
@endsection