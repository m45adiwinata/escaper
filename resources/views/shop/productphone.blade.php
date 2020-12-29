@extends('layouts.phone')
@section('content')
@include('components.headerphone')
<section>
    <div class="container-lg">
        <div class="item-wrapper">
            <div class="shop-top">
                <a href="/shop" style="text-decoration:none; color:black;"><p>Shop</p></a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="item-swiper">
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                @foreach($product->image as $image)
                                <div class="swiper-slide" style="background-image: url({{$image}});"></div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next swiper-button-black "></div>
                            <div class="swiper-button-prev swiper-button-black "></div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                @foreach($product->image as $image)
                                <div class="swiper-slide" style="background-image: url({{$image}});"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="item-option">
                        <div class="item-detail">
                            <p class="item-name" >{{$product->name}}</p>
                            <p class="item-price">{{$_COOKIE["currency"] == "IDR" ? "Rp".number_format($product->availability()->first()->IDR, 0, ',', '.') : "$ ".number_format($product->availability()->first()->USD, 2, ',', '.') }}</p>
                            <p class="item-desc">{{$product->desc}}</p>
                        </div>
                        <div class="item-sizechart">
                            <img src="/images/phone/size-chart.jpeg" alt="size-cart">
                        </div>
                        <div class="item-order">
                            <div class="item-form">
                                <label for="item-size">Size</label>
                                <select name="item-size" id="item-size">
                                    @foreach($product->availability()->get()->pluck('size_init', 'id') as $size)
                                    <option value="{{$size}}">{{$size}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="item-form">
                                <label for="item-quantity">Quantity</label>
                                <input class="item-spinner" type="number" value="1" min="1" max="{{$product->stocks}}">
                            </div>
                            <a class="btn-add-cart" id="btn-add-cart">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>`
        </div>
    </div>
</section>
@include('components.footerphone')
@endsection
@section('script')
<script>
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-top',{
        spaceBetween: 10,
        navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
        },
        thumbs:{
        swiper: galleryThumbs
        }
    })

    $("input[type='number']").inputSpinner({
        buttonsWidth: "0.5rem",
        groupClass: "item-spinner",
        buttonsClass: "btn-spinner",
    });
    $('#btn-add-cart').click(function() {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#elementtoScrollToID").offset().top
        }, 200);
        $.get('/add-to-cart/' + {!! $product->id !!} + '/' + $('#inputGroupSelect01').val() + '/' + $('#qty').val(), function(response) {
            // $.get('/cart-check', function(data) {
            //     if (data.count > 0) {
            //         $('#cart').html(data.count);
            //         $('#cart-black').html(data.count);
            //         $('#notification').css('display', 'block');
            //     }
            // });
        });
    });
    
</script>
@endsection