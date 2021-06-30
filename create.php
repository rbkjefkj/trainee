<?php
//$servername = "localhost";
//$username = "root";
//$password = "";
$servername = 'us-cdbr-east-04.cleardb.com';
$username = 'b6f485efe42b17';
$password = '09a9eefd';

// Create & check connectionnnnn
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

//$sql = "CREATE DATABASE IF NOT EXISTS heroku_1fa947a4ab27316";
//if ($conn->query($sql) === TRUE) { echo "Created DB<br>"; }
//else { echo "Error creating database: " . $conn->error; }

$sql = "CREATE TABLE IF NOT EXISTS heroku_1fa947a4ab27316.product (
	id INT AUTO_INCREMENT,
	sku VARCHAR(50) NOT NULL,
 	name VARCHAR(50) NOT NULL,
   	price DECIMAL(6,2) NOT NULL,
   	type VARCHAR(50) NOT NULL,
	attribute VARCHAR(50) NOT NULL,
   	PRIMARY KEY (id),
	UNIQUE (sku)
)";

if ($conn->query($sql) === TRUE) { echo "Created table<br>"; }
else { echo "Error creating table: " . $conn->error; }



abstract class Product {
    public function __construct($size, $weight, $height, $width, $length) {
	    $this->size = $size;
		$this->weight = $weight;
		$this->height = $height;
		$this->width = $width;
		$this->length = $length;
  }

    abstract public function get_attribute();
}

class DVD extends Product {
	public function get_attribute() {
    	return "Size: $this->size MB";
  	}
}

class Book extends Product {
	public function get_attribute() {
    	return "Weight: $this->weight KG";
  	}
}

class Furniture extends Product {
	public function get_attribute() {
    	return "Dimensions: $this->height" . "x" . "$this->width" . "x" . "$this->length";
  	}
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$sku = test_input($_POST['sku']);
	$name = test_input($_POST['name']);
	$price = test_input($_POST['price']);
	$type = test_input($_POST['type']);
	$size = test_input($_POST['size']);
	$weight = test_input($_POST['weight']);
	$height = test_input($_POST['height']);
	$width = test_input($_POST['width']);
	$length = test_input($_POST['length']);

	$obj = new $type($size, $weight, $height, $width, $length);
	$attribute = $obj->get_attribute();
	$stmt = $conn->prepare("INSERT INTO heroku_1fa947a4ab27316.product(sku, name, price, type, attribute) VALUES(?, ?, ?, ?, ?)");
	$stmt->bind_param("ssdss", $sku, $name, $price, $type, $attribute);
	$stmt->execute();
	$stmt->close();
	header('Location: ./');
}

//anti XSS
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
