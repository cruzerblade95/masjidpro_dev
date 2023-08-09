<footer id="footer" class="site-footer">
    <div class="footer-menu">
        <div class="container">
            <div class="row" style="display: none">
                <div class="col-lg-3 col-sm-4 col-4">
                    <div class="footer-menu-item">
                        <h3>Our company</h3>
                        <ul>
                            <li><a href="#">What is Startup Idea</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">How It Works</a></li>
                            <li><a href="#">What Is This</a></li>
                            <li><a href="#">Jobs</a></li>
                            <li><a href="#">Press</a></li>
                            <li><a href="#">Starts</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-4 col-4">
                    <div class="footer-menu-item">
                        <h3>Campaign</h3>
                        <ul>
                            <li><a href="#">Start Your Campaign</a></li>
                            <li><a href="#">Pricing Campaign</a></li>
                            <li><a href="#">Campaign Support</a></li>
                            <li><a href="#">Trust &amp; Safety</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-4 col-4">
                    <div class="footer-menu-item">
                        <h3>Explore</h3>
                        <ul>
                            <li><a href="#">Design &amp; Art</a></li>
                            <li><a href="#">Crafts</a></li>
                            <li><a href="#">Film &amp; Video</a></li>
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Book</a></li>
                            <li><a href="#">Games</a></li>
                            <li><a href="#">Technology</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 col-12">
                    <div class="footer-menu-item newsletter">
                        <h3>Newsletter</h3>
                        <div class="newsletter-description">Private, secure, spam-free</div>
                        <form action="s" method="POST" id="newsletterForm">
                            <input type="text" value="" name="s" placeholder="Enter your email..." />
                            <button type="submit" value=""><span class="ion-android-drafts"></span></button>
                        </form>
                        <div class="follow">
                            <h3>Follow us</h3>
                            <ul>
                                <li class="facebook"><a target="_Blank" href="https://www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li class="twitter"><a target="_Blank" href="https://www.twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="instagram"><a target="_Blank" href="https://www.instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li class="google"><a target="_Blank" href="https://www.google.com"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li class="youtube"><a target="_Blank" href="https://www.youtube.com"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-top">
                <p class="payment-img"><img class="img-fluid wow fadeInUp" src="images/assets/payment-methods3.png" alt="" data-wow-delay=".2s"></p>
                <div class="footer-top-right">&nbsp;</div>
            </div>
        </div>
    </div><!-- .footer-menu -->
    <div class="footer-copyright">
        <div class="container">
            <p class="copyright">MasjidPro 2020, Hakcipta Terpelihara.</p>
            <a href="#" class="back-top">Kembali ke tajuk<span class="ion-android-arrow-up"></span></a>
        </div>
    </div>
</footer><!-- site-footer -->
</div><!-- #wrapper -->
<script src="js/jquery-1.12.4.min.js"></script>
<script src="libs/popper/popper.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
<script src="libs/owl-carousel/owl.carousel.min.js"></script>
<script src="libs/jquery.countdown/jquery.countdown.min.js"></script>
<script src="libs/wow/wow.min.js"></script>
<script src="libs/isotope/isotope.pkgd.min.js"></script>
<script src="libs/bxslider/jquery.bxslider.min.js"></script>
<script src="libs/magicsuggest/magicsuggest-min.js"></script>
<script src="libs/quilljs/js/quill.core.js"></script>
<script src="libs/quilljs/js/quill.js"></script>
<script src="js/main.js"></script>
<script>
    function validate(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
</body>
</html>