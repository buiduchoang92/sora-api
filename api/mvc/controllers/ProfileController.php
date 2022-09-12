<?php

require_once "./config/config.php";

class ProfileController {
    function __construct() {
        self::getAccountID();
    }
    
    function getAll() {
        $service = new CustomerServices();
        
        $listGuest = $service->getAll();
        
        $response = array();
        
        $cnt = 0;
        foreach ($listGuest as $guest){
            array_push($response,(object)[
                'user_name' => $guest->getUsername(),
                'your_name' => $guest->getName(),
                'address' => $guest->getTelephone(),
                'telephone' => $guest->getTelephone()
            ]);
            $cnt++;
        }
        
        echo json_encode($response);
    }
    function getAccountID() {
        require_once ROOT . DS .'services' . DS . 'CustomerServices.php';
        $service = new CustomerServices();
        // $email = $_GET['email'];
        $email = 'hoangbui+4@gmail.com';
        $customer_id = $service->getCustomerID($email);
        echo json_encode($customer_id);
        // return $customer_id;
    }
}