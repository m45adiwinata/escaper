@extends('layouts.main')
@section('title')
 | Shop
@endsection
@section('content')
@include('components.header2')
<div class="shop">
	<div class="container">
    <div class="shop-header">
      <p>SHOP</p>
    </div>
		<div class="row">
      @foreach($products as $product)
      <div class="col-sm-3">
        <div class="product-item">
            <a href="/product?productid={{$product->id}}">
            <figure>
              @if(count($product->image) > 1) 
              <img src="{{$product->image[1]}}" alt="Image" class="bottom img-fluid">
              @endif
              <img src="{{$product->image[0]}}" alt="Image" class=" top img-fluid">
            </figure>
            </a>
          <div class="px-4">
            <p class="category">{{strtoupper($product->type()->first()->name)}}</p>
            <a href="" class="item-name">{{$product->name}}</a>
            @if($_COOKIE["currency"] == "IDR")
            <p class="price">Rp{{number_format($product->availability()->first()->IDR, 0, ',', '.')}}</p>
            @else
            <p class="price">${{number_format($product->availability()->first()->USD, 2, ',', '.')}}</p>
            @endif
            <div>
              <a href="/product?productid={{$product->id}}" class="btn btn-black btn-outline-black rounded-0">Select Options</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@include('components.footer')
@endsection
@section('script')
<script>
  $(document).ready(function() {
  });
</script>
@endsection