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
    require $rootPath . "public/dbconn.php";
    
    require_once $rootPath . "security/inputSanitation.php";

    /* gets the information from the post request */
    $name = $inputSanitation->sanitice($_POST['name']);
    $password = $inputSanitation->sanitice($_POST['password']);

    
    $validStrings = $inputSanitation->getValidationStatus();

    if($validStrings == true){
        $sql = "SELECT name, password, role FROM users WHERE name='$name'"; /* <-- ✒️ Model */
    
        $validated = false;
    
        /* Fetches the data from the db */
        $data = $db->query($sql)->fetchAll();
    
        /* Checks if the user exists */
        $loginFail = false;
        if( isset($data[0]['name']) ){
            if(password_verify($password, $data[0]['password'])){
                $validated = true;
            }else{
                $loginFail = true;
            }
        }else{
            $loginFail = true;
        }
        if($loginFail == true){
            header("Location: /loginFailedFunction");
        }
    
        if($validated == true){
            //login
            $_SESSION["name"] = $data[0]['name'];
            $_SESSION["loggedin"] = true;
    
            if($data[0]['role'] == 1){
                $_SESSION["adminLayout"] = true;
                header("Location: /adminFrontpage");
            }else{
                header("Location: /");
            }
        }
    }
