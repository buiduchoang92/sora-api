<?php


class AuthController {
    public function __render(){
    }
    function __construct() {
        self::updateToken();
    }
    function updateToken() {
        require_once 'authenticate.php';
        $email = 'hoangbui+4@gmail.com';
        $authenticate = new Authenticate($_SERVER['HTTP_HOST'],$email);
        $check_token = $authenticate->validateJWT();
        if (!$check_token) {
            $status_code = 401;
            $results = [
                'status' => false,
            ];
            echo json_encode(['results'=>$results,'status_code'=>$status_code]);
        } else {
            self::refreshToken();
        }
    }
    function refreshToken() {
        echo json_encode('new refresh token');
    }
}
