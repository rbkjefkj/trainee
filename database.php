<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = 'inventory';
$table = 'product';
//$servername = 'us-cdbr-east-04.cleardb.com';
//$username = 'b6f485efe42b17';
//$password = '09a9eefd';

// Create & check connectionnnnn
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "CREATE DATABASE IF NOT EXISTS $db";
//if ($conn->query($sql) === TRUE) { echo "Created DB<br>"; }
//else { echo "Error creating database: " . $conn->error; }

$sql = "CREATE TABLE IF NOT EXISTS $db.$table (
	id INT AUTO_INCREMENT,
	sku VARCHAR(50) NOT NULL,
 	name VARCHAR(50) NOT NULL,
   	price DECIMAL(6,2) NOT NULL,
   	type VARCHAR(50) NOT NULL,
	attribute VARCHAR(50) NOT NULL,
   	PRIMARY KEY (id),
	UNIQUE (sku)
)";

//if ($conn->query($sql) === TRUE) { echo "Created table<br>"; }
//else { echo "Error creating table: " . $conn->error; }

?>
