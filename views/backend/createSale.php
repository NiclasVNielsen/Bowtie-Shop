<?php
    $rootPath = "";
    while(!file_exists($rootPath . "index.php")){
        $rootPath = "../$rootPath";
    }
    require_once $rootPath . "public/dbconn.php";

    require_once $rootPath . "models/handlers/ProductsHandler.php";
    require_once $rootPath . "models/handlers/UsersHandler.php";
    require_once $rootPath . "security/adminCheck.php";

    require_once $rootPath . "security/formSpam.php";
    require_once $rootPath . "security/inputSanitation.php";

    require_once $rootPath . "controllers/editSale.php";
    require_once $rootPath . "controllers/deleteSale.php";
    
    require_once $rootPath . "controllers/adminProducts.php";
    require_once $rootPath . "controllers/adminCreateSale.php";
    require_once $rootPath . "controllers/getProductsWithFilters.php";
    

    require_once $rootPath . "views/backend/partials/header.php";
?>
<div class="wrapper">
    <form method="POST" action="salesActionDecider">
        <select name="sale" id="sale">
            <?php
                foreach($sales as $sale){
            ?>
                    <option value="<?php echo $sale['sale_id']; ?>"><?php echo $sale['title']; ?></option>
            <?php
                }
            ?>
        </select>
        <div class="Reset_create_div">
            <button class="button" name="action" value="edit" type="submit">Edit</button>
            <button class="button" name="action" value="delete" type="submit">Delete</button>
        </div>
    </form>
    <form method="POST" action="/adminCreateSaleFunction">
        
        <div class="Admin-page-title">
            <h1>Create Sale</h1>
        </div>
        <div class="Admin-handlers">
            <div class="Admin-search-product">
                <input type="hidden" name="createSale" value="true">
                <input class="input" type="text" name="title" placeholder="Title">
                From <input class="input" type="date" name="start" placeholder="Starts">
                To <input class="input" type="date" name="end" placeholder="Ends">
                <textarea name="description" id="" cols="30" rows="10"></textarea>
                <input class="button submit" type="submit">
            </div>
            <div class="Reset_create_div"> <!-- ?????? should be in the top right corner and not the middle of the page -->
                <a class="button" href="/adminProducts">Back to products</a>
            </div>
        </div>
    
        <div class="wrapper-main-area">
            <div class="products">
                <?php
                    for($i = 0; $i < count($data); $i++){
                        $indData = $data[$i];
                ?>
                        <label for="<?php echo $indData['products_id'] ?>" class="product">
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
                            </div>
    
                            <div class="Edit-Delete-div">
                                <!-- 
                                    The idea of how this is going to work (Psuedo code)
                                     * we send all product_ids and sales in even if empty
                                     * we get the array indexes of all filled out sales and put them in a new array
                                     * we loop through the array[new array[i]]
                                     * sales[new array[i]] and product_ids[new array[i]] are matching
                                     * saleType[new array[i]] will give the type of sail
                                 -->
                                <input type="hidden" name="product_ids[]" value="<?php echo $indData['products_id'] ?>">
                                <input required value="0" class="input" type="number" name="sales[]" placeholder="Sale" id="<?php echo $indData['products_id'] ?>">
                                <input checked class="input" type="radio" name="saleTypes[<?php echo $i; ?>]" value="%" id="%<?php echo $indData['products_id'] ?>">
                                <label for="%<?php echo $indData['products_id'] ?>">%</label>
    
                                <input class="input" type="radio" name="saleTypes[<?php echo $i; ?>]" value="$" id="$<?php echo $indData['products_id'] ?>">
                                <label for="$<?php echo $indData['products_id'] ?>">$</label>
                            </div>
                        </label>
                <?php
                    }
                ?>
            </div>
            <div class="choose-image">
                <?php
                    for($i = 0; $i < count($mediaData); $i++){
                        $indData = $mediaData[$i];
                ?>
                    <div class="image">
                            <label for="<?php echo $indData['media_id']; ?>">
                                <div>
                                    <p><?php echo $indData['name'] ?></p>
                                    <figure class="figure">
                                        <!-- ?????? should be styled with seperate css file -->
                                        <img width="300px" src="<?php echo $rootPath."/uploads/".$indData['media_id'] ?>" alt="">
                                    </figure>
                                </div>
                            </label>
                            <input class="input-checkbox-hidden" type="checkbox" id="<?php echo $indData['media_id']; ?>" name="media[]" value="<?php echo $indData['media_id']; ?>">
                            <div class="alignment">
                                <label for="<?php echo $indData['media_id']?>_primaryImage">Primary Image</label>
                                <input name="primaryImage" type="radio" id="<?php echo $indData['media_id']?>_primaryImage" value="<?php echo $indData['media_id']; ?>">
                            </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </form>
</div>

<?php 
    require_once $rootPath . "views/backend/partials/footer.php";
?>