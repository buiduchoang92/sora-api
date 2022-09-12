<?php
ob_start();
require_once "./config/config.php";
class LoginController {
    public function __render(){
    }
    function __construct() {
        self::checkLogin();
    }
    function checkLogin() {
        if(array_key_exists("email", $_POST)){
            $email = $_POST['email'];
            $password = $_POST['password'];
            require_once "./services/LoginServices.php";
            $login_service = new LoginServices();
            $checker = $login_service->checkAccountLogin($email, $password);
            if($checker === true){
                // $_SESSION['email'] = $email;
                // $_SESSION['password'] = $password;
                require_once 'authenticate.php';
                $authenticate = new Authenticate($_SERVER['HTTP_HOST'],$email);
                $token_access_jwt = $authenticate->generateAccessJWT($_SERVER['HTTP_HOST'],$email);
                $token_refresh_jwt = $authenticate->generateRefreshJWT($_SERVER['HTTP_HOST'],$email);
                $account_id = self::getAccountID($email);
                require_once ROOT . DS .'mvc' . DS . 'models' . DS . 'LoginData' . DS . 'LoginDetail.php';
                $login_detail = new LoginDetail($token_refresh_jwt,$account_id,$email);
                self::setLoginDetail($login_detail);
                $status_code = 200;
                $results = [
                    'status' => 'login successful',
                    'token_access_jwt' => $token_access_jwt,
                    'token_refresh_jwt' => $token_refresh_jwt,
                    'email' => $email
                ];
            } else {
                $status_code = 401;
                $results = [
                    'status' => 'login failed',
                ];
            }
            header("Content-Type: application/json");
            echo json_encode(['results'=>$results,'status_code'=>$status_code]);
        }
    }
    function getAccountID($email) {
        require_once "./services/CustomerServices.php";
        $service = new CustomerServices();
        return $service->getCustomerID($email);
    }
    function setLoginDetail($login_detail) {
        require_once "./services/LoginDetailServices.php";
        $service = new LoginDetailServices();
        $service->insert($login_detail);
    }
}
