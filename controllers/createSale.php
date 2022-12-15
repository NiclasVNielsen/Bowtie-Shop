<?php

$rootPath = "";
while(!file_exists($rootPath . "index.php")){
    $rootPath = "../$rootPath";
}
require_once $rootPath . "public/dbconn.php";

require_once $rootPath . "models/handlers/productsHandler.php";
require_once $rootPath . "models/handlers/Usershandler.php";
require_once $rootPath . "security/adminCheck.php";

require_once $rootPath . "security/formSpam.php";
require_once $rootPath . "security/inputSanitation.php";


/* Check if there is sent a post */
if( isset( $_POST['createSale'] ) ){
    /* Gets all the values from the post request */
    $title = $inputSanitation->sanitice($_POST['title']);
    $description = $inputSanitation->sanitice($_POST['description']);
    $start = $_POST['start']; /* 🔥 needs sanitation */
    $end = $_POST['end']; /* 🔥 needs sanitation */


    /* Checks if all the strings pass validation */
    $validStrings = $inputSanitation->getValidationStatus();

    /* Disables the data from being send to the database - used for testing*/
    //$validStrings = false;
    
    if($validStrings == true){
        $product_ids = $_POST['product_ids'];
        $sales = $_POST['sales'];
        $saleTypes = $_POST['saleTypes'];
        /* if($start <= $end){

        } */
        if((count($product_ids) + count($sales)) / 2 == count($saleTypes)){
            $ProductsHandler->createSale($title, $description, $start, $end, $product_ids, $sales, $saleTypes);
        } else {
            echo "Ehhh somethings burning!";
        }
    }
}

header("location: /adminSale");