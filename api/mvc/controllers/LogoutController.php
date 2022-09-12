<?php

require_once "./config/config.php";

class LogoutController {
    function __construct() {
        if ($_POST('email')) {
            self::Logout();
        }
    }
    
    function Logout() {
        $email = $_POST('email');
        require_once ROOT . DS .'mvc' . DS . 'models' . DS . 'LoginData' . DS . 'LoginDetail.php';
        $login_detail = new LoginDetail($token_refresh_jwt,$account_id,$email);
        self::deleteRecordLoginDetail($login_detail);
    }
    function deleteRecordLoginDetail($login_detail) {
        require_once "./services/LoginDetailServices.php";
        $service = new LoginDetailServices();
        $service->insert($login_detail);
    }
}