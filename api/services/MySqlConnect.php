<?php

require_once "./config/config.php";
require_once ROOT . DS . 'config' . DS . 'db_config.php';
require_once ROOT . DS . 'services' . DS . 'ISqlConnect.php';

class MySqlConnect implements ISqlConnect {
    private $db;
    private $query;

    public function __construct(){
        $this->db = mysqli_connect(SQL_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

        // if($this->db){
        //     echo "connect successfully <br />";
        // } else {
        //     echo "connect fail! <br />";
        //     exit();
        // }
    }

    // add querry statement
    public function addQuery($query){
        $this->query = $query;
    }

    // use with statement select
    public function executeQuery(){
        $result = mysqli_query($this->db, $this->query) or die(mysqli_error($this->db));

        if(!$result){
            echo "FAIL when execute!";
            exit();
        }

        return $result;
    }


    // use with statement insert, delete, update,..
    public function updateQuery(){
        $result = mysqli_query($this->db, $this->query) or die(mysqli_error($this->db));
        if(!$result){
            echo "FAIL when update!";
            exit();
        }

        // no return result
    }

}
