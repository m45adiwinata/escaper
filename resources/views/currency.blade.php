<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Escaper Store</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>
        <div>
        <div class="currency container">
                <h1>CHOOSE YOUR CURRENCY</h1>
                <div class="row justify-content-center">
                    <div class="col-sm-3">
                        <form method="POST" ACTION="/welcome">
                            @csrf
                            <input type="hidden" value="IDR" name="currency">
                            <div class="home-item">
                                <figure>
                                    <button type="submit" style="border:none; padding:0px;"><img src="images/idr2.png" alt="Image" class="img-fluid"></button>
                                </figure>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-3">
                        <form method="POST" ACTION="/welcome">
                            @csrf
                            <input type="hidden" value="USD" name="currency">
                            <div class="home-item">
                                <figure>
                                    <button type="submit" style="border:none; padding:0px;"><img src="images/usd2.png" alt="Image" class="img-fluid"></button>
                                </figure>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        </div>
    
        
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <script src="js/main.js"></script>    
    @yield('script')
    </body>
</html>