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
	<?php require_once 'header.php';?>

<h1><center>Shopping Cart</center></h1>
<!-----first child table----->
	<div class="container">
		<div class="row">
			<form action="" method="post">
			<table class="table table-bordered text-center">
				
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
				$result_count=mysqli_num_rows($result);
				if($result_count>0){
				echo "<thead>
					<tr>
						<th>Product Title</th>
						<th>Product Image</th>
						<th>Quantity</th>
						<th>Total Price</th>
						<th>Remove</th>
						<th colspan='2'>Operations</th>
					</tr>
				</thead>
				<tbody>";
					

				$index = 0;
				while($row=mysqli_fetch_array($result)){
					$product_id=$row['product_id'];
					$select_products="Select * from products where product_ID='$product_id'";
					$result_products=mysqli_query($conn, $select_products);
					while($row_product_price=mysqli_fetch_array($result_products)){
				$product_price=array($row_product_price['price']);
				$price_table=$row_product_price['price'];
				$product_title=$row_product_price['title'];
				$product_image=$row_product_price['image'];
				$product_values=array_sum($product_price);
						
					$quantity_query="Select * from cart_details where product_ID='$product_id'";
					$result_cards=mysqli_query($conn, $quantity_query);
					$quantity = 0;
						while($row_card=mysqli_fetch_array($result_cards)){
						$quantity = $row_card['quantity'];
				}
				$total+=$product_values * $quantity;
						
				?>
					<!-----php code to display dynamic data----->
					<tr>
						<td><?php echo $product_title ?></td>
						<td><img src="./images/<?php echo $product_image?>" alt="" class="cart_image"></td>
						
						<!-----<td><img src="./user_images/</?php echo $image?>" alt="" class="cart_image"></td>
                                                <td><img src="<?php echo './user_images/$image'?>" alt="" class="cart_image"></td>						
                                                <td><img src="./user_images/<?php echo $product_image?>" alt="" class="cart_image"></td>----->
						
                                                <td>
                                                        <input type="number" name="quantity[]" value=<?php echo isset($_POST['quantity'])?$_POST['quantity'][$index] : $quantity ?> class="form-input w-40">
                                                        <input type="hidden" name="price[]" value=<?php echo $product_values ?> class="form-input w-40">
                                                        <input type="hidden" name="product[]" value=<?php echo $product_id ?> class="form-input w-40">
                                                </td>
					<!------php to update cart-------->
						<?php $ip=getIPAddress();	
							$conn = mysqli_connect("localhost", "root", "", "bazbastore");
						if(isset($_POST['update_cart'])){
							$total = 0;
							$invoice_number=mt_rand();
							for($i = 0; $i <count($_POST['quantity']); $i++){							// echo($_POST['quantity'][$i]);

                                                                $total+=$_POST['quantity'][$i]*$_POST['price'][$i];
                                                                $quantity = $_POST['quantity'][$i];
									$price=$_POST['price'][$i];
                                                                $productId = $_POST['product'][$i];
                                                                $update_price="update cart_details set price=$price where product_ID='$productId'";
                                    $result_price=mysqli_query($conn,$update_price);
                                    
                                    							$update_cart="update cart_details set invoice_num=$invoice_number, quantity=$quantity where product_ID='$productId'";
                                                                $result_products_quantity=mysqli_query($conn,$update_cart);
                                    
                                    $update_total="update cart_details set total=$price*$quantity where product_ID='$productId'";
                                    $result_total=mysqli_query($conn,$update_total);
									}
                                                }
						//echo $total
						?>
						<td>$ <?php echo $price_table?></td>
						<td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id?>"></td>
						<td>
							<!---<button class="btn">Update</button>--->
							<input type="submit" value="Update Cart" class="btn" name="update_cart">
							<!---<button class="btn">Remove</button>--->
							<input type="submit" value="Remove" class="btn" name="remove_cart">
						</td>
					</tr>
					<?php	}
                                        $index++;
                                        }}
					else{
						echo "<h2><center>Cart is Empty</center></h2>";
					}?>	
				</tbody>
				</table>
					
				
			<!-----subtotal----->
			<div>
			<?php
			
			$ip=getIPAddress();
				$cart_query="Select * from cart_details where ip_address='$ip'";
				$result=mysqli_query($conn, $cart_query);
				$result_count=mysqli_num_rows($result);
				if($result_count>0){
				echo "<h4 class='px-3'>Subtotal: $ <strong>$total</strong></h4><br>
				<input type='submit' value='Continue Shopping' class='btn' name='continue_shopping'>
				<input type='submit' value='Check Out' class='btn' name='checkout'>";
				}else{
					echo "<input type='submit' value='Continue Shopping' class='btn' name='continue_shopping'>";
				}
				if(isset($_POST['continue_shopping'])){
					echo "<script>window.open('bazba.php','_self')</script>";
				}
				if(isset($_POST['checkout'])){
					echo "<script>window.open('checkout.php','_self')</script>";
				}
			
			?>
			
				
			</div>
		</div>
	</div>
</form>
<!----function to remove items----->
		<?php
		function remove_cart_item(){
			$conn = mysqli_connect("localhost", "root", "", "bazbastore");
			if(isset($_POST['remove_cart'])){
			foreach($_POST['removeitem']as $remove_id){
				echo $remove_id;
				$delete_query="Delete from cart_details where product_id=$remove_id";
				$result_delete_product=mysqli_query($conn, $delete_query);
			if($result_delete_product){
				echo "<script>window.open('cart.php','_self')</script>";
							}
		
			}
			}
		}
		
		echo $remove_item=remove_cart_item();
		?>
</html>



							