<?php
    $rootPath = "";
    while(!file_exists($rootPath . "index.php")){
        $rootPath = "../$rootPath";
    }
    
    $pageName = "Contact Us";
    $pageLink = "/Contact";
    $pageLevel = 2;

    require_once $rootPath . "views/frontend/partials/header.php";
    require_once $rootPath . "views/frontend/Breadcrumb.php";

    require_once $rootPath . "models/handlers/FrontpageHandler.php"; 
    require_once $rootPath . "controllers/frontpage.php"; 
?>

<div class="empty-space col-xs-b35 col-md-b70"></div>
<div class="empty-space col-xs-b35 col-md-b70"></div>
<div class="empty-space col-xs-b35 col-md-b70"></div>

<!-- impelementing the sitemap with a for loop (breadcrumb) -->
<div class="breadcrumbs SiteMap">
    <?php 
    for($i = 0; $i < count($_SESSION['breadcrumbs']); $i++){
        $link = $_SESSION['breadcrumbsLinks'][$i];
        echo "<a class='breadcrumb-flex' href='$link'> ".$_SESSION['breadcrumbs'][$i]."</a>";
    }
    ?>
</div>

<div class="container">
    <div class="text-center">
        <div class="simple-article size-3 grey uppercase col-xs-b5"><?php echo $contactSubtitle ?></div>
        <div class="h2"><?php echo $contactTitle ?></div>
        <div class="title-underline center"><span></span></div>
    </div>
</div>

<div class="empty-space col-sm-b15 col-md-b50"></div>

<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="icon-description-shortcode style-1">
                <img class="icon" src="assets/icons/icon-25.png" alt="">
                <div class="title h6">address</div>
                <div class="description simple-article size-2"><?php echo $address ?></div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="icon-description-shortcode style-1">
                <img class="icon" src="assets/icons/icon-23.png" alt="">
                <div class="title h6">phone</div>
                <div class="description simple-article size-2" style="line-height: 26px;">
                    <a href="tel:+4553525239"><?php echo $phone ?></a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="icon-description-shortcode style-1">
                <img class="icon" src="assets/icons/icon-28.png" alt="">
                <div class="title h6">email</div>
                <div class="description simple-article size-2"><a
                        href="mailto:thecostumebowtie@gmail.com"><?php echo $email ?></a></div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="icon-description-shortcode style-1">
                <img class="icon" src="assets/icons/icon-26.png" alt="">
                <div class="title h6">Follow us</div>
                <div class="description simple-article size-2" style="line-height: 26px;">
                      <?php echo $follow ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="empty-space col-xs-b25 col-sm-b50"></div>
<div class="empty-space col-xs-b25 col-sm-b50"></div>

<?php
if (isset($_SESSION['name'])) {
?>
<div class="container">
    <h4 class="h4 text-center col-xs-b25">have a questions?</h4>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form class="contact-form" method="POST" action="contactSubmit">
                <input type="hidden" value="true" name="validate" />
                <div class="row m5">
                    <div class="col-sm-6">
                        <input class="simple-input col-xs-b20" type="text" value="" placeholder="Name" name="name" />
                    </div>
                    <div class="col-sm-6">
                        <input class="simple-input col-xs-b20" type="text" value="" placeholder="Email" name="email" />
                    </div>
                    <div class="col-sm-6">
                        <input class="simple-input col-xs-b20" type="text" value="" placeholder="Phone" name="phone" />
                    </div>
                    <div class="col-sm-6">
                        <input class="simple-input col-xs-b20" type="text" value="" placeholder="Subject"
                            name="subject" />
                    </div>
                    <div class="col-sm-12">
                        <textarea class="simple-input col-xs-b20" placeholder="Your message" name="message"></textarea>
                    </div>
                    <div class="col-sm-12">
                        <div class="text-center">
                            <div class="button size-2 style-3">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="assets/img/icon-4.png" alt=""></span>
                                    <span class="text">send message</span>
                                </span>
                                <input type="submit" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    } else {
?>
<div class="container">
    <h4 class="h4 text-center col-xs-b25">have a questions?</h4>
    <p class="text-center">Login and send us a message</p>
</div>
<?php
    }
?>

<div class="empty-space col-xs-b35 col-md-b70"></div>
<div class="empty-space col-xs-b35 col-md-b70"></div>





<?php 
    require_once $rootPath . "views/frontend/partials/footer.php";
?>