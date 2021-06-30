<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link href="./style.css" rel="stylesheet">
</head>
<body>
	<header id="index-header">
		<h1>Product List</h1>
		<input type="button" value="ADD" onclick="window.location.href='./add-product.html'">
		<form id="del" action="./delete.php" method="POST"><input type="submit" value="MASS DELETE" id="delete-product-btn"></form>
	</header>
	<main>
	<?php
	include './database.php';

	if (empty($_GET)) {
		$conn = new mysqli($servername, $username, $password);
	  	$sql = "SELECT * FROM $db.$table";
	  	foreach ($conn->query($sql) as $row) {
			echo '<div class="product-box">';
			echo "<input form='del' type='checkbox' class='delete-checkbox' name='check[]' value='".$row['id']."'>";
			echo "<p>".$row['sku']."</p>";
			echo "<p>".$row['name']."</p>";
			echo "<p>$".$row['price']."</p>";
			//i guess here I *could* import the classes and make an object from type and then put $obj->get_attribute where $row[''] is?
			if ($row['type'] === 'Book') { echo "<p>" . $row['attribute'] . "</p>"; }
			elseif ($row['type'] === 'DVD') { echo "<p>" . $row['attribute'] . "</p>"; }
			elseif ($row['type'] === 'Furniture') { echo "<p>" . $row['attribute'] . "</p>"; }
			echo "</div>";
		}
	}
	?>
	</main>
</body>
</html>
