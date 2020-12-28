@extends('layouts.main')
@section('content')
    @include('components.header') 
    <div class="site-blocks-cover overlay" style="background-image: url(images/images1.jpg);" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div>
                    <div style ="margin-top: 25px;" class="row align-items-center justify-content-center">
                        <a href="/shop" class="btn btn-white btn-outline-white py-3 px-5 rounded-0">SHOP NOW</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <div class="site-section">
        <div class="container">
            <div class="row " >
                <div class="col-sm">
                    <div class="home-item">
                        <figure>
                            <img src="images/model_6_bg.jpg" alt="Image" class="img-fluid">
                        </figure>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="home-item">
                        <figure>
                            <img src="images/model_7_bg.jpg" alt="Image" class="img-fluid">
                        </figure>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="home-item">
                        <figure>
                            <img src="images/model_8_bg.jpg" alt="Image" class="img-fluid">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @include('components.footer')
@endsection
@section('script')
@endsection