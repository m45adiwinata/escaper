<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ Session::token() }}"> 
    <title>ESCAPER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/main.css?v=').time()}}">
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
        @yield('content')
        <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.5/swiper-bundle.min.js"></script>
        <script src="{{asset('js/bootstrap-input-spinner.js')}}"></script>
        <script src="{{asset('js/phone.js')}}"></script>
    

    <!-- <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('js/aos.js')}}"></script>
    <script src="{{asset('js/jquery.sticky.js')}}"></script>
    <script src="{{asset('js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->
    @yield('script')
    <script>
        $(document).ready(function() {
            $.get('/cart-check', function(data) {
                if (data.count > 0) {
                    $('#cart').html(data.count);
                    $('#cart-black').html(data.count);
                    $('#cart-items').empty();
                }
                else {
                    $('#cart').html('0');
                    $('#cart-black').html('0');
                    $('#cart-items').empty();
                }
            });
        });
    </script>
    </body>
</html>