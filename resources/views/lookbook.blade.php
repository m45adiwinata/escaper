@extends('layouts.phone')
@section('title')
 | Lookbook
@endsection
@section('content')
@include('components.headerphone2')
<div class="lookbook">
<div class="swiper-container">
    <div class="swiper-wrapper">
      @foreach($lookbook as $lb)
    	<div class="swiper-slide" style="background-image:url({{$lb->image}})"></div>
      @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
</div>
	
@include('components.footer')
@endsection
	
@section('script')
<script>
var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        el: '.swiper-pagination',
      },
    });
</script>
@endsection