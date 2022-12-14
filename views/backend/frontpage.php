<?php
    $rootPath = "";
    while(!file_exists($rootPath . "index.php")){
        $rootPath = "../$rootPath";
    }
    if($_POST == array()){
        $_POST = $_SESSION["savedPost"]['adminFrontpage'];
    }else{
        $_SESSION["savedPost"]['adminFrontpage'] = $_POST;
    }
    require_once $rootPath . "public/dbconn.php";

    require_once $rootPath . "models/handlers/UsersHandler.php";
    require_once $rootPath . "models/handlers/FrontpageHandler.php";
    require_once $rootPath . "models/handlers/ProductsHandler.php";

    require_once $rootPath . "security/adminCheck.php";

    require_once $rootPath . "security/formSpam.php";
    require_once $rootPath . "security/inputSanitation.php";
    
    require_once $rootPath . "controllers/adminFrontpage.php";
    //require_once $rootPath . "controllers/editFrontpage.php";

    require_once $rootPath . "views/backend/partials/header.php";
?>
<form class="wrapper frontpage" method="POST" action="/adminEditFrontpageFunction">
    <input type="hidden" name="editFrontpage" value="true">

    <h2>
        Header
    </h2>

    <div > <!--  <- Navigation  -->
        <h3>
            Navigation
        </h3>
        <input class="input" type="text" name="navHome" value="<?php echo $nav1 ?>">
        <input class="input" type="text" name="navProducts" value="<?php echo $nav2 ?>">
        <input class="input" type="text" name="navAboutUs" value="<?php echo $nav3 ?>">
        <input class="input" type="text" name="navContact" value="<?php echo $nav4 ?>">
        <button class="height-button button submit" type="submit">Submit/Edit</button>
    </div>


    <hr class="solid">

    
    <h2>
        Frontpage
    </h2>
<!-- Banner1 section  -->
    <h2>
        Banner 1
    </h2>

    <div > <!--  <- Banner Sub title  -->
        <h3>
            Sub title
        </h3>
        <input class="input" type="text" name="bannerSubtitle1" value="<?php echo $bannerSubtitle1 ?>">
    </div>

    <div > <!--  <- Banner Title  -->
        <h3>
            Title
        </h3>
        <input class="input" type="text" name="bannerTitle1" value="<?php echo $bannerTitle1 ?>">
    </div>

    <div > <!--  <- Banner Slogan1  -->
        <h3>
            Banner Slogan - 1
        </h3>
        <input class="input" type="text" name="banner1Slogan1" value="<?php echo $banner1Slogan1 ?>">
    </div>

    <div > <!--  <- Banner Slogan2  -->
        <h3>
            Banner Slogan - 2
        </h3>
        <input class="input" type="text" name="banner1Slogan2" value="<?php echo $banner1Slogan2 ?>">
    </div>

    <div > <!--  <- Banner Slogan3  -->
        <h3>
            Banner Slogan - 3
        </h3>
        <input class="input" type="text" name="banner1Slogan3" value="<?php echo $banner1Slogan3 ?>">
    </div>

    <div > <!--  <- Banner section 1  -->
        <h3>
            Banner Tekst
        </h3>
        <div class="BannerDiv">
            <textarea name="bannerText1" id="" cols="60" rows="10"><?php echo $bannerText1 ?></textarea>
            <button class="height-button button submit" type="submit">Submit/Edit</button>
        </div>
    </div>

    <div>
        <h3>
                Banner / Image 1
        </h3>
        <div class="ImageUploadHandlersStyle">
            <div class="BannerImage">
                <img  src="uploads/<?php echo $bannerImageOne?>" alt="" />
            </div>
            <a class="ChooseImageButton height-button button submit" href="/bannerOneImagePicker">Choose Image</a>
        </div>
    </div>
<!-- Banner1 section  -->

    
    <hr class="solid">


