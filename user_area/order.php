<?php
include('../connect(2).php');
@session_start();

if(isset($_GET['user_id'])){
$user_id=$_GET['user_id'];
echo "<script>$user_id</script>";
}
if(isset($_GET['product_id'])){
$product_id=$_GET['product_id'];
}
if(isset($_GET['quantity'])){
$quantity=$_GET['quantity'];
echo"<script>alert('$quantity');</script>";
}
//echo $invoice_number;

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

//getting total items and total price of all items and cart details query
         
$total_price=0;
$conn = mysqli_connect('localhost','root','','bazbastore');
$invoice_number=mt_rand();
$status='pending';

			$cart_query_price="SELECT products.title AS title_products, cart_details.product_id AS product_ID, cart_details.invoice_num AS invoice_num, cart_details.quantity AS quantity_products, cart_details.price AS price, cart_details.total AS total  
					FROM cart_details 
					INNER JOIN products ON
					cart_details.product_id = products.product_ID";


			//$cart_query_price="Select * from cart_details JOIN products ON cart_details.product_id=products.product_ID";	// where ip_address ='$get_ip_address'";
			$conn = mysqli_connect('localhost','root','','bazbastore');
			$result_cart_price=mysqli_query($conn,$cart_query_price);
			//$row_invoice_number=mysqli_fetch_assoc($result_cart_price);
			$count_products=mysqli_num_rows($result_cart_price);
			
			
			while($row_invoice_number=mysqli_fetch_assoc($result_cart_price)){
				$product_price=array($row_invoice_number['total']);
				$product_values=array_sum($product_price);
                $total_price+=$product_values;
				
				$title=$row_invoice_number['title_products'];
				$product_ID=$row_invoice_number['product_ID'];					//*******
				$invoice_number=$row_invoice_number['invoice_num'];
				$quantity=$row_invoice_number['quantity_products'];
				$price=$row_invoice_number['price'];
				$total=$row_invoice_number['total'];
				
                
                	//$product_ID=$row_invoice_number['product_id'];
					//$quantity=$row_invoice_number['quantity'];
                
                        
				
				
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


$insert_complete_orders="Select * from user_orders where user_id=$user_id";
$conn=mysqli_connect("localhost", "root", "", "bazbastore");
$result_orders=mysqli_query($conn,$insert_complete_orders);
$row_complete_orders=mysqli_fetch_assoc($result_orders);

while($row_complete_orders=mysqli_fetch_assoc($result_orders)){
			$order_id=$row_complete_orders['order_id'];
			$user_id=$row_complete_orders['user_id'];
			$status=$row_complete_orders['order_status'];
			$subtotal=$row_complete_orders['amount_due'];
}		
			
// $insert_complete_orders_products="Select * from products JOIN cart_details ON products.product_ID=cart_details.product_id";					//INNER JOIN cart_details ON products.product_ID=cart_details.product_id"; // AND products.title=cart_details.product_id";		
// $conn=mysqli_connect("localhost", "root", "", "bazbastore");
// $result_orders_products=mysqli_query($conn,$insert_complete_orders_products);


// while($row_complete_orders_products=mysqli_fetch_assoc($result_orders_products)){	//*
			// $product_ID=$row_complete_orders_products['product_ID'];
			// $title=$row_complete_orders_products['title'];


}
// complete orders

$insert_complete_orders_query="Insert into complete_orders (order_id, user_id, invoice_num, product_id, product_name, quantity, price, total, subtotal, order_date, status) values
($order_id, $user_id, $invoice_number, $product_ID, '$title', $quantity, $price, $total, $subtotal, NOW(),'$status')"; 
$check_query = "SELECT * FROM complete_orders WHERE order_id = $order_id AND product_id = $product_ID";
$conn=mysqli_connect('localhost','root','','bazbastore');												
$check_result = mysqli_query($conn, $check_query);

if(mysqli_num_rows($check_result) > 0) {
    // Record exists, handle accordingly (skip or update)
	echo"<script>alert('Order duplicated.  ')</script>";
} else {
    // Proceed with insertion
    $result_pending_orders = mysqli_query($conn, $insert_complete_orders_query);
}

// $insert_complete_orders_query="Insert into complete_orders (order_id, user_id, invoice_num, product_id, product_name, quantity, price, total, subtotal, order_date, status) values
// ($order_id, $user_id, $invoice_number, $product_ID, '$title', $quantity, $price, $total, $subtotal, NOW(),'$status')"; 	//FROM complete_orders INNER JOIN cart_details ON user_orders.order_id = complete_orders.order_id"; 	//complete_orders.invoice_num=cart_details.invoice_num"; //where complete_orders.product_id=cart_details.product_id	// where user_orders.order_id = complete_orders.order_id
//ON cart_details INNER JOIN complete_orders where complete_orders.product_id = cart_details.product_id";
// $conn=mysqli_connect('localhost','root','','bazbastore');
// $result_pending_orders=mysqli_query($conn,$insert_complete_orders_query);



if($result_query){
        echo"<script>alert('Orders are submitted successfuly. ')</script>";
        echo"<script>window.open('profile.php','_self')</script>";
		
}
	
						//}//*
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