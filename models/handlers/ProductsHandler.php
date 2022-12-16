<?php

$rootPath = "";
while(!file_exists($rootPath . "index.php")){
    $rootPath = "../$rootPath";
}
require_once $rootPath . "public/dbconn.php";
require_once $rootPath . "models/sql/products.php";

class ProductsHandler extends Products{

    public $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getColors() {
        $getColors = $this->db->prepare($this->getAllColorsQuery);
        $getColors->execute();
        
        $allColors = $getColors->fetchAll();
        return $allColors;
    }
    
    public function getAssignedColorsToProducts() {
        $getColorAssigments = $this->db->prepare($this->getColorAssigmentsQuery);
        $getColorAssigments->execute();
        
        $colorAssignments = $getColorAssigments->fetchAll();
        return $colorAssignments;
    }

    public function getAssignedColorsToProductsByProductId($id) {
        $getColorAssigments = $this->db->prepare($this->getColorAssigmentsByProductIdQuery);
        $getColorAssigments->bindParam(":id", $id);
        $getColorAssigments->execute();
        
        $colorAssignments = $getColorAssigments->fetchAll();
        return $colorAssignments;
    }

    public function getAssignedMediaToProductsByProductId($id) {
        $getMediaAssigments = $this->db->prepare($this->getMediaAssigmentsByProductIdQuery);
        $getMediaAssigments->bindParam(":id", $id);
        $getMediaAssigments->execute();
        
        $mediaAssignments = $getMediaAssigments->fetchAll();
        return $mediaAssignments;
    }

    public function getTypes() {
        $getTypes = $this->db->prepare($this->getAllTypesQuery);
        $getTypes->execute();

        $allTypes = $getTypes->fetchAll();
        return $allTypes;
    }

    public function createProduct($name, $type, $description, $price, $colors = null, $medias = null, $primaryImage = null) {
        /* 
            Can't do a transaction here because i need to create the product
            before i can get the ID of it since the ID is auto generated by
            the database.
        */
        $createProduct = $this->db->prepare($this->createProductQuery);
        $createProduct->bindParam(':name', $name);
        $createProduct->bindParam(':type', $type);
        $createProduct->bindParam(':description', $description);
        $createProduct->bindParam(':price', $price);
        $createProduct->bindParam(':primary_image', $primaryImage);
        $createProduct->execute();
    
        /* Get the id */
        /* The id is AI by the db after insert the above data into the db */
        $id = $this->db->lastInsertId();
    
        /* Assigns the colors to the product */
        if( isset($colors) && $colors != null ){
            foreach($colors as $color){
                $createProductColor = $this->db->prepare($this->createProductColorQuery);
                $createProductColor->bindParam(':color_id', $color);
                $createProductColor->bindParam(':product_id', $id);
                $createProductColor->execute();
            }
        }

        if( isset($medias) && $medias != null ){
            foreach($medias as $media){
                if($media != $primaryImage){
                    $assignMediaToProduct = $this->db->prepare($this->assignMediaToProductQuery);
                    $assignMediaToProduct->bindParam(':media_id', $media);
                    $assignMediaToProduct->bindParam(':products_id', $id);
                    $assignMediaToProduct->execute();
                }
            }
        }
    }

    public function createSale($title, $description, $image, $start, $end, $ids, $sales, $saleTypes){
        $this->db->beginTransaction();
        $createSale = $this->db->prepare($this->createSaleQuery);
        $createSale->bindParam(':title', $title);
        $createSale->bindParam(':description', $description);
        $createSale->bindParam(':image', $image);
        $createSale->bindParam(':start', $start);
        $createSale->bindParam(':end', $end);
        $createSale->execute();

        $saleId = $this->db->lastInsertId();

        for($i = 0; $i < count($ids); $i++){
            if($sales[$i] != 0){
                $assignProductToSale = $this->db->prepare($this->assignProductToSaleQuery);
                $assignProductToSale->bindParam(':product_id', $ids[$i]);
                $assignProductToSale->bindParam(':sale_id', $saleId);
                $assignProductToSale->bindParam(':sale', $sales[$i]);
                $assignProductToSale->bindParam(':saleType', $saleTypes[$i]);
                $assignProductToSale->execute();
            }
        }

        $this->db->commit();
    }

