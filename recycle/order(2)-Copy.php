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
$total_price=0;
$conn = mysqli_connect('localhost','root','','bazbastore');
$invoice_number=mt_rand();
$status='pending';
	$select_product="Select * from cart_details";	// where cart_details.product_id = products.product_ID";
	$run_price=mysqli_query($conn,$select_product);
        while($row_product_price=mysqli_fetch_assoc($run_price)){
                $product_price=array($row_product_price['total']);
				$product_values=array_sum($product_price);
                $total_price+=$product_values;
				$invoice_number=$row_product_price['invoice_num'];
        }

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
$quantity=$quantity;// 
$subtotal=$total_price;// 
}
         

			$cart_query_price="Select * from cart_details";	// where ip_address ='$get_ip_address'";
			$conn = mysqli_connect('localhost','root','','bazbastore');
			$result_cart_price=mysqli_query($conn,$cart_query_price);
			$count_products=mysqli_num_rows($result_cart_price);
			while($row_invoice_number=mysqli_fetch_assoc($result_cart_price)){
				$invoice_number=$row_invoice_number['invoice_num'];

//orders pending

$insert_pending_orders="Insert into orders_pending (user_id, invoice_num, quantity, order_status) values
($user_id, $invoice_number, $quantity, '$status')";
$conn=mysqli_connect('localhost','root','','bazbastore');
$result_pending_orders=mysqli_query($conn,$insert_pending_orders);




$insert_orders="insert into user_orders (user_id,amount_due,invoice_num,total_products,order_date,order_status) values
($user_id,$subtotal,$invoice_number,$count_products,NOW(),'$status')";
$conn=mysqli_connect('localhost','root','','bazbastore');
$result_query=mysqli_query($conn,$insert_orders);


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

//table with complete orders


$insert_complete_orders="Insert into complete_orders (order_id, user_id, invoice_num, product_id, product_name, quantity, product_price, total, subtotal, order_status) values
($order_id, $user_id, $invoice_number, $product_ID, '$title', $quantity, $price, $total, $subtotal, '$status') where user_orders.order_id = complete_orders.order_id";
$conn=mysqli_connect('localhost','root','','bazbastore');
$result_pending_orders=mysqli_query($conn,$insert_complete_orders);

$update_complete_orders="update complete_orders set subtotal=$subtotal"; //where cart_details.invoice_num=user_orders.invoice_num";
	$conn=mysqli_connect('localhost','root','','bazbastore');
	$result_complete_orders=mysqli_query($conn,$update_complete_orders);
	$row=mysqli_fetch_array($result_complete_orders)
			//$order_id=$row['order_id'];
			//$user_id=$row['user_id'];
			//$invoice_number=$row['invoice_num'];
			//$subtotal=$row['subtotal'];
 

// $complete_orders_query ="UPDATE complete_orders SET
																			//where user_orders.order_id = complete_orders.order_id";
  // user_orders.user_id = user_id,
   // cart_details.invoice_num = invoice_num,
   // cart_details.product_id = product_id,
   // products.title = 'product_name', 
   // cart_details.quantity = quantity,
   // cart_details.price = price, 
   // array_sum(cart_details.total) = subtotal,
   // user_orders.order_status = 'status'
 //SELECT cat_details.order_id, cart_details.user_id,cart_details.invoice_num, cart_details.product_id, cart_details.quantity, cart_details.price 
 
  // FROM 
    // cart_details.invoice_num INNER JOIN 	//.invoice_num
      // (cart_details INNER JOIN 
        // products
      // ON cart_details.product_id = products.product_ID) 
    // ON user_orders.invoice_num"; 	//= cart_details.invoice_num";

$complete_orders_query="INSERT INTO complete_orders (order_id,
 user_id,invoice_num,product_id,product_name,quantity,price,subtotal,
   status) values (SELECT user_orders.order_id,user_orders.user_id,
   cart_details.invoice_num,cart_details.product_id,products.title,cart_details.quantity,
   cart_details.price, cart_details.total,user_orders.order_status) FROM cart_details.invoice_num INNER JOIN user_orders.invoice_num";
   
   
   // SELECT cart_details.order_id, cart_details.user_id, cart_details.invoice_num, cart_details.product_id, cart_details.quantity, cart_details.price FROM cart_details.product_id INNER JOIN products.product_ID ON cart_details.invoice_num = user_orders.invoice_num




?>

<html>
<h2>Order Page</h2>
</html>