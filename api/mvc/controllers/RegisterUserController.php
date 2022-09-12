<?php

require_once 'config/config.php';

class RegisterUserController {
    public function __render(){
    }
    function __construct() {
        self::getAccount();
    }
    function getAccount() {
        if(array_key_exists("email", $_POST)){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $active = $_POST['active'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $addressID = $_POST['addressID'];
            $storeID = $_POST['storeID'];
            $username = $_POST['username'];
            require_once __DIR__. '../../models/People/Customer/Customer.php';
            $customer = new Customer($first_name,$last_name,$email,$addressID,$username,$password,$active,$storeID);
            self::setAccount($customer);
            
        }

    }
    function setAccount($customer) {
        require_once ROOT . DS .'services' . DS . 'CustomerServices.php';
        $service = new CustomerServices();
        // $tmpCustomer = $service->get($customer->getGmail());
        // $listCustomers = $service->getAll();

        // if(!in_array($tmpCustomer, $listCustomers)){
            $service->insert($customer);
            // header("Location: login");
        // } else {
        //     echo "<script>Tài khoản bị trùng</script>";
        // }
    }
    function getAccountID($email) {
        require_once ROOT . DS .'services' . DS . 'CustomerServices.php';
        $service = new CustomerServices();
        $customer_id = $service->getCustomerID($email);
        return $customer_id;
    }
    function setLoginDetail($login_detail) {
        require_once ROOT . DS .'services' . DS . 'LoginDetailServices.php';
        $service = new LoginDetailServices();
        $service->insert($login_detail);
    }
}
