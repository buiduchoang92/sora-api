<?php

require_once "./config/config.php";
require_once ROOT . DS . 'services' . DS . 'MySqlConnect.php';

class LoginServices extends MySqlConnect {
    
    
    /**
    * Check account is exists
    * @param String $email
    * @param String $password
    * @return bool
    */
    
    public function checkAccountLogin($email, $password) {
        $query = "select * from customer where email = '$email' and password = '$password'";
        parent::addQuery($query);

        $result = parent::executeQuery();
        if(mysqli_fetch_array($result)){
            return true;
        } else {
            return false;
        }
    }
}