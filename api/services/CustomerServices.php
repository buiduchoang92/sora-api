<?php
require_once 'config/config.php';
require_once ROOT . DS . 'services' . DS . 'MySqlConnect.php';
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'People'. DS . 'Customer' . DS . 'Customer.php';

class CustomerServices extends MySqlConnect {
    /**
     * The method support insert data to database
     * @param Customer $customer
     */
    public function insert($customer) {
        // add to customer table
        $store_id = $customer->getStoreID();
        $first_name = $customer->getFirstName();
        $last_name = $customer->getLastName();
        $gmail = $customer->getGmail();
        $address_id = $customer->getAddressID();
        $active = $customer->getActive();
        $username = $customer->getUserName();
        $password = $customer->getPassWord();

        $query = "insert into customer(`first_name`, `last_name`, `email`, `address_id`, `username`,`password`, `active`,`store_id`)
                  value('$first_name','$last_name','$gmail',$address_id,'$username','$password',$active,$store_id)
                  ";
        echo $query;
        parent::addQuery($query);
        parent::updateQuery();

        // when create customer, one cart will create
        // $query = "insert into cart(user_name)
        //             value (" .
        //             "'" . $customer->getFirstName() . "'"
        //                 . ")";
        // parent::addQuery($query);
        // parent::updateQuery();
    }

    /**
     * The method support delete row in database
     * @param String $username
     */
    public function delete($username){
        // next, delete row with user_name in evaluate table
        $query = "delete from evaluate
                  where user_name = '" . $username . "'";
        parent::addQuery($query);
        parent::updateQuery();

        // next, delete row with user_name in guest table
        $query = "delete from guest
                  where user_name = '" . $username . "'";
        parent::addQuery($query);
        parent::updateQuery();
    }

    /**
     * Return all product in products table
     * @return array
     */
    public function getAll(){
        $listCustomer = array();
        $query = "select * from customer";
        parent::addQuery($query);
        $result = parent::executeQuery();

        while($row = mysqli_fetch_array($result)){
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $active = $row['active'];
            $email = $row['email'];
            $password = $row['password'];
            $addressID = $row['address_id'];
            $storeID = $row['store_id'];
            $username = $row['username'];

            $customer = new Customer( $first_name, $last_name, $email, $addressID, $username, $password, $active, $storeID);

            array_push($listCustomer, $customer);
        }
        // var_dump($listCustomer,': listCustomer');
        // var_dump(json_encode($listCustomer),': json_encode listCustomer');
        return $listCustomer;
    }

    /**
     * Return product have product_id = $product_id
     * @param String $email
     * @return Customer
     */
    public function get($email){
        $query = "select * from customer
                    where email='" . $email . "'";
        parent::addQuery($query);
        $result = parent::executeQuery();

        if($row = mysqli_fetch_array($result)){
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $active = $row['active'];
            $email = $row['email'];
            $password = $row['password'];
            $addressID = $row['address_id'];
            $storeID = $row['store_id'];
            $username = $row['username'];

            $customer = new Customer( $first_name, $last_name, $email, $addressID, $username, $password, $active, $storeID);
            return $customer;
        }

        return null;
    }

    public function getCustomerID($email){
        $query = "select * from customer
                    where email='" . $email . "'";
        parent::addQuery($query);
        $result = parent::executeQuery();
        if($row = mysqli_fetch_array($result)){
            $customer_id = $row['customer_id'];
            return $customer_id;
        }
    }

    /**
     * The method update data to database
     * @param Guest $guest
     */
    public function update($guest) {
        // update to products table
        $username = $guest->getUsername();
        $password = $guest->getPassword();
        $name = $guest->getName();
        $address = $guest->getAddress();
        $telephone = $guest->getTelephone();

        $query = "update guest
                  set your_password = '$password',
                      your_name = '$name',
                      address = '$address',
                      telephone = '$telephone'
                  where user_name = '$username'
                  ";

        parent::addQuery($query);
        parent::updateQuery();
    }


    /**
    * Check account is exists
    * @param String $username
    * @param String $password
    * @return bool
    */
    public function checkAccount($login_id, $account_id) {
        $query = "select * from guest where login_id = '$login_id' and account_id = '$account_id'";
        parent::addQuery($query);

        $result = parent::executeQuery();
        if(mysqli_fetch_array($result)){
            return True;
        } else {
            return False;
        }
    }

    public function getLoginID($id) {
        $query = "select * from customer where login_id = '$id' ";
        parent::addQuery($query);

        $result = parent::executeQuery();
        if (mysqli_fetch_array($result)) {
            return $result;
        }
    }
}