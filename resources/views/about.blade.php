@extends('layouts.phone')
@section('content')
@include('components.headerphone2')
<section>
    <div class="about-wrapper" style="background-image: url({{$about->background}});">
    <div class="container-lg">
        <div class="about-content">
            <p>{{$about->text1}}</p>
            <br>
            <p>{{$about->text2}}</p>
        </div>
    </div>
    </div>
</section>
@include('components.footerphone')
@endsection