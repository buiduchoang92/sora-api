<?php
require_once 'config/config.php';
require_once ROOT . DS . 'services' . DS . 'MySqlConnect.php';

class LoginDetailServices extends MySqlConnect {
    /**
     * The method support insert data to database
     * @param LoginDetail $login_detail
     */
    public function insert($login_detail) {
        // add to customer table
        $token_refresh = $login_detail->getTokenRefresh();
        $email = $login_detail->getGmail();
        $customer_id = $login_detail->getCustomerID();

        $query = "insert into login_details(`customer_id`, `email`, `token_refresh`)
                  value('$customer_id','$email','$token_refresh')
                  ";
        parent::addQuery($query);
        parent::updateQuery();
    }
}