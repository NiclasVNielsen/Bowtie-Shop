<?php
    /* 
        ✒️ 
        * Needs password hashing
        * Needs tokens instead of sessions    
    */
    $rootPath = "";
    while(!file_exists($rootPath . "index.php")){
        $rootPath = "../$rootPath";
    }
    require $rootPath . "dbconn.php";

    /* gets the information from the post request */
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql = "SELECT name, password FROM users WHERE name='$name' AND password='$password'"; /* <-- ✒️ Model */

    /* Fetches the data from the db */
    $data = $pdo->query($sql)->fetchAll();
    
    /* Checks if the user exists */
    if($data[0]['name']){
        //login
        $_SESSION["name"] = $data[0]['name'];
        $_SESSION["loggedin"] = "true";

        header("Location:/");
    }else{
        header("Location: /login?err=wronginfo");
    }
