<html>
<link rel="stylesheet" type="text/css" />
	<style type="text/css">
	
.btn {
	display: inline-block;
     background-color: #6fa8dc; 
     border: none;
     color: #ffffff;
     padding: 8px 30px;
     margin: 30px 0;
     border-radius: 0px;
     font-size: 15px;
     text-decoration: none;
     cursor: pointer;
}
.cart_image {
	width:80px;
	height: 80px;
}

	</style>
<?php require_once 'header.php'; 
?>
<?php
// cart();
// ?>
<h1><center>Shopping Cart</center></h1>
<!-----first child table----->
	<div class="container">
		<div class="row">
			<form action="" method="post">
			<table class="table table-bordered text-center">
				<thead>
					<tr>
						<th>Product Title</th>
						<th>Product Image</th>
						<th>Quantity</th>
						<th>Total Price</th>
						<th>Remove</th>
						<th colspan="2">Operations</th>
					</tr>
				</thead>
				<tbody>
					<!-----php to get ip-------->
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
echo 'User Real IP Address - '.$ip;  
	?>
	
				
					<!-----php code to display dynamic data----->
					<?php
				$conn = mysqli_connect("localhost", "root", "", "bazbastore");
				$ip=getIPAddress();
				$total=0;
				$cart_query="Select * from cart_details where ip_address='$ip'";
				$result=mysqli_query($conn, $cart_query);
				while($row=mysqli_fetch_array($result)){
					$product_id=$row['product_id'];
					$select_products="Select * from products where product_ID='$product_id'";
					$result_products=mysqli_query($conn, $select_products);
					while($row_product_price=mysqli_fetch_array($result_products)){
				//$quantities=(int)$_POST['quantity'];
				$product_price=array($row_product_price['price']);
				$price_table=$row_product_price['price'];
				$product_title=$row_product_price['title'];
				$product_image=$row_product_price['image'];
				//$product_values=array_sum($product_price*$quantities);
				//$total+=$product_values;
				
				echo $total;
		
					}	
				}
					?>
					<!-----php code to multiply price by quantity----->
					<tr>
						<td><?php echo $product_title ?></td>
						
		
						<td><img src="./images/<?php echo $product_image?>" alt="" class="cart_image"></td>
						<td><input type="text" name="quantity" value="" class="form-input w-40"></td>
						<p id="cost"></p>
						<?php $ip=getIPAddress();
						
						$conn = mysqli_connect("localhost", "root", "", "bazbastore");
						if(isset($_POST['update_cart'])){
							$product_id=$row['product_id'];
							$quantities=(int)$_POST['quantity'];
							$update_cart="update cart_details set quantity=$quantities where product_ID='$product_id'";
							$product_values=array_sum($product_price*$quantities);
							$total+=$product_values;
							//$result_products_quantity=mysqli_query($conn, $update_cart);	
							//$product_values=$result_products_quantity;
							
						//echo $total;
						}
						?>
					</tr>
					
					
						
					</tbody>	
			</table>
					
</HTML>