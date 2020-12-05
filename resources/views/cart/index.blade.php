@extends('layouts.main')

@section('content')
@include('components.header2')
<div class="product">
    <div class="container">
        @php $grandtotal = 0; @endphp
        @foreach($carts as $cart)
        <div class="row" id="cart-row-{{$cart->id}}">
            <div class="col-sm-3">
                {{$cart->product()->first()->name}}
                <br>
                <img src="images/{{$cart->product()->first()->image[0]}}" alt="Image" class="img-fluid" style="width:125px; height:125px;">
            </div>
            <div class="col-sm-4">
                @if ($_COOKIE['currency'] == 'IDR')
                Rp {{number_format($cart->avl->IDR, 2, ',', '.')}}
                @else
                {{number_format($cart->avl->USD, 2, ',', '.')}} $
                @endif
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" placeholder="First name" value="{{$cart->amount}}" id="qty-{{$cart->id}}" onchange="changeQty({{$cart->id}})" required>
                    </div>
                    <div class="col-md mb-3">
                        <input type="range" class="custom-range" min="1" max="{{$cart->avl->stocks}}" step="1" id="range-qty-{{$cart->id}}"  onchange="changeRangeQty({{$cart->id}})" value="{{$cart->amount}}">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <h5>
                    @if ($_COOKIE['currency'] == 'IDR')
                    @php $total = $cart->avl->IDR * $cart->amount; $grandtotal += $total; @endphp
                    Rp <span id="total-{{$cart->id}}">{{number_format($total, 2, ',', '.')}}</span>
                    @else
                    @php $total = $cart->avl->USD * $cart->amount; $grandtotal += $total; @endphp
                    <span id="total-{{$cart->id}}">{{number_format($total, 2, ',', '.')}}</span> $
                    @endif
                </h5>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-danger" id="btn-delete-{{$cart->id}}" onclick="deleteCartItem({{$cart->id}})">x</button>
            </div>
        </div>
        @endforeach
        <div class="row" id="cart-row-grandtotal">
            <div class="col-sm-3"></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-3">
                <h5 id="grandtotal">{{($_COOKIE['currency'] == 'IDR') ? 'Rp ' : ''}}{{number_format($grandtotal, 2, ',', '.')}}{{($_COOKIE['currency'] == 'USD') ? ' $ ' : ''}}<h5>
            </div>
            <div class="col-sm-2"><a href="/cart/checkout" class="btn btn-success">CHECKOUT</a></div>
        </div>
    </div>
</div>
@include('components.footer')
@endsection
@section('script')
<script>
    function changeQty(id) {
        $('#range-qty-'+id).val($('#qty-'+id).val());
        $.get('/cart/change-amount?cart_id=' + id +'&qty=' + $('#qty-'+id).val(), function(total) {
            $('#total-'+id).html(total);
        });
        $.get('/cart/get-grand-total', function(grandtotal) {
            $('#grandtotal').html(grandtotal);
        });
    }
    function changeRangeQty(id) {
        $('#qty-'+id).val($('#range-qty-'+id).val());
        $.get('/cart/change-amount?cart_id=' + id +'&qty=' + $('#qty-'+id).val(), function(total) {
            $('#total-'+id).html(total);
        });
        $.get('/cart/get-grand-total', function(grandtotal) {
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
            });
            $.get('/cart-check', function(data) {
                console.log(data.count);
                if (data.count > 0) {
                    $('#cart').css('color', 'white');
                    $('#cart').html(data.count);
                    $('#cart-items').empty();
                    for (var i=0; i<data.count; i++) {
                        $('#cart-items').append('<li>'+data.items[i].product_name+' '+data.items[i].amount+'</li>');
                    }
                }
                else {
                    $('#cart').css('color', 'black');
                    $('#cart').html('0');
                    $('#cart-items').empty();
                }
            });
        });
    }
    $(document).ready(function() {
        
    });
</script>
@endsection