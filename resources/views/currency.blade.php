<!DOCTYPE html>
<html lang="en">
    <head>     
        <title>ESCAPER&#174; | Select currency</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <!-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> -->
        <style>
            @font-face {
                font-family: escaperfont;
                src: url({{asset('fonts/Hanson-Bold.ttf')}});
            }
            .currency-wrapper{
                height:100vh;
                display:flex;
                flex-direction:column;
                align-items:center;
                justify-content:center;
            }
            .header-logo {
                font-family: escaperfont;
            }
            .header-logo sup{
                font-size:40%; 
                vertical-align:top; 
                top:25px;
            }
            .header-logo h1{
                font-size: 100px;
                color: black;
            }
            .currency-txt{
                font-size:50px;
                font-weight:600;
                color: black;
            }
            .currencyoption{
                width:25vw;
                height:15vw;
                border:none;
                
                background:white;
                font-size:70px;
                font-weight:900;
                transition: all .1s ease;
            }
            .currencyoption:focus{
                outline:none;
            }
            .currencyoption:hover{
                border:none;
                background:white;
                font-size:100px;
                font-weight:900;
            }
            @media screen and (max-width: 768px) {
                .header-logo h1{
                    font-size: 40px;
                }
                .header-logo sup{
                    font-size:35%; 
                    top:15px;
                }
                .currency-txt{
                    font-size:20px;
                }
                .currency{
                    display:flex;
                    justify-content:center;
                }
                .currencyoption{
                    width:20vw;
                    height:10vw;
                    margin-bottom:10px;
                    font-size:30px;
                    font-weight:800;
                }
                .currencyoption:hover{
                    border:solid black 2px;
                    font-size:30px;
                    font-weight:800;
                }
            }
            
        </style>
    </head>
    <body>
        <div class="currency-wrapper">
            <div class="header-logo">
                <h1>ESCAPER<sup>&#174;</sup></h1>
            </div>
            <div class="currency-txt">
                <p>CHOOSE YOUR CURRENCY</p>
            </div>
            <div class="row">
                <div class="col-6 currency">
                    <form method="POST" ACTION="/welcome">
                        @csrf
                        <input type="hidden" value="IDR" name="currency">
                        <div class="home-item">
                            <button type="submit" class="currencyoption">IDR</button>
                        </div>
                    </form>
                </div>
                <div class="col-6 currency">
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
            <!--div class="currency container text-center">
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
            </div-->
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