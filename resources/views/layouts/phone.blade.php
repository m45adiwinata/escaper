<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ Session::token() }}"> 
    <title>ESCAPER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.5/swiper-bundle.min.js"></script>
    <script src="/js/bootstrap-input-spinner.js"></script>
    <script src="/js/phone.js"></script>
    @yield('script')
    </body>
</html>