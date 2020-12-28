 <header class="site-navbar py-2 js-sticky-header" role="banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-2">
                <a href="/home"><h1 class="" id="header-logo">ESCAPER<sup style="font-size:40%; vertical-align:top; top:7px;">&#174;</sup></h1></a>
            </div>
            <div class="col-xl-10 ">
                <nav class="site-navigation" role="navigation">
                    <ul class="site-menu main-menu ">
                        <li><a href="/shop" class="">SHOP</a>
                            <ul class="submenu">
                                <li><a href="/shop?type_id=1">T-SHIRTS</a></li>
                                <li><a href="/shop?type_id=2">SWEATSHIRTS</a></li>
                                <li><a href="/shop?type_id=3">HATS</a></li>
                                <li><a href="/shop?type_id=4">JACKETS</a></li>
                                <li><a href="/shop?type_id=5">PRINTS</a></li>
                            </ul>
                        </li>
                        <li><a href="/lookbook" >LOOKBOOK</a></li>
                        <li><a href="/about" >ABOUT</a></li>
                        <li><a href="/contact" >CONTACT</a></li>
                        @include('components.cart')
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>