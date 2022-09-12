<?php

require_once "./config/config.php";
require_once ROOT . DS . 'config' . DS . 'db_config.php';
	/**
	* Database Connection
	*/
	class DbConnect {
		private $server = SQL_SERVER;
		private $dbname = DB_NAME;
		private $user = DB_USER;
		private $pass = DB_PASSWORD;
		public function connect() {
			try {
				$conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch (\Exception $e) {
				echo "Database Error: " . $e->getMessage();
			}
		}
        
	}
?>