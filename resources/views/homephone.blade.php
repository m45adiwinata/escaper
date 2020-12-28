@extends('layouts.phone')
@section('content')
@include('components.headerphone')
<section>
    <div class="homepage" style="background-image: url(/images/phone/back.jpg);">
        <a href="/shop">Shop Now</a>
    </div>
</section>
<section>
    <div class="container-lg">
        <div class="home-look row">
        <div class="col-md-4">
            <div style="background-image: url(/images/phone/home-img1.jpg);" class="home-img"></div>
        </div>
        <div class="col-md-4">
            <div style="background-image: url(/images/phone/home-img2.jpg);" class="home-img"></div>
        </div>
        <div class="col-md-4">
            <div style="background-image: url(/images/phone/home-img3.jpg);" class="home-img"></div>
        </div>
        </div>
    </div>
</section>
@include('components.footerphone')
@endsection