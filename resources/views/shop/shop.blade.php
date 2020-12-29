@extends('layouts.phone')
@section('content')
@include('components.headerphone2')
<section>
      <div class="container-lg">
         <div class="shop-wrapper">
            <div class="shop-row">
                @foreach($products as $product)
                <div class="shop-col">
                    <div class="item-img">
                        <a href="/product?productid={{$product->id}}">
                            <img class="img-top" src="{{$product->image[0]}}" alt="items-img">
                            @if(count($product->image) > 1)
                            <img class="img-back" src="{{$product->image[1]}}" alt="items-img">
                            @endif
                        </a>
                    </div>
                    <div class="item-info">
                        <p class="item-category">{{strtoupper($product->type()->first()->name)}}</p>
                        <p class="item-name">{{$product->name}}</p>
                        <p class="item-price">{{$_COOKIE["currency"] == "IDR" ? "Rp".number_format($product->availability()->first()->IDR, 0, ',', '.') : "$ ".number_format($product->availability()->first()->USD, 2, ',', '.') }}</p>
                    </div>
                    <div class="item-options">
                        <a class="item-btn" href="/product?productid={{$product->id}}">Select Options</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="shop-top">
                <p> </p>
            </div>
         </div>
      </div>
   </section>
@include('components.footerphone')
@endsection