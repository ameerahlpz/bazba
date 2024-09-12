
<?php
	//$product_ID=$_POST['cost'];

//*Database connection works with user_registration

	$conn = new mysqli('localhost','root','','bazbastore');
	if($conn->connect_error){
		die('Connection Failed : '.$conn->connect_error);
	}else{
	
	$stmt = $conn->prepare("insert into orders_products (product_ID) values (?)");
	$stmt ->bind_param("i", $product_ID);
	//$stmt ->execute();
	echo "Thank-you for your order.";
	$stmt ->close();
	$conn ->close();
	}

?>




