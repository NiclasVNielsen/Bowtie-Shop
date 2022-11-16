<?php

/* Checks if it passes validation */
if($validated == true){
    
    /* Check if there is sent a post */
    if( isset( $_POST['createProduct'] ) ){
        /* Gets all the values from the post request */
        $name = $stringSanitation->sanitice($_POST['createName']);
        $type = $_POST['createType'];
        $description = $stringSanitation->sanitice($_POST['createDescription']);
        $price = $_POST['createPrice'];
        $colors = null;

        
        $validStrings = $stringSanitation->getValidationStatus();
    
        /* Checks if all the strings pass validation */
        if($validStrings == true){
            /* 
                Can't do a transaction here because i need to create the product
                before i can get the ID of it since the ID is auto generated by
                the database.
            */
            
            $createProduct = $pdo->prepare($Products->createProduct);
            $createProduct->bindParam(':name', $name);
            $createProduct->bindParam(':type', $type);
            $createProduct->bindParam(':description', $description);
            $createProduct->bindParam(':price', $price);
            $createProduct->execute();
        
            /* Get the id */
            /* The id is AI by the db after insert the above data into the db */
            $id = $pdo->lastInsertId();
        
            /* Assigns the colors to the product */
            if( isset($_POST['createColors']) ){
                $colors = $_POST['createColors'];
        
                foreach($colors as $color){
                    $createProductColor = $pdo->prepare($Products->createProductColor);
                    $createProductColor->bindParam(':color_id', $color);
                    $createProductColor->bindParam(':product_id', $id);
                    $createProductColor->execute();
                }
            }

            /* Upload Image */
            if(isset($_FILES['createImage'])){
                echo "createImage is making it here!";
                $imageUpload->uploadImage($_FILES['createImage']);
            }

            /* ✒️ Needs to connect the uploaded image to the product */
        }
    }
}