<!-- Banner2 section  -->
    <h2>
        Banner 2
    </h2>

    <div > <!--  <- Banner Sub title  -->
        <h3>
            Sub title
        </h3>
        <input class="input" type="text" name="bannerSubtitle2" value="<?php echo $bannerSubtitle2 ?>">
    </div>

    <div > <!--  <- Banner Title  -->
        <h3>
            Title
        </h3>
        <input class="input" type="text" name="bannerTitle2" value="<?php echo $bannerTitle2 ?>">
    </div>

    <div > <!--  <- Banner Slogan1  -->
        <h3>
            Banner Slogan 1
        </h3>
        <input class="input" type="text" name="banner2Slogan1" value="<?php echo $banner2Slogan1 ?>">
    </div>

    <div > <!--  <- Banner Slogan2  -->
        <h3>
            Banner Slogan - 2
        </h3>
        <input class="input" type="text" name="banner2Slogan2" value="<?php echo $banner2Slogan2 ?>">
    </div>

    <div > <!--  <- Banner Slogan3  -->
        <h3>
            Banner Slogan - 3
        </h3>
        <input class="input" type="text" name="banner2Slogan3" value="<?php echo $banner2Slogan3 ?>">
    </div>

    <div > <!--  <- Banner section 1  -->
        <h3>
            Banner Tekst
        </h3>
        <div class="BannerDiv">
            <textarea name="banner2Text1" id="" cols="60" rows="10"><?php echo $banner2Text1 ?></textarea>
            <button class="height-button button submit" type="submit">Submit/Edit</button>
        </div>
    </div>

    <div>
        <h3>
                Banner / Image 2
        </h3>
        <div class="ImageUploadHandlersStyle">
            <div class="BannerImage">
                <img  src="uploads/<?php echo $bannerImageTwo?>" alt="" />
            </div>
            <a class="ChooseImageButton height-button button submit" href="/bannerTwoImagePicker">Choose Image</a>
        </div>
    </div>
<!-- Banner2 section  -->


<hr class="solid">

    <h2>
        Products
    </h2>
    <div > <!--  <- Sub title  -->
        <h3>
            Sub title
        </h3>
        <input class="input" type="text" name="productsSubtitle" value="<?php echo $productsSubtitle ?>">
    </div>
    <div > <!--  <- Title  -->
        <h3>
            Title
        </h3>
        <div class="BannerDiv">
            <input class="input" type="text" name="productsTitle" value="<?php echo $productsTitle ?>">
            <button class="height-button button submit" type="submit">Submit/Edit</button>
        </div>
    </div>
    <!-- Categories  - Product types! -->



    <hr class="solid">



    <h2>
        About us
    </h2>

<!-- AboutUSpage section  -->
    <div>
        <h3>
                About us / Image 1
        </h3>
        <div class="ImageUploadHandlersStyle">
            <div class="BannerImage">
                <img  src="uploads/<?php echo $aboutUsImageOne?>" alt="" />
            </div>
            <a class="ChooseImageButton height-button button submit" href="/aboutUsOneImagePicker">Choose Image</a>
        </div>
    </div>
    <div> 
        <h3>
            About us Page - title 1 
        </h3>
        <input class="input" type="text" name="aboutPageTitle1" value="<?php echo $aboutPageTitle1 ?>">
    </div>

    <div > 
        <h3>
            About us Page - text 1 
        </h3>
        <p>This is the same one as on the frontpage</p>
        <div class="BannerDiv">
            <textarea name="aboutPageText1" id="" cols="60" rows="10"><?php echo $aboutPageText1 ?></textarea>
            <button class="height-button button submit" type="submit">Submit/Edit</button>
        </div>
    </div>

    <div>
        <h3>
                About us / Image 2
        </h3>
        <div class="ImageUploadHandlersStyle">
            <div class="BannerImage">
                <img  src="uploads/<?php echo $aboutUsImageTwo?>" alt="" />
            </div>
            <a class="ChooseImageButton height-button button submit" href="/aboutUsTwoImagePicker">Choose Image</a>
        </div>
    </div>

    <div > 
        <h3>
            About us Page - title 2 
        </h3>
        <input class="input" type="text" name="aboutPageTitle2" value="<?php echo $aboutPageTitle2 ?>">
    </div>

    <div > 
        <h3>
            About us Page - text 2  
        </h3>
        <p>This is the same one as on the frontpage</p>
        <div class="BannerDiv">
            <textarea name="aboutPageText2" id="" cols="60" rows="10"><?php echo $aboutPageText2 ?></textarea>
            <button class="height-button button submit" type="submit">Submit/Edit</button>
        </div>
    </div>

    <div>
        <h3>
                About us / Image 2
        </h3>
        <div class="ImageUploadHandlersStyle">
            <div class="BannerImage">
                <img  src="uploads/<?php echo $aboutUsImageThree?>" alt="" />
            </div>
            <a class="ChooseImageButton height-button button submit" href="/aboutUsThreeImagePicker">Choose Image</a>
        </div>
    </div>

    <div > 
        <h3>
            About us Page - title 3 
        </h3>
        <input class="input" type="text" name="aboutPageTitle3" value="<?php echo $aboutPageTitle3 ?>">
    </div>

    <div > 
        <h3>
            About us Page - text 3 
        </h3>
        <p>This is the same one as on the frontpage</p>
        <div class="BannerDiv">
            <textarea name="aboutPageText3" id="" cols="60" rows="10"><?php echo $aboutPageText3 ?></textarea>
            <button class="height-button button submit" type="submit">Submit/Edit</button>
        </div>
    </div>

