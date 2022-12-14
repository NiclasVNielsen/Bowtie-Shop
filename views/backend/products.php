<?php
    $rootPath = "";
    while(!file_exists($rootPath . "index.php")){
        $rootPath = "../$rootPath";
    }
    
    if($_POST == array()){
        $_POST = $_SESSION["savedPost"]['adminProducts'];
    }else{
        $_SESSION["savedPost"]['adminProducts'] = $_POST;
    }

    require_once $rootPath . "public/dbconn.php";

    require_once $rootPath . "models/handlers/ProductsHandler.php";
    require_once $rootPath . "models/handlers/UsersHandler.php";
    require_once $rootPath . "security/adminCheck.php";

    require_once $rootPath . "security/formSpam.php";
    require_once $rootPath . "security/inputSanitation.php";

    //require_once $rootPath . "controllers/createProduct.php";
    require_once $rootPath . "controllers/editProduct.php";
    require_once $rootPath . "controllers/deleteProduct.php";

    require_once $rootPath . "controllers/adminProducts.php";
    require_once $rootPath . "controllers/getProductsWithFilters.php";

    require_once $rootPath . "views/backend/partials/header.php";

    /* This is to make so search data dosent disapear after search */
    $id = null;
    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }
    $search = null;
    if(isset($_POST['search'])){
        $search = $_POST['search'];
    }
    $searchType = null;
    if(isset($_POST['type'])){
        $searchType = $_POST['type'];
    }
    $page = 0;
    if($_SESSION['pageNrName'] != 'products'){
        $_SESSION['pageNr'] = 0;
    }elseif(isset($_POST['page'])){
        if($_SESSION['pageNrName'] == 'products'){
            $page = $_POST['page'];
            $_SESSION['pageNr'] = $page;
        }
    }else{
        if($_SESSION['pageNrName'] == 'products'){
            $page = $_SESSION['pageNr'];
        }
    }
    $_SESSION['pageNrName'] = 'products';
