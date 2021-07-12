<?php
require_once('./database.php');

abstract class Product extends Database {
	public function __construct() {
		parent::__construct();

		//anti XSS
		function testInput($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
  	}

    abstract public function getAttribute();

	public function create($post) {
		$this->sku = testInput($_POST['sku']);
		$this->name = testInput($_POST['name']);
		$this->price = testInput($_POST['price']);
		$this->type = testInput($_POST['type']);

		$attribute = $this->getAttribute();
		$stmt = $this->conn->prepare("INSERT INTO " . Database::$db . "." . Database::$table . "(sku, name, price, type, attribute) VALUES(?, ?, ?, ?, ?)");
		$stmt->bind_param("ssdss", $this->sku, $this->name, $this->price, $this->type, $attribute);
		$stmt->execute();
		$stmt->close();
		header('Location: ./');
	}


	public function read() {
		$sql = "SELECT * FROM " . Database::$db . "." . Database::$table;
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
			   $data[] = $row;
			}
		 	return $data;
		} else return 'nada';
	}


	public function delete($post) {
		if (empty($_POST['check'])) { return; }
		$checkbox = $_POST['check'];
		for($i = 0; $i < count($checkbox); $i++) {
			$del_id = $checkbox[$i];
			$stmt = $this->conn->prepare("DELETE FROM " . Database::$db . "." . Database::$table . " WHERE id =?");
			$stmt->bind_param("i", $del_id);
			$stmt->execute();
		}
		$stmt->close();
		header('Location: ./');
	}
}


//these classes are so small I left them in the same file :?
class DVD extends Product {
	public function __construct() {
		parent::__construct();
		//$this->size = testInput($_POST['size']);
  	}

	public function getAttribute() {
    	return "Size: $this->size MB";
  	}
}



class Book extends Product {
	public function __construct() {
		parent::__construct();
		$this->weight = testInput($_POST['weight']);
  	}

	public function getAttribute() {
    	return "Weight: $this->weight KG";
  	}
}



class Furniture extends Product {
	public function __construct() {
		parent::__construct();
		$this->height = testInput($_POST['height']);
		$this->width = testInput($_POST['width']);
		$this->length = testInput($_POST['length']);
  	}

	public function getAttribute() {
    	return "Dimensions: $this->height" . "x" . "$this->width" . "x" . "$this->length";
  	}
}

?>
