<?php

require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'People' . DS . 'TypePeople.php';

class People {
    private $username;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $addressID;

    public $type = TypePeople::NONE;

    public function __construct(
    $first_name
    ,$last_name
    ,$email
    ,$addressID
    ,$username
    ,$password
    ) {
        self::setFirstName($first_name);
        self::setLastName($last_name);
        self::setGmail($email);
        self::setAddressID($addressID);
        self::setUserName($username);
        self::setPassword($password);
    }
    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }
    /**
     * @return mixed
     */
    public function getGmail()
    {
        return $this->email;
    }
    /**
     * @return mixed
     */
    public function getPassWord()
    {
        return $this->password;
    }
    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->username;
    }
    /**
     * @return mixed
     */
    public function getAccountID()
    {
        return $this->accountID;
    }
    /**
     * @return mixed
     */
    public function getAddressID()
    {
        return $this->addressID;
    }
    /**
     * @return mixed
     */
    public function getTokenJwt()
    {
        return $this->token_jwt;
    }
    /**
     * @return mixed
     */
    public function getLoginID()
    {
        return $this->loginID;
    }
    /**
     * @return mixed
     */
    public function setGmail($email)
    {
        $this->email = $email;
    }
    /**
     * @return mixed
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @param mixed $addressID
     */
    public function setAddressID($addressID)
    {
        $this->addressID = $addressID;
    }

    /**
     * @param mixed $AccountID
     */
    public function setAccountID($accountID)
    {
        $this->accountID = $accountID;
    }

    /**
     * @param mixed $loginID
     */
    public function setLoginID($loginID)
    {
        $this->loginID = $loginID;
    }
    /**
     * @param mixed $setUserName
     */
    public function setUserName($username)
    {
        $this->username = $username;
    }
}
