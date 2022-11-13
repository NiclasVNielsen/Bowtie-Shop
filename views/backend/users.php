<?php
    $rootPath = "";
    while(!file_exists($rootPath . "index.php")){
        $rootPath = "../$rootPath";
    }
    
    require $rootPath . "views/backend/partials/adminStart.php";
    require $rootPath . "models/users.php";

    /* 🔥 Needs to check if the user is allowed to be here */
    require $rootPath . "controllers/createUser.php";
    require $rootPath . "controllers/editUser.php";
    require $rootPath . "controllers/deleteUser.php";
    require $rootPath . "controllers/getUsersWithFilters.php";

     /* This is to make so search data dosent disapear after search */
     $id = null;
     if(isset($_POST['id'])){
         $id = $_POST['id'];
     }
     $name = null;
     if(isset($_POST['search'])){
         $name = $_POST['search'];
     }
     $page = 0;
     if(isset($_POST['page'])){
         $page = $_POST['page'];
     }
?>

<form method="POST" action="adminUsers">
    <input type="text" name="id" placeholder="ID"  value="<?php echo ($id != null) ? $id : ""; ?>">
    <input type="text" name="name" placeholder="Name"  value="<?php echo ($name != null) ? $name : ""; ?>">
    <input type="submit">
</form>
<a href="/adminUsers">Reset</a>
<a href="/adminCreateUser">Create new user</a>


<?php
    $pageNr = $page;
    $usersPrPage = 4;
    $pageMinIndex = $pageNr * $usersPrPage;
    $pageMaxIndex = $pageMinIndex + $usersPrPage;
?>

<?php
    /* Previous button */
    if($page > 0){
?>
    <form method="POST" action="adminProducts">
        <input type="hidden" name="id" value="<?php echo ($id != null) ? $id : ""; ?>">
        <input type="hidden" name="name" value="<?php echo ($name != null) ? $name : ""; ?>">
        <input type="hidden" name="page" value="<?php echo ($page - 1) ?>">
        <input type="submit" value="Prev">
    </form>
<?php
    }
?>

<?php
    /* Next button */
    if($page < (count($data) / $usersPrPage) - 1){
?>
<form method="POST" action="adminProducts">
    <input type="hidden" name="id" value="<?php echo ($id != null) ? $id : ""; ?>">
    <input type="hidden" name="name" value="<?php echo ($name != null) ? $name : ""; ?>">
    <input type="hidden" name="page" value="<?php echo ($page + 1) ?>">
    <input type="submit" value="Next">
</form>
<?php
    }
?>

<?php
    //foreach($data as $indData){
    for($i = $pageMinIndex; $i < $pageMaxIndex && $i < count($data); $i++){
        $indData = $data[$i];
?>
        <div>
            <p><?php echo $indData['name'] ?></p>
            <form method="POST" action="adminEditUser">
                <input type="hidden" name="id" value="<?php echo $indData['user_id'] ?>">
                <input type="hidden" name="name" value="<?php echo $indData['name'] ?>">
                <input type="submit" value="Edit">
            </form>

            <form method="POST" action="adminUsers">
                <input type="hidden" name="delete" value="<?php echo $indData['user_id'] ?>">
                <input type="submit" value="Delete">
            </form>
        </div>
<?php
    }
?>

<?php 
    require $rootPath . "views/backend/partials/adminEnd.php";
?>
