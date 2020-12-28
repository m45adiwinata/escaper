<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ESCAPER&#174;@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ Session::token() }}"> 
    
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <style>
            @font-face {
                font-family: escaperfont;
                src: url({{asset('fonts/Hanson-Bold.ttf')}});
            }
            #header-logo {
                font-family: escaperfont;
            }
        </style>
    </head>

    <body>
        <div class="site-wrap">
            @if($_COOKIE['currency'] == 'USD')
            <marquee behavior="scroll" direction="left" style="color:black; font-weight:bold;">
                {{$textberjalan}}
            </marquee>
            @endif
            @yield('content')
        </div>
        <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('js/jquery.stellar.min.js')}}"></script>
        <script src="{{asset('js/jquery.countdown.min.js')}}"></script>
        <script src="{{asset('js/aos.js')}}"></script>
        <script src="{{asset('js/jquery.sticky.js')}}"></script>
        <script src="{{asset('js/bootstrap-input-spinner.js')}}"></script>
        <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script>
            $(document).ready(function() {
                $.get('/cart-check', function(data) {
                    if (data.count > 0) {
                        $('#cart').html(data.count);
                        $('#cart-black').html(data.count);
                        $('#cart-items').empty();
                        // for (var i=0; i<data.count; i++) {
                        //     $('#cart-items').append('<li>'+data.items[i].product_name+' '+data.items[i].amount+'</li>');
                        // }
                    }
                    else {
                        $('#cart').html('0');
                        $('#cart-black').html('0');
                        $('#cart-items').empty();
                    }
                });
            });
        </script>
        @yield('script')
    </body>
</html>