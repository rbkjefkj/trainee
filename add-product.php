<?php
include './product.php';

if(isset($_POST['submit'])) {
	$product = new $_POST['type']();
	$product->create($_POST);
}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link href="../style.css" rel="stylesheet">
</head>
<body>
	<!--put the php that sends req to classes.php when POST param is set-->
	<header>
		<h1>Product Add</h1>
		<input type="submit" name="submit" value="Save" form="product_form" class="visible">
		<input type="button" value="Cancel" class="visible" onclick="location.href='./'">
	</header>
	<div class="cutefier">
	<form id="product_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
		<div class="cutefier">
			<label for="sku">SKU</label>
			<input id="sku" autocomplete="off" class="visible" name="sku"><br>
		</div>
		<div class="cutefier">
			<label for="name">Name</label>
			<input id="name" autocomplete="off" class="visible" name="name"><br>
		</div>
		<div class="cutefier">
			<label for="price">Price ($)</label>
			<input id="price" autocomplete="off" class="visible" name="price"><br>
		</div>
		<div class="cutefier">
			<label for="productType">Type Switcher</label>
			<select id="productType" onchange="getLastInput()" class="visible" name="type">
				<option value="TS">Type Switcher</option>
				<option value="DVD">DVD</option>
				<option value="Book">Book</option>
				<option value="Furniture">Furniture</option>
			</select>
		</div>
			<div id="DVD">
				<div class="cutefier">
					<label for="size">Size (MB)</label>
					<input id="size" class="int" autocomplete="off" name="size">
				</div>
				<p>Please provide DVD size in MB</p>
			</div>
			<div id="Furniture">
				<div class="cutefier">
					<label for="height">Height (CM)</label>
					<input id="height" class="int" autocomplete="off" name="height">
				</div>
				<div class="cutefier">
					<label for="width">Width (CM)</label>
					<input id="width" class="int" autocomplete="off" name="width">
				</div>
				<div class="cutefier">
					<label for="length">Length (CM)</label>
					<input id="length" class="int" autocomplete="off" name="length">
				</div>
				<p>Please provide dimensions in HxWxL format</p>
			</div>
			<div id="Book">
				<div class="cutefier">
					<label for="weight">Weight (KG)</label>
					<input id="weight" class="int" autocomplete="off" name="weight">
				</div>
				<p>Please provide book weight in kg</p>
			</div>
	</form>
	<p id="error"></p>
	</div>
	<script src="../form.js"></script>
</body>
</html>
