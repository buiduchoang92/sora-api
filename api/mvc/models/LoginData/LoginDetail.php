<?php

class LoginDetail {
    private $token_refresh;
    private $customer_id;
    private $email;

    public function __construct($token_refresh,$customer_id,$email) {
        self::setTokenRefresh($token_refresh);
        self::setCustomerID($customer_id);
        self::setGmail($email);
    }

    /**
     * @return mixed
     */
    public function getGmail()
    {
        return $this->email;
    }
    public function getTokenRefresh()
    {
        return $this->token_refresh;
    }
    public function getCustomerID()
    {
        return $this->customer_id;
    }
    
    /**
     * @param mixed
     */
    public function setCustomerID($customer_id)
    {
        $this->customer_id = $customer_id;
    }
    public function setTokenRefresh($token_refresh)
    {
        $this->token_refresh = $token_refresh;
    }
    public function setGmail($email)
    {
        $this->email = $email;
    }
}