?>
<div class="wrapper">


    <form id="reset" method="POST" action="adminProducts"></form>
    <form id="search" method="POST" action="adminProducts"></form>
    <div class="Admin-handlers">

        <div class="Admin-search-product">
            <input form="search" class="input" type="text" name="id" placeholder="ID" value="<?php echo ($id != null) ? $id : ""; ?>">
            <input form="search" class="input" type="text" name="search" placeholder="Search!" value="<?php echo ($search != null) ? $search : ""; ?>">
                <select form="search" name="type" id="type">
                    <option value="">Nothing</option>
                    <!-- Adds types to the search select field -->
                    <?php
                        foreach($allTypes as $type){
                            if($type['id'] == $searchType){
                    ?>
                        <option selected value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?></option>
                    <?php
                            } else {
                    ?>
                        <option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            <input form="search" class="button submit" type="submit">
        </div>

        <div class="Reset_create_div">
            <input type="hidden" form="reset" value="" name="id">
            <input type="hidden" form="reset" value="" name="search">
            <input type="hidden" form="reset" value="" name="type">
            <button type="submit" class="button" form="reset">Reset</button>
            <a class="button" href="/adminCreateProduct">Create new product</a>
            <a class="button" href="/adminSale">Discounts</a>
        </div>
    </div>

  



        <?php
            $pageNr = $page;
            $productsPrPage = 12;
            $pageMinIndex = $pageNr * $productsPrPage;
            $pageMaxIndex = $pageMinIndex + $productsPrPage;
        ?>

        <!-- ?????? Should keep you on the same page when deleting or editing a product -->



        <div class="Admin-page-title">
              <h1>Products</h1>
        </div>

<div class="wrapper-main-area">

       
        <?php
            /* Previous button */
            if($page > 0){
        ?>
                <form method="POST" action="adminProducts">
                    <input type="hidden" name="id" value="<?php echo ($id != null) ? $id : ""; ?>">
                    <input type="hidden" name="search" value="<?php echo ($search != null) ? $search : ""; ?>">
                    <input type="hidden" name="type" value="<?php echo ($searchType != null) ? $searchType : ""; ?>">
                    <input type="hidden" name="page" value="<?php echo ($page - 1) ?>">
                    <input class="Prev-button button-pagination" type="submit" value="Prev">
                </form>
        <?php
            }
        ?>

        <?php
            /* Next button */
            if($page < (count($data) / $productsPrPage) - 1){
        ?>
                <form method="POST" action="adminProducts">
                    <input type="hidden" name="id" value="<?php echo ($id != null) ? $id : ""; ?>">
                    <input type="hidden" name="search" value="<?php echo ($search != null) ? $search : ""; ?>">
                    <input type="hidden" name="type" value="<?php echo ($searchType != null) ? $searchType : ""; ?>">
                    <input type="hidden" name="page" value="<?php echo ($page + 1) ?>">
                    <input class="Next-button button-pagination" type="submit" value="Next">
                </form>
        <?php
            }
        ?>

        <div class="products">
                <?php
                    for($i = $pageMinIndex; $i < $pageMaxIndex && $i < count($data); $i++){
                        $indData = $data[$i];
                ?>

                        <div class="product">

                        <div class="product-info">
                            <p><?php echo $indData['name'] ?></p>
                            <p><?php echo $indData['type'] ?></p>
                            <!-- Adds colors -->
                            <?php 
                                foreach($colorAssignments as $color){
                                    if($color['products_id'] == $indData['products_id']){
                            ?>
                                <p><?php echo $color['color'] ?></p>
                            <?php
                                    }
                                }
                            ?>
                            <p><?php echo $indData['description'] ?></p>
                            <p><?php echo $indData['price'] ?> DKK</p>
                            <?php 
                                if(isset($indData['primary_image'])){
                                $image = explode(".", $indData['primary_image']) 
                            ?>
                                <div class="BannerImage">
                                    <img  src="/uploads/thumbs/<?php echo $image[0] . "_thumb." . $image[1] ?>">
                                </div>
                            <?php
                                }
                            ?>
                        </div>

                            <div class="Edit-Delete-div">
                                <form method="POST" action="adminEditProduct">
                                    <input type="hidden" name="id" value="<?php echo $indData['products_id'] ?>">
                                    <input type="hidden" name="name" value="<?php echo $indData['name'] ?>">
                                    <input type="hidden" name="description" value="<?php echo $indData['description'] ?>">
                                    <input type="hidden" name="price" value="<?php echo $indData['price'] ?>">
                                    <input type="hidden" name="primaryImage" value="<?php echo $indData['primary_image'] ?>">
                                    <input class="button-pagination" type="submit" value="Edit">
                                </form>
                                    

                                <form method="POST" action="adminProducts">
                                    <input type="hidden" name="delete" value="<?php echo $indData['products_id'] ?>">
                                    <input class="button-pagination" type="submit" value="Delete">
                                </form>
                            </div>

                        </div>
                <?php
                    }
                ?>
        </div>


            <?php
                echo "<br>";
                /* Previous button */
                if($page > 0){
            ?>

                
                    <form method="POST" action="adminProducts">
                        <input type="hidden" name="id" value="<?php echo ($id != null) ? $id : ""; ?>">
                        <input type="hidden" name="search" value="<?php echo ($search != null) ? $search : ""; ?>">
                        <input type="hidden" name="type" value="<?php echo ($searchType != null) ? $searchType : ""; ?>">
                        <input type="hidden" name="page" value="<?php echo ($page - 1) ?>">
                        <input class="Prev-button-lowest button-pagination" type="submit" value="Prev">
                    </form>

            <?php
                }
            ?>

            <?php
                /* Next button */
                if($page < (count($data) / $productsPrPage) - 1){
            ?>

                
                    <form method="POST" action="adminProducts">
                        <input type="hidden" name="id" value="<?php echo ($id != null) ? $id : ""; ?>">
                        <input type="hidden" name="search" value="<?php echo ($search != null) ? $search : ""; ?>">
                        <input type="hidden" name="type" value="<?php echo ($searchType != null) ? $searchType : ""; ?>">
                        <input type="hidden" name="page" value="<?php echo ($page + 1) ?>">
                        <input class="Next-button-lowest button-pagination" type="submit" value="Next">
                    </form>

            <?php
                }
            ?>

</div>


</div>

<?php 
    require_once $rootPath . "views/backend/partials/footer.php";
?>