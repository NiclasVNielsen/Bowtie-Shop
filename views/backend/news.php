<?php
    $rootPath = "";
    while(!file_exists($rootPath . "index.php")){
        $rootPath = "../$rootPath";
    }

    if($_POST == array()){
        $_POST = $_SESSION["savedPost"]['adminNews'];
    }else{
        $_SESSION["savedPost"]['adminNews'] = $_POST;
    }

    require_once $rootPath . "public/dbconn.php";

    require_once $rootPath . "models/handlers/UsersHandler.php";
    require_once $rootPath . "security/adminCheck.php";

    require_once $rootPath . "models/handlers/NewsHandler.php";
    
    require_once $rootPath . "security/formSpam.php";
    require_once $rootPath . "security/inputSanitation.php";

    //require_once $rootPath . "controllers/createNews.php";
    require_once $rootPath . "controllers/editNews.php";
    require_once $rootPath . "controllers/deleteNews.php";

    require_once $rootPath . "controllers/getNewsWithFilters.php";

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
    if($_SESSION['pageNrName'] != 'news'){
        $_SESSION['pageNr'] = 0;
    }elseif(isset($_POST['page'])){
        if($_SESSION['pageNrName'] == 'news'){
            $page = $_POST['page'];
            $_SESSION['pageNr'] = $page;
        }
    }else{
        if($_SESSION['pageNrName'] == 'news'){
            $page = $_SESSION['pageNr'];
        }
    }
    $_SESSION['pageNrName'] = 'news';
?>
<div class="wrapper">

    <form id="reset" method="POST" action="/adminNews"></form>
    <form id="search" method="POST" action="/adminNews"></form>
    <div class="Admin-product-handlers">
        <div class="Admin-search-product">
            <input form="search" class="input" type="text" name="search" placeholder="Search!" value="<?php echo ($search != null) ? $search : ""; ?>">
            <input form="search" class="button submit" type="submit">
        </div>

        <div class="Reset_create_div">
            <input form="reset" type="hidden" name="search" value="">
            <button form="reset" class="button" href="/adminNews">Reset</button>
            <a class="button" href="/adminCreateNews">Create news</a>
        </div>
    </div>
    
    <?php
        $pageNr = $page;
        $productsPrPage = 12;
        $pageMinIndex = $pageNr * $productsPrPage;
        $pageMaxIndex = $pageMinIndex + $productsPrPage;
    ?>

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
                        <p><?php echo $indData['title'] ?></p>
                    </div>

                    <div class="Edit-Delete-div">
                        <form method="POST" action="adminEditNews">
                            <input type="hidden" name="id" value="<?php echo $indData['news_id'] ?>">
                            <input type="hidden" name="title" value="<?php echo $indData['title'] ?>">
                            <input type="hidden" name="description" value="<?php echo $indData['description'] ?>">
                            <input type="hidden" name="media" value="<?php echo $indData['media'] ?>">
                            <input class="button-pagination" type="submit" value="Edit">
                        </form>
                            

                        <form method="POST" action="adminNews">
                            <input type="hidden" name="delete" value="<?php echo $indData['news_id'] ?>">
                            <input class="button-pagination" type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>

        <?php
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