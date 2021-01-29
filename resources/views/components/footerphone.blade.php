<footer>
    <div class="container-lg">
        <div class="footer-wrapper">
            <div class="footer-item">
                <div class="footer-link">
                    <a href="/stockist">Stockist</a>
                    <a href="/shipping">Shipping & Return</a>
                </div>
                <form class="newsletter" action="{{route('subscriber.store')}}" method="POST">
                    @csrf
                    <input type="email" class="email-footer" placeholder="ENTER EMAIL">
                    <button type="submit" class="btn-footer">SUBMIT</button>
                </form>
            </div>
            <div class="copyright">
                <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> ESCAPER. All right reserved.</p>
            </div>
        </div>
    </div>
</footer>