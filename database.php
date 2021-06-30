<?php
$url = 'mysql://b9de354d668753:7a3cb6ab@us-cdbr-east-04.cleardb.com/heroku_ce23877f9639e47?reconnect=true';
$server = 'us-cdbr-east-04.cleardb.com';//$url["host"];
$username = 'b9de354d668753';//$url["user"];
$password = '7a3cb6ab';//$url["pass"];
$db = 'heroku_ce23877f9639e47';//substr($url["path"], 1);

/*
$url = parse_url(getenv("CLEARDB_DATABASE_URL")); somehow this doesn't wanna work
$server = 'us-cdbr-east-04.cleardb.com';
$username = 'b9de354d668753';
$password = '7a3cb6ab';
$db = 'heroku_ce23877f9639e47';
*/

//$servername = "localhost";
//$username = "root";
//$password = "";
//$db = 'inventory';
$table = 'product';

// Create & check connectionnnnn
$conn = new mysqli($server, $username, $password);
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
else { echo "Error creating table: " . $conn->error; }

?>
