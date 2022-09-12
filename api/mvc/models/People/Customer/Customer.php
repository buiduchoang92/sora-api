<?php

require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'People' . DS . 'People.php';

class Customer extends People {
    private $active;
    private $storeID;
    private $customerID;

    public $type = TypePeople::CUSTOMER;

    public function __construct(
    $first_name
    ,$last_name
    ,$email
    ,$addressID
    ,$username
    ,$password
    ,$active
    ,$storeID) {
        parent::__construct(
        $first_name
        ,$last_name
        ,$email
        ,$addressID
        ,$username
        ,$password
        );
        self::setActive($active);
        self::setStoreID($storeID);
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }
    public function getCustomerId()
    {
        return $this->customerID;
    }
    /**
     * @return mixed
     */
    public function getStoreID()
    {
        return $this->storeID;
    }
    /**
     * @return mixed
     */
    public function setStoreID($storeID)
    {
        return $this->storeID = $storeID;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
}
