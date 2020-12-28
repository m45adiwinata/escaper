@extends('layouts.phone')
@section('content')
@include('components.headerphone')
<section>
    <div class="container-lg">
        <div class="shop-wrapper">
        <div class="shop-top">
            <p>Shop</p>
        </div>
        <div class="row">
            @foreach($products as $product)
            <div class="col-sm-6 col-md-4">
                <div class="item">
                    <a href="/product?productid={{$product->id}}">
                        <div class="item-img">
                            @if(count($product->image) > 1) 
                            <img src="{{$product->image[1]}}" alt="{{$product->name}}" class="img-back">
                            @endif
                            <img src="{{$product->image[0]}}" alt="{{$product->name}}" class="">
                        </div>
                    </a>
                    <div class="item-info">
                    <p class="item-category">{{strtoupper($product->type()->first()->name)}}</p>
                    <p class="item-name">{{$product->name}}</p>
                    <p class="item-price">{{$_COOKIE["currency"] == "IDR" ? "Rp".number_format($product->availability()->first()->IDR, 0, ',', '.') : "$ ".number_format($product->availability()->first()->USD, 2, ',', '.') }}</p>
                    </div>
                    <div class="item-options">
                    <a class="item-btn" href="/product?productid={{$product->id}}">Select Options</a>
                    </div>
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