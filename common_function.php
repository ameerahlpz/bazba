<?php
		//Cart Function
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
//total price function
			function total_cart_price(){
				$conn = mysqli_connect("localhost", "root", "", "bazbastore");
				$ip=getIPAddress();
				$total=0;
						$cart_query="Select * from cart_details where ip_address='$ip'";
						$result=mysqli_query($conn, $cart_query);
				while($row=mysqli_fetch_array($result)){
						$product_id=$row['product_id'];
						$products_query="Select * from products where product_ID='$product_id'";
						$result_products=mysqli_query($conn, $products_query);
				while($row_product_price=mysqli_fetch_array($result_products)){
						$product_price=array($row_product_price['price']);
						$product_values=array_sum($product_price);
						$total+=$product_values;
					}
				}
				
				
				echo $total;
			}
//get user order details function
				function get_user_order_details(){
				$conn = mysqli_connect("localhost", "root", "", "bazbastore");
				global $conn;
				$username=$_SESSION['user_name'];
				$get_details="Select * from user_table where user_name='$username'";
				$result_query=mysqli_query($conn,$get_details);
				$get_orders_pending="Select * from user_orders where user_orders.user_id=user_table.user_id and user_orders.order_status='pending'"; //$user_id is from user_table
				$result_get_orders=mysqli_query($conn,$get_orders_pending);
				}

//searching products function
				function search_product(){
	$conn = mysqli_connect("localhost", "root", "", "bazbastore");
	if(isset($_GET['search_data_product'])){
		$search_data_value=$_GET['search_data'];
	$search_query="Select * from products where product_keywords like '%$search_data_value%'";
	$result_query=mysqli_query($conn,$search_query);
	$num_of_rows=mysqli_num_rows($result_query);
	if($num_of_rows==0){
		echo "<h2 class='text-center text-danger'>No results match. There is no data for this search</h2>";
	}
	$row=mysqli_fetch_assoc($result_query);
	while($row=mysqli_fetch_assoc($result_query)){
		$image=$row['image'];
		$title=$row['title'];
		$description=$row['description'];
		$price=$row['price'];
		$product_ID=$row['product_ID'];
		echo "<div class='col-md-8 mb-4'>
			<div class='card'>
				<img src='./images/$image' class='card-img-top' alt='...'>
			<div class='card-body'>
				<h5 class='card-title'>$title</h5>
				<p class='card-text'>$description</p><br>
				<p class='card-price'>Price:  $$price</p>
				<a href='bazba.php?add_to_cart=$product_ID' class='btn'>Add to Cart</a>
			</div>
			</div>
			</div>";
	}
		}
				}

?>