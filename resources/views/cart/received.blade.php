@extends('layouts.main')

@section('content')
@include('components.header2')
<div class="about">
	<div class="container " style="background-image: url({{asset('images/images2.jpg')}});">
        <p class="mb-4">Thankyou for your Escaper Store purchase. We have sent the receipt to your email ({{$email}}). Consider to subscribe and stay tune with our project.</p>
    </div>
</div>
@include('components.footer')
@endsection
	
@section('script')
@endsection