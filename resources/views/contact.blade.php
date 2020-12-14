@extends('layouts.main')
@section('title')
 | Contact
@endsection
@section('content')
@include('components.header2')
<div class="contact">
	<div class="container">
    <div class="row ">
        <div class=" img-about col-md-5 ">
    	    <iframe src="{{$contact->link}}" width="500" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div> 
        <div class="col-md-6 ml-5 contact-us">
            <h3 class="pb-4">Contact Us</h3>
            <p class="">For inquiries regarding online orders please contact us at :</p>
            <p class="">E-mail : <a href="https://mail.google.com/">{{$contact->email}}</a></p>
            <p class="">Instagram : <a href="https://www.insragram.com/">{{$contact->instagram}}</a></p>
            <p class="pt-6" style="position: absolute;bottom: 0;">{{$contact->address}}</p>
        </div>
    </div>
    </div>
</div>
@include('components.footer')
@endsection
	
@section('script')
@endsection