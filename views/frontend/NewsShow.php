<?php
    $rootPath = "";
    while(!file_exists($rootPath . "index.php")){
        $rootPath = "../$rootPath";
    }
    
    $pageName = "News";
    $pageLink = "/NewsShow";
    $pageLevel = 2;

    require_once $rootPath . "views/frontend/partials/header.php";
    require_once $rootPath . "views/frontend/Breadcrumb.php";
    
    require_once $rootPath . "models/handlers/newsHandler.php"; 
    require_once $rootPath . "controllers/frontendNews.php"; 
?>

<div class="empty-space col-xs-b35 col-md-b70"></div>
<div class="empty-space col-xs-b35 col-md-b70"></div>
<div class="empty-space col-xs-b35 col-md-b70"></div>


<div class="row ProductShow-container">
    <div class="col-sm-6 col-xs-b30 col-sm-b0">

<!-- impelementing the sitemap with a for loop (breadcrumb) -->
<div class="breadcrumbs SiteMap">
    <?php 
    for($i = 0; $i < count($_SESSION['breadcrumbs']); $i++){
        $link = $_SESSION['breadcrumbsLinks'][$i];
        echo "<a class='breadcrumb-flex' href='$link'> ".$_SESSION['breadcrumbs'][$i]."</a>";
    }
    ?>
</div>

<!-- Gets the right image from the chosen product and implement it in the frontEnd with a foreach loop -->

        <?php 
            /* Loop through the News */
            foreach($news as $new){
        ?>


            <div class="news-image-div">
                <?php 
                    $image = explode(".", $new['media']);
                ?>
                <img src="uploads/<?php echo $image[0] ?>.<?php echo $image[1] ?>" alt="">
            </div>


            <div class="valign-middle-cell">
                    <div class="valign-middle-content flex-center">
                        
                        <!--  News title loaded from database  -->
                        <h3 class="h3 light"><?php echo $new['title'] ?></h3>
                        <div class="title-underline light center"><span></span></div>

                        <!--  News image loaded from database  -->
                        <div class="news-image-div">
                            <?php 
                                $image = explode(".", $new['media']);
                            ?>
                            <img src="uploads/<?php echo $image[0] ?>.<?php echo $image[1] ?>" alt="">
                        </div>

                        <!--  News description loaded from database  -->
                        <div class="simple-article size-4 light transparent col-xs-b30"><?php echo $new['description'] ?></div>
                        
                        <a class="button size-2 style-2" href="/NewsShow">
                            <span class="button-wrapper">
                                <span class="icon"><img src="assets/icons/icon-1.png" alt=""></span>
                                <span class="text">learn more</span>
                            </span>
                        </a>

                    </div>
            </div>

         <?php 
            }
         ?>


      </div>
</div>




<div class="empty-space col-xs-b35 col-md-b70"></div>
<div class="empty-space col-xs-b35 col-md-b70"></div>





<?php 
    require_once $rootPath . "views/frontend/partials/footer.php";
?>