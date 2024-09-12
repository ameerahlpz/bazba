<?php
	$title=$_POST['product_title'];
	$description=$_POST['product_description'];
	$price=$_POST['product_price'];
	$image=$_FILES['product_image']['name'];
	$tmp_image=$_FILES['product_image']['tmp_name'];
	$date = date("Y-m-d H:i:s");
	$status="true";

//*Database connection

	$conn = new mysqli('localhost','root','','bazbastore');
	if($conn->connect_error){
		die('Connection Failed : '.$conn->connect_error);
	}else{
	move_uploaded_file($tmp_image, "./images");

	// insert query
	
	$stmt = $conn->prepare("insert into products (title,description,price,image,date,status) values (?,?,?,?,?,?)");
	$stmt ->bind_param("ssdsss", $title,$description,$price,$image,$date,$status);
	$stmt ->execute();
	echo "Products table has been updated.";
	$stmt ->close();
	$conn ->close();
	}
?>



