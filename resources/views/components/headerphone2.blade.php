<header>
    <nav class="home-nav2" id="navigation">
        <marquee direction="left">
            @php echo $textberjalan; @endphp
        </marquee>
        <div class="wrapper container-lg">
            <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
            <div class="logo" id="header-logo"><a href="/home">Escaper<sup style="font-size:40%; vertical-align:top; top:17px;">&#174;</sup></a></div>
                <input type="radio" name="slide" id="menu-btn">
                <input type="radio" name="slide" id="cancel-btn">
                <ul class="nav-links">
                    <label for="cancel-btn" class="btn cancel-btn"><i class="fas fa-times"></i></label>
                    <li>
                        <a href="/shop" class="desktop-drop">Shop</i></a>
                        <input type="checkbox" id="showDrop">
                        <label for="showDrop" class="mobile-drop"><a href="/shop">Shop</a><i class="fas fa-sort-down"></i></label>
                        <ul class="drop-menu">
                            @foreach($producttypes as $type)
                            <li><a href="/shop?type_id={{$type->id}}">{{$type->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="/lookbook">Lookbook</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            <div class="nav-cart">
                <a href="/cart">   
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z" id="svgcart"/></svg>
                    <p id="cart">0</p>
                </a>
            </div>
        </div>
    </nav>
</header>