    public function updateSale($sale_id, $title, $description, $image, $start, $end, $product_ids, $sales, $saleTypes){
        /* Update sale, delete/replace products */

        $this->db->beginTransaction();
        $editSale = $this->db->prepare($this->editSaleQuery);
        $editSale->bindParam(':id', $sale_id);
        $editSale->bindParam(':title', $title);
        $editSale->bindParam(':description', $description);
        $editSale->bindParam(':image', $image);
        $editSale->bindParam(':start', $start);
        $editSale->bindParam(':end', $end);
        $editSale->execute();

        /* Delete sales by sale_id here! */
        $deleteSale = $this->db->prepare($this->deleteAssignedProductsToSaleQuery);
        $deleteSale->bindParam(':id', $sale_id);
        $deleteSale->execute();

        for($i = 0; $i < count($product_ids); $i++){
            if($sales[$i] != 0){
                $assignProductToSale = $this->db->prepare($this->assignProductToSaleQuery);
                $assignProductToSale->bindParam(':product_id', $product_ids[$i]);
                $assignProductToSale->bindParam(':sale_id', $sale_id);
                $assignProductToSale->bindParam(':sale', $sales[$i]);
                $assignProductToSale->bindParam(':saleType', $saleTypes[$i]);
                $assignProductToSale->execute();
            }
        }

        $this->db->commit();
    }

    public function getSales(){
        $getSales = $this->db->prepare($this->getSalesQuery);
        $getSales->execute();

        return $getSales->fetchAll();
    }

    public function getProducts($search = '', $id = '', $type = '') {
        /* 
            We need to check if we are searching for types because we have to use different
            queries depending on if we search for it or not
        */

        if( isset( $type ) && $type != '' ){
            /* 
                We can't use a wildcard on an int(id) so we have to structure the query
                differently depending on weather we have an id or not
            */
            if( isset( $id ) && $id != ''){
                $getProducts = $this->db->prepare($this->getProductsDynamicSearchQuery);
                $getProducts->bindParam(':id', $id);
            }else{
                $getProducts = $this->db->prepare($this->getProductsDynamicSearchWithoutIdQuery);
            }
            $getProducts->bindParam(':type', $type);
        }else{
            /* 
                This is basicly just a copy paste of the above code with minor changes
            */
            if( isset( $id ) && $id != ''){
                $getProducts = $this->db->prepare($this->getProductsDynamicSearchWithoutTypeQuery);
                $getProducts->bindParam(':id', $id);
            }else{
                $getProducts = $this->db->prepare($this->getProductsDynamicSearchWithoutIdAndTypeQuery);
            }
        }

        if ( isset( $search ) ){
            $search = "%" . $search . "%";
        }else{
            $search = "%";
        }
        $getProducts->bindParam(':search', $search);    
        $getProducts->execute();

        $products = $getProducts->fetchAll();
        return $products;
    }

    public function getMedia($name = '%') {
        $getMedia = $this->db->prepare($this->getMediaDynamicSearchQuery);

        if ( isset( $name ) ){
            $name = "%" . $name . "%";
        }else{
            $name = "%";
        }
        $getMedia->bindParam(':name', $name);    
        $getMedia->execute();

        $media = $getMedia->fetchAll();
        return $media;
    }

    public function getSaleById($id) {
        $getSale = $this->db->prepare($this->getSaleByIdQuery);
        $getSale->bindParam(':id', $id);
        $getSale->execute();

        return $getSale->fetch();
    }

    public function getProductSalesBySaleId($id) {
        $getSale = $this->db->prepare($this->getProductSalesBySaleIdQuery);
        $getSale->bindParam(':id', $id);
        $getSale->execute();

        return $getSale->fetchAll();
    }
    
