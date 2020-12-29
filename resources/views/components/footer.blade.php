<footer class="site-footer">
    <div class="container">
    	<div class="row">
    		<div class="col-sm footer-items">
                <a href="/stockist">Stockist</a>
                <a href="/shipping">Shipping</a>
            </div>
            <div class="col-sm text-right footer-subscribe">
                <form action="{{route('subscriber.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8 pr-0">
                            <input type="email" class="form-control" name="email" id="subscribe" placeholder="Enter your email" autocomplete="off">
                        </div>
                        <div class="col-sm-4" style="padding-left:10px;">
                            <button class="btn" type="submit">SUBSCRIBE</button>
                        </div>
                    </div>
                </form>
            </div>
    	</div>
        <div class="copyright text-center pb-1" style="padding-top:50px;">
            <br>
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> ESCAPER. All right reserved.</p>
        </div>
    </div>
</footer>