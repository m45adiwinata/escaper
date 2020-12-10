<h3>Transfer payment proof uploaded from {{$first_name}} {{$last_name}}</h3>
<p>Email : {{$email}}</p>
<p>Currency : {{$currency}}</p>
<p>Total : {{$currency == 'IDR' ? 'Rp' : '$'}} {{$grand_total}}</p>
<img src="{{$message->embed($image)}}" alt="{{$image}}" style="width:240px; height:320px;">
<br>
You can confirm its done by click the link below.
<br>
<a href="escaper-store.com/submitpayment/{{$id}}">Submit the payment</a>