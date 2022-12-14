<?php

class Users{
    //Basic Crud
    public $createUserQuery = 'INSERT INTO users (name, password, role) VALUES (:name, :password, :role)';


    public $getUsersByIdAndNameQuery = "SELECT * FROM users WHERE name LIKE :name AND user_id = :id";
    public $getUsersByNameAndRoleQuery = "SELECT * FROM users WHERE name LIKE :name AND role = :role";
    public $getUsersByIdAndNameAndRoleQuery = "SELECT * FROM users WHERE name LIKE :name AND user_id = :id AND role = :role";
    public $getUsersByIdAndRoleQuery = "SELECT * FROM users WHERE user_id = :id AND role = :role";
    public $getUsersByNameQuery = "SELECT * FROM users WHERE name LIKE :name";


    public $updateUserByIdQuery = "UPDATE users SET name = :name, password = :password, role = :role WHERE `user_id` = :id";
    public $updateUserByIdWithoutPasswordQuery = "UPDATE users SET name = :name, role = :role WHERE `user_id` = :id";
    public $updateUserByIdWithoutRoleQuery = "UPDATE users SET name = :name, password = :password, role = :role WHERE `user_id` = :id";
    public $updateUserByIdWithoutPasswordAndRoleQuery = "UPDATE users SET name = :name WHERE `user_id` = :id";

    public $updateUserByNameQuery = 'UPDATE users SET name = :name, password = :password WHERE name = :currentName';
    public $updateUserByNameWithoutPasswordQuery = 'UPDATE users SET name = :name WHERE name = :currentName';


    public $deleteUserByIdQuery = 'DELETE FROM users WHERE `user_id` = :user_id';
    public $deleteUserByNameQuery = 'DELETE FROM users WHERE `name` = :name';
    
    //Advanced queries
    public $checkIfUserExistsQuery = 'SELECT name FROM users WHERE name = :name';

    public $getUserRoleQuery = 'SELECT role FROM users WHERE name = :name';

    //Security
    public $getSecurityDataQuery = "SELECT * FROM spamPrevention"; // SELECT name, time FROM spam_prevention WHERE id = 1;
    public $updateSecurityDataQuery = "UPDATE spam_prevention SET name = :name, time = :time WHERE id = 1;";
}
