<?php
include './database.php';

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
	$stmt = $conn->prepare("INSERT INTO $db.$table(sku, name, price, type, attribute) VALUES(?, ?, ?, ?, ?)");
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

?>
