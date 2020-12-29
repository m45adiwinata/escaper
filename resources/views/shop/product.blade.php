@extends('layouts.phone')
@section('content')
@include('components.headerphone')
<section>
    <div class="container-lg">
        <div class="item-wrapper">
            <div class="shop-top">
                <a href="/shop" style="text-decoration:none; color:black;"><p>Shop</p></a>
            </div>
            <div class="row" style="border:1px solid black; padding:5px; display:none;" id="notification">
                <div class="col-sm-8 pt-1">&#10003 "{{$product->name}}" has been added to your cart.</div>
                <div class="col-sm-4 text-right"><a class="btn btn-success text-light" style="background:black; border:1px solid black; border-radius:0px;" href="/cart">VIEW CART</a></div>
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
                                <label for="item-size" style="text-align:left;">Size</label>
                                <select name="item-size" id="item-size">
                                    @foreach($product->availability()->get()->pluck('size_init', 'id') as $size)
                                    <option value="{{$size}}">{{$size}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="item-form my-2">
                                <label for="item-quantity" style="text-align:left;">Quantity</label>
                                <input class="item-spinner" id="quantity" type="number" value="1" min="1" max="{{$product->stocks}}">
                            </div>
                            <div class="item-form">
                                <span id="outofstock" style="display:none; left:0;">Out of stock.</span>
                            </div>
                            <button class="btn-add-cart" id="btn-add-cart">Add to Cart</button>
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
    $(document).ready(function() {
        $.get('/cart/check-stock-item/'+ {!! $product->id !!} + '/' + $('#item-size').val(), function(stock) {
            if(stock == 0) {
                $('#outofstock').css('display','block');
                $('#btn-add-cart').attr('disabled', 'disabled');
                $('#btn-add-cart').css('background-color', 'rgb(100,100,100)');
            }
        });
        $('#item-size').change(function() {
            $.get('/cart/check-stock-item/'+ {!! $product->id !!} + '/' + $('#item-size').val(), function(stock) {
                if(stock == 0) {
                    $('#outofstock').css('display','block');
                    $('#quantity').attr('max', stock);
                    $('#btn-add-cart').attr('disabled', 'disabled');
                    $('#btn-add-cart').css('background-color', 'rgb(100,100,100)');
                }
                else {
                    $('#outofstock').css('display','none');
                    $('#quantity').attr('max', stock);
                    $('#btn-add-cart').removeAttr('disabled');
                    $('#btn-add-cart').css('background-color', 'black');
                }
            }); 
        });
        $("input[type='number']").inputSpinner({
            buttonsWidth: "0.5rem",
            groupClass: "item-spinner",
            buttonsClass: "btn-spinner",
        });
        $('#btn-add-cart').click(function() {
            $([document.documentElement, document.body]).animate({
                scrollTop: $(document.body).offset().top
            }, 200);
            $.get('/add-to-cart/' + {!! $product->id !!} + '/' + $('#item-size').val() + '/' + $('#quantity').val(), function(response) {
                $.get('/cart-check', function(data) {
                    if (data.count > 0) {
                        $('#cart').html(data.count);
                        $('#cart-black').html(data.count);
                        $('#notification').css('display', 'block');
                    }
                });
            });
        });
    });
    
    
    
</script>
@endsection