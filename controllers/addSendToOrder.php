<?php


$rootPath = "";
while(!file_exists($rootPath . "index.php")){
    $rootPath = "../$rootPath";
}

$filter = false;
require_once $rootPath . "public/dbconn.php";

require_once $rootPath . "models/handlers/PurchaseHandler.php";

if(isset($_POST['id'])){
    if($_POST['send'] == 0){
        $PurchaseHandler->addSendToOrder($_POST['id']);
    }else{
        $PurchaseHandler->removeSendToOrder($_POST['id']);
    }
}
?>
<script>
    //Backend / no breadcrums to go backwards
    window.history.go(-1);
</script>