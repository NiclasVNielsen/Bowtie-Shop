<?php

$rootPath = "";
while(!file_exists($rootPath . "index.php")){
    $rootPath = "../$rootPath";
}
require_once $rootPath . "dbconn.php";
require_once $rootPath . "models/sql/users.php";

class UsersHandler extends Users{

    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserRole($name) {
        $getUserData = $this->db->prepare($this->getUserRoleQuery);
        $getUserData->bindParam(':name', $name);
        $getUserData->execute();
        
        $role = $getUserData->fetch()['role'];
        return $role;
    }
    public function checkIfUserExists($name) {
        $userCheck = $this->db->prepare($this->checkIfUserExistsQuery);
        $userCheck->bindParam(':name', $name);
        $userCheck->execute();

        $data = $userCheck->fetch();
        return $data;
    }

    public function createUser($name, $password, $role) {
        $createUser = $this->db->prepare($this->createUserQuery);
        $createUser->bindParam(':name', $name);
        $createUser->bindParam(':password', $password);
        $createUser->bindParam(':role', $role);
        $createUser->execute();
    }

    public function getUsers($id, $role, $name) {
        /* 
            We can't use a wildcard on an int(id) so we have to structure the query
            differently depending on weather we have an id or not
        */

        //if id & role
        if( (isset( $id ) && $id != "") && (isset( $role ) && $role != "") ){
            $getUsers = $this->db->prepare($this->getUsersByIdAndNameAndRoleQuery);
            $getUsers->bindParam(':id', $id);
            $getUsers->bindParam(':role', $role);
        }else

        //if !id & role    
        if( !(isset( $id ) && $id != "") && (isset( $role ) && $role != "") ){
            $getUsers = $this->db->prepare($this->getUsersByNameAndRoleQuery);
            $getUsers->bindParam(':role', $role);
        }else

        //if id & !role
        if( (isset( $id ) && $id != "") && !(isset( $role ) && $role != "") ){
            $getUsers = $this->db->prepare($this->getUsersByIdAndNameQuery);
            $getUsers->bindParam(':id', $id);
        }else

        //if !id & !role
        {
            $getUsers = $this->db->prepare($this->getUsersByNameQuery);
        }
        
        if ( isset( $name ) ){
            $name = "%" . $name . "%";
        } else {
            $name = "%";
        }
        $getUsers->bindParam(':name', $name);    
        $getUsers->execute();
        
        $data = $getUsers->fetchAll();
        return $data;
    }

    /* Security */
    public function getSecurityData() {
        $getSecurityData = $this->db->prepare($this->getSecurityDataQuery);
        $getSecurityData->execute();

        $securityData = $getSecurityData->fetchAll()[0];
        return $securityData;
    }

    public function updateSecurityData($name, $dbTimeUpdate) {
        $updateSecurityData = $this->db->prepare($this->updateSecurityDataQuery);
        $updateSecurityData->bindParam(":name", $name);
        $updateSecurityData->bindParam(":time", $dbTimeUpdate);
        $updateSecurityData->execute();
    }
}

$UsersHandler = new UsersHandler($db);