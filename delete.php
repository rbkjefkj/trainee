<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$checkbox = $_POST['check'];
	for($i = 0; $i < count($checkbox); $i++) {
		$del_id = $checkbox[$i];
		$stmt = $conn->prepare("DELETE FROM inventory.product WHERE id =?");
		$stmt->bind_param("i", $del_id);
		$stmt->execute();
	}
	$conn->close();
	header('Location: ./');
}

?>
