<img src="{{$message->embed($logo)}}" alt="ESCAPER'S LOGO" style="width:887px; height:133px; display:block; margin-left:auto; margin-right:auto;">
<h2 style="text-align:center;">Thank you {{ $first_name }} {{$last_name}},<br>your order has been received.</h2>
<h4 style="text-align:center;">Purchase Code : {{ $guest_code }}</h4>
<br>
<h4>Customer Info</h4>
<hr>
{{ $first_name }} {{$last_name}}<br>
{{ $address }}, {{ $city }}, {{ $zipcode }}<br>
{{ $country }}<br>
{{ $phone }}
<br>
<br>
<table class="table">
    <thead>
        <tr>
            <th colspan="2">Product</th>
            <th style="padding:10px;">Quantity</th>
            <th style="padding:10px;">Price</th>
        </tr>
    </thead>
    <tbody>
    @foreach($carts as $cart)
        <tr>
            <td style=""><img src="{{$message->embed($cart['image'])}}" alt="{{$cart['name']}}" style="width:240px; height:240px;"></td>
            <td>{{$cart['name']}}</td>
            <td style="text-align:center;">{{$cart['qty']}}</td>
            <td style="text-align:center;">{{$currency == 'IDR' ? 'Rp' : '$'}} {{$cart['price']}}</td>
        </tr>
    @endforeach
        <tr>
            <td></td>
            <td>
                Payment<br>
                Subtotal<br>
                {{ $discount == 0 ? '' : 'Discount<br>' }}
                Shipping<br>
                Total<br>
            </td>
            <td>
                :<br>
                :<br>
                {{ $discount == 0 ? '' : ':<br>' }}
                :<br>
                :<br>
            </td>
            <td>
                {{ $payment }}<br>
                {{$currency == 'IDR' ? 'Rp ' : '$ '}}{{number_format($sub_total, 2, ',', '.')}}<br>
                @if($discount > 0)
                {{$currency == 'IDR' ? 'Rp '.number_format($discount, 2, ',', '.').'<br>' : '$ '.number_format($discount, 2, ',', '.').'<br>'}}
                @endif
                {{$currency == 'IDR' ? 'Rp '.number_format($shipping, 2, ',', '.') : '$ '.number_format($shipping, 2, ',', '.')}}<br>
                {{$currency == 'IDR' ? 'Rp ' : '$ '}}{{ number_format($grand_total, 2, ',', '.') }}<br>
            </td>
        </tr>
    </tbody>
</table>
<p>Thanks for your <a href="https://escaper-store.com/">Escaper Store</a> purchase. Consider to subscribe and stay tune with our project.</p>
<p>Best Regard, Escaper</p>