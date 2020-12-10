<footer class="site-footer" >
    <div class="container">
    	<div class="row">
    		<div class="col-sm footer-items">
                <a href="#">Stockist</a>
                <a href="#">Shipping</a>
            </div>
            <div class="col-sm footer-subscribe">
                <form action="{{route('subscriber.store')}}" method="POST">
                    @csrf
                    <input type="email" name="email" id="subscribe" placeholder="Enter your email" autocomplete="off">
                    <button class="btn" type="submit">SUBSCRIBE</button>
                </form>
            </div>
    	</div>
        <div class="copyright text-center pt-5">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> ESCAPER | All Right Reserved</p>
        </div>
    </div>
</footer>