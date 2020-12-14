@extends('layouts.main')
@section('title')
 | About
@endsection
@section('content')
@include('components.header2')
<div class="about">
	<div class="container " style="background-image: url('{{$about->background}}');">
        <p class="mb-4">{{$about->text1}}</p>
        <p>{{$about->text2}}</p>
        <p>{{$about->text3}}</p>
        <p><br>{{$about->text4}}</p>
    </div>
</div>
@include('components.footer')
@endsection
	
@section('script')
@endsection