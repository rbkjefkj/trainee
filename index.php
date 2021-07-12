<?php
	include './product.php';
  	$productObj = new DVD(); //ahem can't instantiate Product bcus it's abstract.... that bad?

  	if(isset($_POST['deletor']) && ($_POST['deletor'] !== null)) {
    	$deleteId = $_POST['deletor'];
      	$productObj->delete($deleteId);
  	}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link href="../style.css" rel="stylesheet">
</head>
<body>
	<header id="index-header">
		<h1>Product List</h1>
		<input type="button" value="ADD" onclick="window.location.href='/add-product.php'">
		<form id="del" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
			<input name="deletor" type="submit" value="MASS DELETE" id="delete-product-btn">
		</form>
	</header>
	<main>
	<?php
		$products = $productObj->read();
		if ($products !== 'nada') {
			foreach ($products as $product) {
				echo '<div class="product-box">';
 				echo "<input form='del' type='checkbox' class='delete-checkbox' name='check[]' value='".$product['id']."'>";
 				echo "<p>".$product['sku']."</p>";
 				echo "<p>".$product['name']."</p>";
 				echo "<p>$".$product['price']."</p>";
				echo "<p>".$product['attribute']."</p>";
				echo "</div>";
			}
		} else echo "<h2>Nothing in database ( ͠° ͟ʖ ͡°)</h2>";
	?>
	</main>
</body>
</html>