    public function editProduct($id, $name, $description, $price, $type, $colors = null, $medias = null, $primaryImage) {
        $this->db->beginTransaction();

        //Deletes the colors and media that was previously assigned to the product
        $deletePeviouslyAssignedColors = $this->db->prepare($this->deleteProductColorByProductIdQuery);
        $deletePeviouslyAssignedColors->bindParam(':id', $id);
        $deletePeviouslyAssignedColors->execute();

        
        $deletePeviouslyAssignedColors = $this->db->prepare($this->deleteProductMediaByProductIdQuery);
        $deletePeviouslyAssignedColors->bindParam(':id', $id);
        $deletePeviouslyAssignedColors->execute();
    
        //Uploads every new relation for each color that was selected
        if( $colors != [] && $colors != null){
            foreach ($colors as $color) {
                $assignColorToProduct = $this->db->prepare($this->createProductColorQuery);
                $assignColorToProduct->bindParam(':product_id', $id);
                $assignColorToProduct->bindParam(':color_id', $color);
                $assignColorToProduct->execute();
    
            }
        }

        //Uploads every new relation for each media that was selected
        if( isset($medias) && $medias != null ){
            foreach($medias as $media){
                if($media != $primaryImage){
                    $assignMediaToProduct = $this->db->prepare($this->assignMediaToProductQuery);
                    $assignMediaToProduct->bindParam(':product_id', $id);
                    $assignMediaToProduct->bindParam(':media_id', $media);
                    $assignMediaToProduct->execute();
                }
            }
        }

        //Uploads the remaining user data
        $editUser = $this->db->prepare($this->updateProductByIdQuery);
        
        $editUser->bindParam(':id', $id);
        $editUser->bindParam(':name', $name);
        $editUser->bindParam(':description', $description);
        $editUser->bindParam(':price', $price);
        $editUser->bindParam(':type', $type);
        $editUser->bindParam(':primary_image', $primaryImage);
        $editUser->execute();

        $this->db->commit();
    }

    public function editMedia($id, $name, $type = null){
        $assignMediaToProduct = $this->db->prepare($this->updateMediaQuery);
        $assignMediaToProduct->bindParam(':media_id', $id);
        $assignMediaToProduct->bindParam(':name', $name);
        $assignMediaToProduct->execute();
    }

    public function deleteProductById($product_id) {
        try{
            $this->db->beginTransaction();
            $deleteProduct = $this->db->prepare($this->deleteProductByIdQuery);
            $deleteProduct->bindParam(":id", $product_id);
            $deleteProduct->execute();
            
            $deleteColorJunction = $this->db->prepare($this->deleteProductColorByProductIdQuery);
            $deleteColorJunction->bindParam(":id", $product_id);
            $deleteColorJunction->execute();

            $deleteMediaJunction = $this->db->prepare($this->deleteProductMediaByProductIdQuery);
            $deleteMediaJunction->bindParam(":id", $product_id);
            $deleteMediaJunction->execute();
            $this->db->commit();
        } catch (Throwable $error) {
            $this->db->rollBack();
        }
    }

    public function deleteMediaById($media_id) {
        $deleteProduct = $this->db->prepare($this->deleteMediaByIdQuery);
        $deleteProduct->bindParam(":id", $media_id);
        $deleteProduct->execute();
    }

    public function deleteProductMediaJunctionByMediaId($id){
        $deleteMediaJunction = $this->db->prepare($this->deleteProductMediaByMediaIdQuery);
        $deleteMediaJunction->bindParam(":id", $id);
        $deleteMediaJunction->execute();
    }

    public function deleteSaleById($id){
        $this->db->beginTransaction();
        $deleteSale = $this->db->prepare($this->deleteSaleById);
        $deleteSale->bindParam(':id', $id);
        $deleteSale->execute();
        
        /* Delete sales by sale_id here! */
        $deleteSaleProducts = $this->db->prepare($this->deleteAssignedProductsToSaleQuery);
        $deleteSaleProducts->bindParam(':id', $id);
        $deleteSaleProducts->execute();
        $this->db->commit();
    }

    public function uploadImage($id, $name = "pineapple"){
        $createImageRefOnDb = $this->db->prepare("INSERT INTO media (media_id, name) VALUES (:id, :name)"); /* ✒️ Should be in models */
        $createImageRefOnDb->execute(array(
            ":id" => $id,
            ":name" => $name
        ));
    }

    public function getRelatedProducts($type){
        $getTypeId = $this->db->prepare($this->convertTypeToTypeIdQuery);
        $getTypeId->bindParam(':type', $type);
        $getTypeId->execute();

        $typeId = $getTypeId->fetch();

        $getRelatedProducts = $this->db->prepare($this->getRelatedProductsQuery);
        $getRelatedProducts->bindParam(':type', $typeId['id']);
        $getRelatedProducts->execute();

        return $getRelatedProducts->fetchAll();
    }
}

$ProductsHandler = new ProductsHandler($db);