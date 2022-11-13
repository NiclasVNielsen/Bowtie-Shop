<?php
    $rootPath = "";
    while(!file_exists($rootPath . "index.php")){
        $rootPath = "../$rootPath";
    }

    require $rootPath . "views/backend/partials/adminStart.php";
    require $rootPath . "models/products.php";
    require $rootPath . "security/adminCheck.php";

    /* 🔥 Needs to check if the user is allowed to be here */
    
    require $rootPath . "security/formSpam.php";
    require $rootPath . "security/stringSanitation.php";

    require $rootPath . "controllers/createProduct.php";
    require $rootPath . "controllers/editProduct.php";
    require $rootPath . "controllers/deleteProduct.php";
    require $rootPath . "controllers/getProductsWithFilters.php";

    require $rootPath . "controllers/adminProducts.php";

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
    if(isset($_POST['page'])){
        $page = $_POST['page'];
    }
?>

<form method="POST" action="adminProducts">
    <input type="text" name="id" placeholder="ID" value="<?php echo ($id != null) ? $id : ""; ?>">
    <input type="text" name="search" placeholder="Search Something!" value="<?php echo ($search != null) ? $search : ""; ?>">
    <select name="type" id="type">
        <option value="">Nothing</option>
        <!-- Adds types to the search select field -->
        <?php
            foreach($allTypes as $type){
                if($type['type'] == $searchType){
        ?>
            <option selected value="<?php echo $type['type']; ?>"><?php echo $type['type']; ?></option>
        <?php
                } else {
        ?>
            <option value="<?php echo $type['type']; ?>"><?php echo $type['type']; ?></option>
        <?php
                }
            }
        ?>
    </select>
    <input type="submit">
</form>
<a href="/adminProducts">Reset</a>
<a href="/adminCreateProduct">Create new product</a>

<?php
    $pageNr = $page;
    $productsPrPage = 4;
    $pageMinIndex = $pageNr * $productsPrPage;
    $pageMaxIndex = $pageMinIndex + $productsPrPage;
?>

<?php
    /* Previous button */
    if($page > 0){
?>
    <form method="POST" action="adminProducts">
        <input type="hidden" name="id" value="<?php echo ($id != null) ? $id : ""; ?>">
        <input type="hidden" name="search" value="<?php echo ($search != null) ? $search : ""; ?>">
        <input type="hidden" name="type" value="<?php echo ($searchType != null) ? $searchType : ""; ?>">
        <input type="hidden" name="page" value="<?php echo ($page - 1) ?>">
        <input type="submit" value="Prev">
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
    <input type="submit" value="Next">
</form>
<?php
    }
?>

<?php
    for($i = $pageMinIndex; $i < $pageMaxIndex && $i < count($data); $i++){
        $indData = $data[$i];
?>
        <div>
            <p><?php echo $indData['name'] ?></p>
            <p><?php echo $indData['type'] ?></p>
            <!-- Adds colors -->
            <?php 
                foreach($allColors as $color){
                    if($indData['products_id'] == $color['product_id']){
            ?>
                <p><?php echo $color['color'] ?></p>
            <?php
                    }
                }
            ?>
            <p><?php echo $indData['description'] ?></p>
            <p><?php echo $indData['price'] ?> DKK</p>
            
            <form method="POST" action="adminEditProduct">
                <input type="hidden" name="id" value="<?php echo $indData['products_id'] ?>">
                <input type="hidden" name="name" value="<?php echo $indData['name'] ?>">
                <input type="hidden" name="description" value="<?php echo $indData['description'] ?>">
                <input type="hidden" name="price" value="<?php echo $indData['price'] ?>">
                <input type="submit" value="Edit">
            </form>

            <form method="POST" action="adminProducts">
                <input type="hidden" name="delete" value="<?php echo $indData['products_id'] ?>">
                <input type="submit" value="Delete">
            </form>
        </div>
<?php
    }
?>

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
        <input type="submit" value="Prev">
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
    <input type="submit" value="Next">
</form>
<?php
    }
?>

<?php 
    require $rootPath . "views/backend/partials/adminEnd.php";
?>
