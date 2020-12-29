@extends('layouts.main')
@section('title')
 | {{$product->name}}
@endsection
@section('content')
@include('components.header2')
<div class="product">
	<div class="container">
    <div class="shop-header">
      <div class="row" style="border:1px solid black; padding:5px; display:none;" id="notification">
        <div class="col-sm-9 pt-1">&#10003 "{{$product->name}}" has been added to your cart.</div>
        <div class="col-sm-3 text-right"><a class="btn btn-success text-light" style="background:black;" href="/cart">VIEW CART</a></div>
      </div>
      <p>{{strtoupper($product->type()->first()->name)}}</p>
    </div>
		<div class="row">
    		<div class="col-sm-6">
          <div class="swiper-container gallery-top mb-4">
            <div class="swiper-wrapper">
              @foreach($product->image as $image)
              <div class="swiper-slide cover" style="background-image:url({{$image}})"></div>
              @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
          <div class="swiper-container gallery-thumbs">
            <div class="swiper-wrapper">
              @foreach($product->image as $image)
              <div class="swiper-slide" style="background-image:url({{$image}})"></div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-sm-5 ml-5 mb-5">
          <h1 class="">{{$product->name}}</h1>
          @if($_COOKIE["currency"] == "IDR")
          <h2 class="mt-2 mb-2 pb-2"><span>Rp. </span><span id="price">{{number_format($product->availability()->first()->IDR, 2, ',', '.')}}</span></h2>
          @else
          <h2 class="mt-2 mb-2 pb-2"><span> $</span><span id="price">{{number_format($product->availability()->first()->USD, 2, ',', '.')}}</span></h2>
          @endif
          <p class="pt-3">{{$product->desc}}</p>
          <div class="size-chart mt-4" style=""></div>
          <div class=" row input-group my-3">
            <div class="col-3">
              <p >Size</p>
            </div>
            <div class="col-9">
              <select class="custom-select" id="inputGroupSelect01">
                @foreach($product->availability()->get()->pluck('size_init', 'id') as $size)
                <option value="{{$size}}">{{$size}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row input-group my-3">
            <div class="col-3">
              <p >Quantity</p>
            </div>
            <div class="col-9">
              <input id="qty" type="number" value="1" min="1" max="{{$product->stocks}}" />
            </div>
          </div>
          <button class="btn btn-cart rounded-1" style="background-color:black;" id="btn-add2cart">Add to cart</button>
        </div>
      </div>
  </div>
</div>
<br>
<br>
<br>
<br>
@include('components.footer')
@endsection
@section('script')
<script>
  $("input[type='number']").inputSpinner();

  var galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 15,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-top', {
      spaceBetween: 10,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: galleryThumbs
      }
    });
    $(document).ready(function() {
      $('#inputGroupSelect01').change(function() {
        $.get('/get-product-price/' + {!! $product->id !!} + '/' + $(this).val(), function(data) {
          if ("{!! $_COOKIE["currency"] !!}" == "IDR") {
            $('#price').html(data.IDR);
          }
          else {
            $('#price').html(data.USD);
          }
          $('#qty').attr('max', data.stocks);
        });
      });
      $('#btn-add2cart').click(function() {
        if ($('#inputGroupSelect01').val() != "") {
          $([document.documentElement, document.body]).animate({
              scrollTop: $("#elementtoScrollToID").offset().top
          }, 200);
          $.get('/add-to-cart/' + {!! $product->id !!} + '/' + $('#inputGroupSelect01').val() + '/' + $('#qty').val(), function(response) {
            $.get('/cart-check', function(data) {
              if (data.count > 0) {
                $('#cart').html(data.count);
                $('#cart-black').html(data.count);
                $('#notification').css('display', 'block');
                
                // $('#cart-items').empty();
                // for (var i=0; i<data.count; i++) {
                //   $('#cart-items').append('<li>'+data.items[i].product_name+' '+data.items[i].amount+'</li>');
                // }
              }
            });
          });
          
        }
        else {
          alert("please choose your desired size first.");
        }
      });
    });
</script>
@endsection