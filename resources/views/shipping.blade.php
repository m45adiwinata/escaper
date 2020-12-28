@extends('layouts.main')
@section('title')
 | Stockist
@endsection
@section('content')
@include('components.header2')
<div class="about">
	<div class="container ">
        <p class="mb-4" style="color:black;">{{$shipping->text}}</p>
    </div>
</div>
@include('components.footer')
@endsection
	
@section('script')
@endsection