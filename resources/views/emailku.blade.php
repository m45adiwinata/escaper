<h3>Halo, {{ $first_name }} {{$last_name}}, you have ordered this items !</h3>
<p>Purchase Code : {{ $guest_code }}</p>
<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price@</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    @foreach($carts as $cart)
        <tr>
            <td><img src="{{$message->embed($cart['image'])}}" alt="{{$cart['name']}}" style="width:240px; height:240px;">{{$cart['name']}}</td>
            <td>{{$cart['qty']}}</td>
            <td>{{$currency == 'IDR' ? 'Rp' : '$'}} {{$cart['price']}}</td>
            <td style="align:right;">{{$currency == 'IDR' ? 'Rp' : '$'}} {{$cart['subtotal']}}</td>
        </tr>
    @endforeach
        <tr>
            <td colspan="3">GRAND TOTAL</td>
            <td>
                {{$currency == 'IDR' ? 'Rp' : '$'}} {{number_format($grand_total, 2, ',', '.')}}
            </td>
        </tr>
    </tbody>
</table>
<p>Thanks for your <a href="https://escaper-store.com/">Escaper Store</a> purchase. Consider to subscribe and stay tune with our project.</p>
<p>Best Regard, Escaper</p>