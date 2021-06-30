<?php
include './database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$checkbox = $_POST['check'];
	for($i = 0; $i < count($checkbox); $i++) {
		$del_id = $checkbox[$i];
		$stmt = $conn->prepare("DELETE FROM $db.$table WHERE id =?");
		$stmt->bind_param("i", $del_id);
		$stmt->execute();
	}
	$conn->close();
	header('Location: ./');
}

?>
