<?php
    require_once $rootPath . "models/handlers/FrontpageHandler.php"; 
    require_once $rootPath . "controllers/frontpage.php"; 
?>

<!-- FOOTER -->
<footer>
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-xs-b30 col-md-b0">
                            <h6 class="h6 light"><?php echo $aboutusSubtitle ?></h6>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="simple-article size-2 light fulltransparent margin-15"><?php echo $aboutusSlogan ?></div>
                            <div class="description">
                                    <a href="/AboutUS" class="title">Read more about TheCustomTies</a>
                            </div>
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-xs-b30 col-md-b0">
                            <h6 class="h6 light">quick links</h6>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="footer-column-links">
                                <div class="row">
                                    <div class="col-xs-6 footer-links-flex">
                                        <a href="/">home</a>
                                        <a href="/AboutUS">about us</a>
                                        <a href="/Product">products</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear visible-sm"></div>
                        <div class="col-sm-6 col-md-3 col-xs-b30 col-sm-b0">
                            <h6 class="h6 light">Products</h6>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="footer-post-preview clearfix">
                                <a class="image" href="#"><img src="assets/img/thumbnail-1.jpg" alt="" /></a>
                                <div class="description">
                                    <div class="date">See our product variations</div>
                                    <a href="/Product" class="title">See products</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h6 class="h6 light">Contact us</h6>
                            <div class="empty-space col-xs-b20"></div>
                                <div class="footer-contact"><i class="fa fa-mobile" aria-hidden="true"></i> contact us: <a href="tel:+4553525239"><?php echo $phone ?></a></div>
                                <div class="footer-contact"><i class="fa fa-envelope-o" aria-hidden="true"></i> email: <a href="mailto:thecostumebowtie@gmail.com"><?php echo $email ?></a></div>
                                <div class="footer-contact"><i class="fa fa-map-marker" aria-hidden="true"></i> address: <a href="#"><?php echo $address ?></a></div>
                        </div>
                    </div>
                    <div class="footer-contact-div">
                        
                    </div>
                </div>
            </div>
        </footer>
        <div class="popup-wrapper <?php echo isset($_POST['loginFailed']) ? "active" : ""; ?> <?php echo isset($_POST['signupFailed']) ? "active" : ""; ?>">
        <div class="bg-layer"></div>

        <div class="popup-content <?php echo isset($_POST['loginFailed']) ? "active" : ""; ?>" data-rel="1">
            <div class="layer-close"></div>
            <div class="popup-container size-1">
                <div class="popup-align">
                    
                    <form method="POST" action="/loginFunction">
                        
                        <h3 class="h3 text-center">Log in</h3>
                        <div class="empty-space col-xs-b30"></div>
                        
                        
                        <input class="simple-input" type="text" name="name" value="" placeholder="Username" />
                        
                        
                        <div class="empty-space col-xs-b10 col-sm-b20"></div>
                        
                        
                        <input class="simple-input" type="password" name="password" value="" placeholder="Enter password" />
                        
                        <?php if(isset($_POST['loginFailed'])){ ?>
                            <h3 style="font-size: 20px; margin-top: 10px; text-align:center; color: red;">
                                You typed something wrong!
                            </h3>
                        <?php } ?>

                        <div class="empty-space col-xs-b10 col-sm-b20"></div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-b10 col-sm-b0">
                                <!-- <div class="empty-space col-sm-b5"></div>
                                <a class="simple-link">Forgot password?</a>
                                <div class="empty-space col-xs-b5"></div>
                                <a class="simple-link">register now</a> -->
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="button size-2 style-3" href="#">
                                    <span class="button-wrapper">
                                        <span class="icon"><img src="assets/img/icon-4.png" alt="" /></span>
                                        <span class="text">submit</span>
                                    </span>
                                </button>  
                            </div>
                        </div>
                    </form>
                </div>
                <div class="button-close"></div>
            </div>
        </div>

        
        <div class="popup-content <?php echo isset($_POST['signupFailed']) ? "active" : ""; ?>" data-rel="2">
            <div class="layer-close"></div>
            <div class="popup-container size-1">
                <div class="popup-align">
                    
                    <form method="POST" action="/signupFunction">

                        <h3 class="h3 text-center">register</h3>
                        <div class="empty-space col-xs-b30"></div>
                        <input class="simple-input" type="text" name="name" value="" placeholder="Enter username" />
                        <div class="empty-space col-xs-b10 col-sm-b20"></div>

                        <input class="simple-input" type="password" name="password" value="" placeholder="Enter password" />
                        <div class="empty-space col-xs-b10 col-sm-b20"></div>

                        <input class="simple-input" type="password" name="passwordCheck" value="" placeholder="Repeat password" />
                        <div class="empty-space col-xs-b10 col-sm-b20"></div>
                        
                        <?php if(isset($_POST['signupFailedNameTaken'])){ ?>
                            <h3 style="font-size: 20px; margin-top: 10px; text-align:center; color: red;">
                                Name is taken!
                            </h3>
                        <?php }elseif(isset($_POST['signupFailed'])){ ?>
                            <h3 style="font-size: 20px; margin-top: 10px; text-align:center; color: red;">
                                You typed something wrong!
                            </h3>
                        <?php } ?>

                        <div class="row">
                            <div class="col-sm-7 col-xs-b10 col-sm-b0">
                                <div class="empty-space col-sm-b15"></div>
                                <label class="checkbox-entry">
                                    <input type="checkbox" name="privacyCheck" value="true" required/><span><a href="#">Privacy policy agreement</a></span>
                                </label>
                            </div>
                            <div class="col-sm-5 text-right">
                                <button class="button size-2 style-3" href="#">
                                    <span class="button-wrapper">
                                        <span class="icon"><img src="assets/img/icon-4.png" alt="" /></span>
                                        <span class="text">submit</span>
                                    </span>
                                </button>  
                            </div>
                        </div>
                    </form>
                </div>
                <div class="button-close"></div>
            </div>
        </div>

        <div class="popup-content" data-rel="3">
            <div class="layer-close"></div>
            <div class="popup-container size-2">
                <div class="popup-align">
                        <div class="row">
                            <div class="col-sm-6 col-xs-b30 col-sm-b0">
                                
                                <div class="main-product-slider-wrapper swipers-couple-wrapper">
                                    <div class="swiper-container swiper-control-top">
                                    <div class="swiper-button-prev hidden"></div>
                                    <div class="swiper-button-next hidden"></div>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                                <div class="swiper-lazy-preloader"></div>
                                                <div class="product-big-preview-entry swiper-lazy" data-background="img/product-preview-4.jpg"></div>
                                        </div>
                                        <div class="swiper-slide">
                                                <div class="swiper-lazy-preloader"></div>
                                                <div class="product-big-preview-entry swiper-lazy" data-background="img/product-preview-5.jpg"></div>
                                        </div>
                                        <div class="swiper-slide">
                                                <div class="swiper-lazy-preloader"></div>
                                                <div class="product-big-preview-entry swiper-lazy" data-background="img/product-preview-6.jpg"></div>
                                        </div>
                                        <div class="swiper-slide">
                                                <div class="swiper-lazy-preloader"></div>
                                                <div class="product-big-preview-entry swiper-lazy" data-background="img/product-preview-7.jpg"></div>
                                        </div>
                                        <div class="swiper-slide">
                                                <div class="swiper-lazy-preloader"></div>
                                                <div class="product-big-preview-entry swiper-lazy" data-background="img/product-preview-8.jpg"></div>
                                        </div>
                                        <div class="swiper-slide">
                                                <div class="swiper-lazy-preloader"></div>
                                                <div class="product-big-preview-entry swiper-lazy" data-background="img/product-preview-9.jpg"></div>
                                        </div>
                                        <div class="swiper-slide">
                                                <div class="swiper-lazy-preloader"></div>
                                                <div class="product-big-preview-entry swiper-lazy" data-background="img/product-preview-10.jpg"></div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="empty-space col-xs-b30 col-sm-b60"></div>

                                    <div class="swiper-container swiper-control-bottom" data-breakpoints="1" data-xs-slides="3" data-sm-slides="3" data-md-slides="4" data-lt-slides="5" data-slides-per-view="5" data-center="1" data-click="1">
                                    <div class="swiper-button-prev hidden"></div>
                                    <div class="swiper-button-next hidden"></div>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                                <div class="product-small-preview-entry">
                                                    <img src="img/product-preview-4_.jpg" alt="" />
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="product-small-preview-entry">
                                                    <img src="img/product-preview-5_.jpg" alt="" />
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="product-small-preview-entry">
                                                    <img src="img/product-preview-6_.jpg" alt="" />
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="product-small-preview-entry">
                                                    <img src="img/product-preview-7_.jpg" alt="" />
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="product-small-preview-entry">
                                                    <img src="img/product-preview-8_.jpg" alt="" />
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="product-small-preview-entry">
                                                    <img src="img/product-preview-9_.jpg" alt="" />
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="product-small-preview-entry">
                                                    <img src="img/product-preview-10_.jpg" alt="" />
                                                </div>
                                        </div>

                                    </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="simple-article size-3 grey col-xs-b5">SMART WATCHES</div>
                                <div class="h3 col-xs-b25">watch 42mm smartwatch</div>
                                <div class="row col-xs-b25">
                                    <div class="col-sm-6">
                                        <div class="simple-article size-5 grey">PRICE: <span class="color">$225.00</span></div>        
                                    </div>
                                    <div class="col-sm-6 col-sm-text-right">
                                        <div class="rate-wrapper align-inline">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="simple-article size-2 align-inline">128 Reviews</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="simple-article size-3 col-xs-b5">ITEM NO.: <span class="grey">127-#5238</span></div>
                                    </div>
                                    <div class="col-sm-6 col-sm-text-right">
                                        <div class="simple-article size-3 col-xs-b20">AVAILABLE.: <span class="grey">YES</span></div>
                                    </div>
                                </div>
                                <div class="simple-article size-3 col-xs-b30">Vivamus in tempor eros. Phasellus rhoncus in nunc sit amet mattis. Integer in ipsum vestibulum, molestie arcu ac, efficitur tellus. Phasellus id vulputate erat.</div>
                                <div class="row col-xs-b40">
                                    <div class="col-sm-3">
                                        <div class="h6 detail-data-title size-1">size:</div>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="SlectBox">
                                            <option disabled="disabled" selected="selected">Choose size</option>
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row col-xs-b40">
                                    <div class="col-sm-3">
                                        <div class="h6 detail-data-title">color:</div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="color-selection size-1">
                                            <div class="entry active" style="color: #a7f050;"></div>
                                            <div class="entry" style="color: #50e3f0;"></div>
                                            <div class="entry" style="color: #eee;"></div>
                                            <div class="entry" style="color: #4d900c;"></div>
                                            <div class="entry" style="color: #edb82c;"></div>
                                            <div class="entry" style="color: #7d3f99;"></div>
                                            <div class="entry" style="color: #3481c7;"></div>
                                            <div class="entry" style="color: #bf584b;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-xs-b40">
                                    <div class="col-sm-3">
                                        <div class="h6 detail-data-title size-1">quantity:</div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="quantity-select">
                                            <span class="minus"></span>
                                            <span class="number">1</span>
                                            <span class="plus"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m5 col-xs-b40">
                                    <div class="col-sm-6 col-xs-b10 col-sm-b0">
                                        <a class="button size-2 style-2 block" href="#">
                                            <span class="button-wrapper">
                                                <span class="icon"><img src="img/icon-2.png" alt=""></span>
                                                <span class="text">add to cart</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a class="button size-2 style-1 block noshadow" href="#">
                                        <span class="button-wrapper">
                                            <span class="icon"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                            <span class="text">add to favourites</span>
                                        </span>
                                    </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="h6 detail-data-title size-2">share:</div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="follow light">
                                            <a class="entry" href="#"><i class="fa fa-facebook"></i></a>
                                            <a class="entry" href="#"><i class="fa fa-twitter"></i></a>
                                            <a class="entry" href="#"><i class="fa fa-linkedin"></i></a>
                                            <a class="entry" href="#"><i class="fa fa-google-plus"></i></a>
                                            <a class="entry" href="#"><i class="fa fa-pinterest-p"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="button-close"></div>
            </div>
        </div>

</div>



    <script src="<?php echo BASE_URL ?>/views/frontend/partials/js/jquery-2.2.4.min.js"></script>
    <script src="<?php echo BASE_URL ?>/views/frontend/partials/js/swiper.jquery.min.js"></script>
    <script src="<?php echo BASE_URL ?>/views/frontend/partials/js/global.js"></script>

    <!-- styled select -->
    <script src="<?php echo BASE_URL ?>/views/frontend/partials/js/jquery.sumoselect.min.js"></script>

    <!-- counter -->
    <script src="<?php echo BASE_URL ?>/views/frontend/partials/js/jquery.classycountdown.js"></script>
    <script src="<?php echo BASE_URL ?>/views/frontend/partials/js/jquery.knob.js"></script>
    <script src="<?php echo BASE_URL ?>/views/frontend/partials/js/jquery.throttle.js"></script>


</body>
</html>