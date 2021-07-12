<?php
class Database {
	private $server = 	'localhost';	//'us-cdbr-east-04.cleardb.com';	//$url["host"];
	private $username = 'root';			//'b9de354d668753';					//$url["user"];
	private $password = '';				//'7a3cb6ab';						//$url["pass"];
	static $db = 'inventory';			//'heroku_ce23877f9639e47';			//substr($url["path"], 1);
	static $table = 'duck';
	public $conn;
	public $sql;


	public function __construct() {
		if (!isset($this->conn)) { $this->conn = new mysqli($this->server, $this->username, $this->password); }
		if ($this->conn->connect_error) { die("Connection failed: ". $this->conn->connect_error); }

		$sql = "CREATE DATABASE IF NOT EXISTS " . Database::$db;
		$this->conn->query($sql);
		$sql = "CREATE TABLE IF NOT EXISTS " . Database::$db . "." . Database::$table . "(
			id INT AUTO_INCREMENT,
			sku VARCHAR(50) NOT NULL,
		 	name VARCHAR(50) NOT NULL,
		   	price DECIMAL(6,2) NOT NULL,
		   	type VARCHAR(50) NOT NULL,
			attribute VARCHAR(50) NOT NULL,
		   	PRIMARY KEY (id),
			UNIQUE (sku)
		)";
		$this->conn->query($sql);
		//if ($this->conn->query($sql) === TRUE) { echo "table created successfully"; }

		return $this->conn;
	}
}

?>
