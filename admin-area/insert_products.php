<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Bazba Theatrical Players</title>
	<!-----bootstrap css link------->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-----font awesome link----->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container-fluid m-3">
<div class="bg-light row d-flex align-items-center justify-content-center">
	<div class="container mt-3 col-lg-12 col-xl-6">
		
		
	<!-----form----->
		<?php require_once 'header.php'; 
		?>
		<h1><center>Insert Products</center></h1>
	
	<!-----<div class="">----->

	<!-----<div class="">----->
	
		<form action="../includes/products.php" method="post" enctype="multipart/form-data">
		<!-----title---->
		<div class="form-outline md-4 w-50 m-auto">
		<label for="product_title" class="form-label">Product Title</label><br>
		<input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required"><br>
		</div>
		<!-----description----->
		<div class="form-outline md-4 w-50 m-auto">
		<label for="product_description" class="form-label">Product Description</label><br>		
		<input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required"><br>
		</div>
		<!-----price------>
		<div class="form-outline md-4 w-50 m-auto">
		<label for="product_price" class="form-label">Product Price</label><br>
		<input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required"><br>
		</div>
		<!-----image------>
		<div class="form-outline md-4 w-50 m-auto">
		<label for="product_image" class="form-label">Product Image</label><br>
		<input type="file" name="product_image" id="product_image" class="form-control-file" required="required"><br><br>
		</div>
		<br><input type="submit" name="submit" value="Insert Products">
		</form>
			
	</div>

</div>
</body>
</heml>

