<?php
if(isset($_GET['invoice_num'])){
$invoice_number=$_GET['invoice_num'];
echo $invoice_number;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bazba Checkout Page</title>
	<!-----bootstrap css link------->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-----font awesome link----->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

	<link rel="stylesheet" type="text/css" />
	<style type="text/css">

div.spheader { width:100%; background: #000000; height:45px;}
.spheader ul.spmenu {
     border-right: 1px solid #333;
     margin: 0 0px;
     position: relative;
     width: auto;
}
.col-1 {
	flex-basis: 25%;
}
.col-2 {
	flex-basis: 50%;
}
.col-3 {
	flex-basis: 25%;
}
.col-md-4{
	flex-basis: 30%;
}
.navbar {
	background-color: #6f42c1;
}
.navbar a{
	color: #ffffff;
}
.btn {
	display: inline-block;
     background-color: #6fa8dc; 
     border: none;
     color: #ffffff;
     padding: 8px 30px;
     margin: 30px 0;
     border-radius: 30px;
     font-size: 15px;
     text-decoration: none;
     cursor: pointer;
}
input {
  height: 50%;
  padding: 8px 30px;
  margin: 30px 0;
  border-radius: 50px;
}
.card{
		display: inline-block;
		float: left;
		width: 33.3%;
		padding: 5px;
		height: 1050px;
}
	</style>

<body>
	<!-----navbar----->
	<div class="container-fluid p-0">
		<!------first child----->
		<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="nav-link" href="#">Country</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Register</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2 p-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</div>


	
<div class="row">

	<!----fetching products----->
	<?php
	require_once 'header.php';
	
	
	?>
	<?php  
	
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
$ip = getIPAddress();  
 
	?>
	<?php
			
			function cart(){
				if(isset($_GET['add_to_cart'])){
				// global $conn;
				$conn = mysqli_connect("localhost", "root", "", "bazbastore");
				$ip=getIPAddress();
				$get_product_ID=$_GET['add_to_cart'];
				
				$select_query="Select * from cart_details where ip_address='$ip' and product_id=$get_product_ID";
				$result_query=mysqli_query($conn,$select_query);
				$num_of_rows=mysqli_num_rows($result_query);
				if($num_of_rows>0){
					echo"<script>alert('This item is present inside cart')</script>";
					echo"<script>window.open('bazba.php','_self')</script>";
				}else{
					$insert_query="insert into cart_details (product_id,ip_address,quantity) values ($get_product_ID, '$ip',0)";
					$result_query=mysqli_query($conn, $insert_query);
					echo"<script>alert('Item is added to cart')</script>";
					echo"<script>window.open('cart.php', '_self')</script>";
				}
				}	
			}
			// function to get cart item numbers
			function cart_item(){
			if(isset($_GET['add_to_cart'])){
				// global $conn;
				$conn = mysqli_connect("localhost", "root", "", "bazbastore");
				$ip=getIPAddress();
				$select_query="Select * from cart_details where ip_address='$ip'";
				$result_query=mysqli_query($conn,$select_query);
				$count_cart_items=mysqli_num_rows($result_query);
				}else{
				$conn = mysqli_connect("localhost", "root", "", "bazbastore");
				$ip=getIPAddress();
				$select_query="Select * from cart_details where ip_address='$ip'";
				$result_query=mysqli_query($conn,$select_query);
				$count_cart_items=mysqli_num_rows($result_query);
				}
				echo $count_cart_items;
				}	
				
				//<!-----fourth child------>
				
				//<div class="row px-1">
					//<div class="col-md-12">
					//<!------products-------->
					//<div class="row">
					//<?php
					if(!isset($_SESSION['username'])){
						include('user_area/user_login(2).php');
					}else{
						include('payment.php');
						
					}
					
	
				//</div>
			//</div>
	
//</div>
?>
		<!-----bootstrap js link----->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>