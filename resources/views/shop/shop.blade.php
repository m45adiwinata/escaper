@extends('layouts.phone')
@section('content')
@include('components.headerphone2')
<section>
      <div class="container-lg">
         <div class="shop-wrapper">
            <div class="row">
                @foreach($products as $product)
                <div class="col-6 col-md-3">
                    <div class="item">
                        <a href="/product?productid={{$product->id}}">
                            <div class="item-img">
                                <img class="" src="{{$product->image[0]}}" alt="items-img">
                                @if(count($product->image) > 1) 
                                <img class="img-back" src="{{$product->image[1]}}" alt="items-img">
                                @endif
                            </div>
                        </a>
                        <div class="item-info">
                            <p class="item-category">{{strtoupper($product->type()->first()->name)}}</p>
                            <p class="item-name">{{$product->name}}</p>
                            @if($_COOKIE["currency"] == "IDR")
                            <p class="item-price">Rp{{number_format($product->availability()->first()->IDR, 0, ',', '.')}}</p>
                            @else
                            <p class="item-price">${{number_format($product->availability()->first()->USD, 2, ',', '.')}}</p>
                            @endif
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