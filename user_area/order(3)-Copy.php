<?php
include('../connect(2).php');
@session_start();

if(isset($_GET['user_id'])){
$user_id=$_GET['user_id'];
echo "<script>$user_id</script>";
}
?>
// <?php
// $conn = mysqli_connect('localhost','root','','bazbastore');
// function getIPAddress() {
    // whether ip is from the share internet
     // if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
                // $ip = $_SERVER['HTTP_CLIENT_IP'];
        // }
    // whether ip is from the proxy
    // elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                // $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
     // }
// whether ip is from the remote address
    // else{
             // $ip = $_SERVER['REMOTE_ADDR'];
     // }
     // return $ip;
// }
// $ip = getIPAddress();

// ?>
<?php
//getting total items and total price of all items

//$get_ip_address=getIPAddress();
// $total_price=0;
// $conn = mysqli_connect('localhost','root','','bazbastore');
// $invoice_number=mt_rand();
// $status='pending';
	// $select_product="Select * from cart_details";	// where cart_details.product_id = products.product_ID";
	// $run_price=mysqli_query($conn,$select_product);
        // while($row_product_price=mysqli_fetch_assoc($run_price)){
                // $product_price=array($row_product_price['total']);
				// $product_values=array_sum($product_price);
                // $total_price+=$product_values;
				// $invoice_number=$row_product_price['invoice_num'];
        //}

//getting quantity from cart

// $get_cart="select * from cart_details";
// $conn=mysqli_connect('localhost','root','','bazbastore');
// $run_cart=mysqli_query($conn,$get_cart);
// $get_item_quantity=mysqli_fetch_array($run_cart);
// $quantity=$get_item_quantity['quantity'];
// if($quantity==0){
// $quantity=1;
// $subtotal=$total_price;
// }else{
// $quantity=$quantity; 
// $subtotal=$total_price; 
// }

//getting total items and total price of all items
         
$total_price=0;
$conn = mysqli_connect('localhost','root','','bazbastore');
$invoice_number=mt_rand();
$status='pending';
			$cart_query_price="Select * from cart_details INNER JOIN products ON cart_details.product_id=products.product_ID";	// where ip_address ='$get_ip_address'";
			$conn = mysqli_connect('localhost','root','','bazbastore');
			$result_cart_price=mysqli_query($conn,$cart_query_price);
			$count_products=mysqli_num_rows($result_cart_price);
			while($row_invoice_number=mysqli_fetch_assoc($result_cart_price)){
				$product_price=array($row_invoice_number['total']);
				$product_values=array_sum($product_price);
                $total_price+=$product_values;
				$invoice_number=$row_invoice_number['invoice_num'];
				
								//getting quantity from cart
								
								$get_cart="select * from cart_details";
									$conn=mysqli_connect('localhost','root','','bazbastore');
									$run_cart=mysqli_query($conn,$get_cart);
									$get_item_quantity=mysqli_fetch_array($run_cart);
									$quantity=$get_item_quantity['quantity'];
									if($quantity==0){
									$quantity=1;
									$subtotal=$total_price;
									}else{
									$quantity=$quantity; 
									$subtotal=$total_price; 
									}

//orders pending

$insert_pending_orders="Insert into orders_pending (user_id, invoice_num, quantity, order_status) values
($user_id, $invoice_number, $quantity, '$status')";
$conn=mysqli_connect('localhost','root','','bazbastore');
$result_pending_orders=mysqli_query($conn,$insert_pending_orders);

//user orders

$insert_orders="insert into user_orders (user_id,amount_due,invoice_num,total_products,order_date,order_status) values
($user_id,$subtotal,$invoice_number,$count_products,NOW(),'$status')";
$conn=mysqli_connect('localhost','root','','bazbastore');
$result_query=mysqli_query($conn,$insert_orders);

//******

//where user_orders.order_id = orders_pending.order_id";

$insert_complete_orders="Select * from user_orders where user_id=$user_id";
$conn=mysqli_connect("localhost", "root", "", "bazbastore");
$result_orders=mysqli_query($conn,$insert_complete_orders);


while($row_complete_orders=mysqli_fetch_assoc($result_orders)){
			$order_id=$row_complete_orders['order_id'];
			$user_id=$row_complete_orders['user_id'];
			$status=$row_complete_orders['order_status'];
			$subtotal=$row_complete_orders['amount_due'];
}
		
$insert_complete_orders_cart_details="Select * from cart_details INNER JOIN products ON cart_details.product_id=products.product_ID";			// where user_id=$user_id";
$conn=mysqli_connect("localhost", "root", "", "bazbastore");
$result_orders_cart_details=mysqli_query($conn,$insert_complete_orders_cart_details);


while($row_complete_orders_cart_details=mysqli_fetch_assoc($result_orders_cart_details)){
			$invoice_number=$row_complete_orders_cart_details['invoice_num'];
			$product_ID=$row_complete_orders_cart_details['product_id'];
			$quantity=$row_complete_orders_cart_details['quantity'];
			$price=$row_complete_orders_cart_details['price'];
			$total=$row_complete_orders_cart_details['total'];
			
}			
			
$insert_complete_orders_products="Select * FROM products INNER JOIN cart_details ON products.product_ID=cart_details.product_id";		//*****
$conn=mysqli_connect("localhost", "root", "", "bazbastore");
$result_orders_products=mysqli_query($conn,$insert_complete_orders_products);


while($row_complete_orders_products=mysqli_fetch_assoc($result_orders_products)){
	
	for($i = 0; $i <($count_products['quantity']); $i++){	
			$product_ID=$row_complete_orders_products['product_ID'];
			$product_ID=$_POST['product_ID'][$i];
			$title=$row_complete_orders_products['title'];
			$title=$_POST['title'][$i];
			
}
		}
$insert_complete_orders_query="Insert into complete_orders (order_id, user_id, invoice_num, product_id, product_name, quantity, price, total, subtotal, order_date, status) values
($order_id, $user_id, $invoice_number, $product_ID, $title, $quantity, $price, $total, $subtotal, NOW(),'$status')";	// where user_orders.order_id = complete_orders.order_id

$conn=mysqli_connect('localhost','root','','bazbastore');
$result_pending_orders=mysqli_query($conn,$insert_complete_orders_query);


if($result_query){
        echo"<script>alert('Orders are submitted successfuly. ')</script>";
        echo"<script>window.open('profile.php','_self')</script>";
		
}
	
			}
//delete items from cart
$delete_cart_items="Update cart_details set product_id=0, ip_address=0, quantity=0, price=0, total=0";
$conn=mysqli_connect('localhost','root','','bazbastore');
$result_delete_cart=mysqli_query($conn,$delete_cart_items);

$delete_table_query="TRUNCATE TABLE cart_details";
$conn=mysqli_connect('localhost','root','','bazbastore');
$result_delete_table=mysqli_query($conn,$delete_table_query);


?>

<html>
<h2>Order Page</h2>
</html>