<!-- AboutUSpage section  -->

    <div > 
        <h3>
            Sub title
        </h3>
        <input class="input" type="text" name="aboutusSubtitle" value="<?php echo $aboutusSubtitle ?>">
    </div>

    <div > <!--  <- Title  -->
        <h3>
            Title
        </h3>
        <input class="input" type="text" name="aboutusTitle" value="<?php echo $aboutusTitle ?>">
    </div>

    <div > <!--  <- Slogan  -->
        <h3>
           Slogan
        </h3>
        <input class="input" type="text" name="aboutusSlogan" value="<?php echo $aboutusSlogan ?>">
    </div>
    <!-- Descriptions -->
    <!-- ^ should have create and delete -->

    <div > <!--  <- About us  -->
        <h3>
            About us / part-1
        </h3>
        <p>This is the same one as on the frontpage</p>
        <div class="BannerDiv">
            <textarea name="aboutUs1" id="" cols="60" rows="10"><?php echo $aboutUs1 ?></textarea>
            <button class="height-button button submit" type="submit">Submit/Edit</button>
        </div>
    </div>

    <div > <!--  <- About us  -->
        <h3>
            About us / part-2
        </h3>
        <p>This is the same one as on the frontpage</p>
        <div class="BannerDiv">
            <textarea name="aboutUs2" id="" cols="60" rows="10"><?php echo $aboutUs2 ?></textarea>
            <button class="height-button button submit" type="submit">Submit/Edit</button>
        </div>
    </div>



    <hr class="solid">



    <h2>
        Contact
    </h2>
    <div > <!--  <- Sub title  -->
        <h3>
            Sub title
        </h3>
        <input class="input" type="text" name="contactSubtitle" value="<?php echo $contactSubtitle ?>">
    </div>
    <div > <!--  <- Title  -->
        <h3>
            Title
        </h3>
        <input class="input" type="text" name="contactTitle" value="<?php echo $contactTitle ?>">
    </div>
    <div > <!--  <- Contact forms  -->
        <h3>
            Contact forms
        </h3>
        <input class="input" type="text" name="address" placeholder="Address" value="<?php echo $address ?>">
        <input class="input" type="text" name="phone" placeholder="Phone" value="<?php echo $phone ?>">
        <input class="input" type="text" name="email" placeholder="Email" value="<?php echo $email ?>">
        <input class="input" type="text" name="follow" placeholder="Follow us" value="<?php echo $follow ?>">
        <button class="height-button button submit" type="submit">Submit/Edit</button>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    <!-- FOOTER -->
    
</form>

<?php 
    require_once $rootPath . "views/backend/partials/footer.php";
?>
