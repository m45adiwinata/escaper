<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ESCAPER&#174; | Select currency</title>
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <!-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> -->
        <style>
            @font-face {
                font-family: escaperfont;
                src: url({{asset('fonts/Hanson-Bold.ttf')}});
            }
            #header-logo {
                font-family: escaperfont;
            }
            .currencyoption {
                border:none; padding:0px; font-size:80px; font-weight: 800; width:200px; height:200px; background:white;
                padding-bottom:100px;
            }
            .row-opt {
                display: -ms-flexbox; /* IE10 */
                display: flex;
                -ms-flex-wrap: wrap; /* IE10 */
                flex-wrap: wrap;
                padding: 0 4px;
            }
            .column {
                -ms-flex: 50%; /* IE10 */
                flex: 50%;
                max-width: 50%;
                padding: 0 4px;
            }
            @media screen and (max-width: 500px) {
                .currencyoption {
                    font-size:60px;
                }
                .choose {
                    font-size:150%; font-weight: 500;
                }
                #header-logo {
                    font-size:50px;
                }
            }
            @media screen and (max-width: 320px) {
                .currencyoption {
                    font-size:30px;
                }
                .choose {
                    font-size:100%; font-weight: 500;
                }
                #header-logo {
                    font-size:30px;
                }
            }
        </style>
    </head>
    <body>
        <div>
            <div class="currency container text-center">
                <div class="row justify-content-center">
                    <div class="col-xl">
                        <h1 class="" id="header-logo" style="font-size:90px;">ESCAPER<sup style="font-size:40%; vertical-align:top; top:7px;">&#174;</sup></h1>
                    </div>
                </div>
                <span style="font-size:300%; font-weight: 800; color:black;" class="choose">CHOOSE YOUR CURRENCY</span>
                <div class="row-opt">
                    <div class="column">
                        <form method="POST" ACTION="/welcome">
                            @csrf
                            <input type="hidden" value="IDR" name="currency">
                            <div class="home-item">
                                <button type="submit" class="currencyoption">IDR</button>
                            </div>
                        </form>
                    </div>
                    <div class="column">
                        <form method="POST" ACTION="/welcome">
                            @csrf
                            <input type="hidden" value="USD" name="currency">
                            <div class="home-item">
                                <button type="submit" class="currencyoption">USD</button>
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
        <script>
            $(document).ready(function() {
                // $('.currencyoption').hover(function() {
                //     $(this).css('font-size','90px');
                // }, function() {
                //     $(this).css('font-size','80px');
                // });
            });
        </script>
    </body>
</html>