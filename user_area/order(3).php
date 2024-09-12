<?php
include('../connect(2).php');
@session_start();

if(isset($_GET['user_id'])){
$user_id=$_GET['user_id'];
echo "<script>$user_id</script>";
}
?>
<?php
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

$insert_orders="Insert into user_orders (user_id,amount_due,invoice_num,total_products,order_date,order_status) values
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
//select orders_pending TABLE

$select_orders_pending="Select * from orders_pending INNER JOIN user_orders ON orders_pending.order_id=user_orders.order_id";	// where user_id=$user_id";
$conn=mysqli_connect("localhost", "root", "", "bazbastore");
$result_pending_orders=mysqli_query($conn,$select_orders_pending);		
		
while($row_orders_pending=mysqli_fetch_assoc($result_pending_orders)){		
			$order_id=$row_orders_pending['order_id'];
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
		
	//for($i = 0; $i <($count_products($_POST['quantity'])); $i++){	
			$product_ID=$row_complete_orders_products['product_ID'];
			//$product_ID=$_POST['product_ID'][$i];
			$title=$row_complete_orders_products['title'];
			//$title=$_POST['title'][$i];
	}	
			// **$insert_table_to_table="Insert into complete_orders (complete_orders.order_id, complete_orders.user_id, complete_orders.product_id, complete_orders.invoice_num, complete_orders.product_name, complete_orders.quantity, complete_orders.price, complete_orders.total, complete_orders.subtotal, complete_orders.order_date,complete_orders.status) 
			// values ($order_id, $user_id,$product_ID, $invoice_number, '$title', $quantity, $price, $total, $subtotal,NOW(),'$status')";
			// $conn=mysqli_connect('localhost','root','','bazbastore');
			// $result_query=mysqli_query($conn,$insert_table_to_table);**

			
			
//}
		
	
// $insert_table_to_table="INSERT INTO complete_orders 
	// (complete_orders.order_id, complete_orders.user_id, complete_orders.product_id, complete_orders.invoice_num, complete_orders.product_name, complete_orders.quantity, complete_orders.price, complete_orders.total, complete_orders.subtotal, complete_orders.order_date,complete_orders.status) 
	// SELECT DISTINCT(user_orders.order_id) user_orders.order_id, $user_id, cart_details.product_id, cart_details.invoice_num, products.title, cart_details.quantity, cart_details.price, cart_details.total, user_orders.amount_due, NOW(),'$status'
	// FROM user_orders INNER JOIN (cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)ON user_orders.order_id='$order_id'";
	
			// $conn=mysqli_connect('localhost','root','','bazbastore');
			// $result_insert_table_to_table=mysqli_query($conn,$insert_table_to_table);
			
			
//$**insert_table_to_table="Insert into complete_orders (complete_orders.order_id, complete_orders.user_id, complete_orders.product_id, complete_orders.invoice_num, complete_orders.product_name, complete_orders.quantity, complete_orders.price, complete_orders.total, complete_orders.subtotal, complete_orders.order_date,complete_orders.status) 
			//SELECT DISTINCT($order_id) $order_id, $user_id, $product_ID, $invoice_number, '$title', $quantity, $price, $total, $subtotal,NOW(),'$status' 
			////FROM cart_details ORDER BY '$order_id'";
			//FROM cart_details INNER JOIN products ON cart_details.product_id=products.product_ID ORDER BY `$order_id`";		// cart_details.product_id ORDER BY `$order_id`, cart_details.product_id";	//";	// ORDER BY complete_orders.order_id";		//1
			//FROM user_orders INNER JOIN (cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)ON user_orders.order_id='$order_id'";
	
			////GROUP BY `order_id` ORDER BY 'order_id'
			
				
		// $insert_table_to_table="Insert into complete_orders (complete_orders.order_id, complete_orders.user_id, complete_orders.product_id, complete_orders.invoice_num, complete_orders.product_name, complete_orders.quantity, complete_orders.price, complete_orders.total, complete_orders.subtotal, complete_orders.order_date,complete_orders.status) 
			// SELECT $order_id, $user_id,cart_details.product_id, cart_details.invoice_num, products.title, cart_details.quantity, cart_details.price, cart_details.total, $subtotal,NOW(),'$status'
			// FROM user_orders INNER JOIN (cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)ON user_orders.order_id='$order_id' GROUP BY `order_id`, cart_details.product_id ORDER BY `order_id`, cart_details.product_id";	//";	// ORDER BY complete_orders.order_id";		//1
			////SELECT complete_orders.product_name FROM complete_orders GROUP BY 'product_name' ORDER BY 'product_name'";
			// $conn=mysqli_connect('localhost','root','','bazbastore');
			// $result_query=mysqli_query($conn,$insert_table_to_table);
			
			// SELECT DISTINCT ON (customer)
			// id, customer, total
			// FROM   purchases
			// ORDER  BY customer, total DESC, id;
			
		// $insert_table_to_table="Insert into complete_orders (complete_orders.order_id, complete_orders.user_id, complete_orders.product_id, complete_orders.invoice_num, complete_orders.product_name, complete_orders.quantity, complete_orders.price, complete_orders.total, complete_orders.subtotal, complete_orders.order_date,complete_orders.status) 
			// SELECT DISTINCT(complete_orders.product_id) $order_id, $user_id,cart_details.product_id, cart_details.invoice_num, products.title, cart_details.quantity, cart_details.price, cart_details.total, $subtotal,NOW(),'$status'
			// FROM cart_details INNER JOIN products ON cart_details.product_id=products.product_ID GROUP BY '$order_id'";//";	// ORDER BY complete_orders.order_id";		//2 Returns incriment without title, price and quantity
			// $conn=mysqli_connect('localhost','root','','bazbastore');
			// $result_query=mysqli_query($conn,$insert_table_to_table);
			
			
		$insert_table_to_table="Insert into complete_orders (complete_orders.order_id, complete_orders.user_id, complete_orders.product_id, complete_orders.invoice_num, complete_orders.product_name, complete_orders.quantity, complete_orders.price, complete_orders.total, complete_orders.subtotal, complete_orders.order_date,complete_orders.status) 
			SELECT $order_id, $user_id,cart_details.product_id, cart_details.invoice_num, products.title, cart_details.quantity, cart_details.price, cart_details.total, $subtotal,NOW(),'$status'
			FROM user_orders INNER JOIN (cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)ON user_orders.order_id='$order_id'";	// GROUP BY `order_id`, cart_details.product_id ORDER BY `order_id`, cart_details.product_id";	//";	// ORDER BY complete_orders.order_id";		//1  ***Gave 4 entries***
			
			//FROM cart_details INNER JOIN products ON cart_details.product_id=products.product_ID GROUP BY '$order_id' ORDER BY complete_orders.product_name";//";	// ORDER BY complete_orders.order_id";		//2 Returns incriment without title, price and quantity		// 0
			$conn=mysqli_connect('localhost','root','','bazbastore');
			$result_query=mysqli_query($conn,$insert_table_to_table);
		//$delete_duplicates="DELETE FROM complete_orders WHERE DUPLICATE product_id >1";//product_id = (SELECT DUPLICATE(product_id))";
				
				
				
	// $delete_duplicates="DELETE FROM complete_orders WHERE order_id NOT IN (
    // SELECT MAX(order_id)
    // FROM complete_orders
    // GROUP BY product_name AND HAVING COUNT(product_name)>1)";		//ON DUPLICATE KEY UPDATE order_id=VALUES(order_id+1)";   ***run this one***
	
	
	// $delete_duplicates="DELETE FROM complete_orders WHERE product_id NOT IN (
    // SELECT MAX(product_id)
    // FROM complete_orders
    // GROUP BY product_id AND HAVING COUNT(product_id)>1)";		//ON DUPLICATE KEY UPDATE order_id=VALUES(order_id+1)";		***downloaded Luis Skype*** ***run this next***
	
	//$delete_duplicates="SELECT * FROM complete_orders WHERE user_id NOT IN (SELECT MAX(user_id) FROM complete_orders GROUP BY product_name HAVING COUNT(*)>1)";		//   ***Run Select to show what will delete(all 4)***
	$delete_duplicates="SELECT * FROM complete_orders WHERE order_id NOT IN (SELECT MAX(order_id) FROM complete_orders GROUP BY order_id HAVING COUNT(*)=2)";
	
	//$delete_duplicates="SELECT * FROM complete_orders GROUP BY product_name HAVING COUNT(product_name)>1"; 
	
     
				//$delete_duplicates="DELETE FROM complete_orders HAVING COUNT(*) > 1"; 		//product_id = (SELECT DUPLICATE(product_id))";
//$delete_duplicates="DELETE FROM complete_orders WHERE order_id IN (SELECT order_id FROM complete_orders GROUP BY order_id HAVING COUNT(*)>1)";
				$conn=mysqli_connect('localhost','root','','bazbastore');
				$result_query=mysqli_query($conn,$delete_duplicates);	
			}
			
			
			// $delete_duplicates="DELETE FROM complete_orders WHERE product_id = (SELECT product_id FROM products) AND HAVING COUNT(product_id)>1";
// ok INSERT INTO complete_orders (product_id, product_name) SELECT product_id, product_name FROM complete_orders
			
					// DELETE FROM Table2 WHERE Id = (SELECT Id FROM Table1)
// INSERT INTO Table2 (Id, name) SELECT Id, name FROM Table1
		// $insert_table_to_table="Insert into complete_orders (complete_orders.order_id, complete_orders.user_id, complete_orders.product_id, complete_orders.invoice_num, complete_orders.product_name, complete_orders.quantity, complete_orders.price, complete_orders.total, complete_orders.subtotal, complete_orders.order_date,complete_orders.status) 
			// SELECT $order_id, $user_id,cart_details.product_id, cart_details.invoice_num, products.title, cart_details.quantity, cart_details.price, cart_details.total, $subtotal,NOW(),'$status'
			// FROM user_orders INNER JOIN (cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)ON user_orders.order_id='$order_id'"; 		//GROUP BY user_orders.order_id";//";	// ORDER BY complete_orders.order_id";		//3
			// $conn=mysqli_connect('localhost','root','','bazbastore');
			// $result_query=mysqli_query($conn,$insert_table_to_table);
			
		// $insert_table_to_table="Insert into complete_orders (complete_orders.order_id, complete_orders.user_id, complete_orders.product_id, complete_orders.invoice_num, complete_orders.product_name, complete_orders.quantity, complete_orders.price, complete_orders.total, complete_orders.subtotal, complete_orders.order_date,complete_orders.status) 
			// VALUES ($order_id, $user_id,cart_details.product_id, cart_details.invoice_num, products.title, cart_details.quantity, cart_details.price, cart_details.total, $subtotal,NOW(),'$status')
			// FROM user_orders INNER JOIN (cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)ON user_orders.order_id='$order_id'";		// GROUP BY user_orders.order_id";//";	// ORDER BY complete_orders.order_id";		//4
			// $conn=mysqli_connect('localhost','root','','bazbastore');
			// $result_query=mysqli_query($conn,$insert_table_to_table);
			
			
	$insert_table_to_table="INSERT INTO complete_orders_test (order_id,user_id,product_id,invoice_num,title,quantity,price,total,order_date,status)
		 SELECT DISTINCT user_orders.order_id, '$user_id', cart_details.product_id, cart_details.invoice_num, products.title, cart_details.quantity, cart_details.price, cart_details.total, NOW(),'$status'
	FROM user_orders INNER JOIN (cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)ON user_orders.order_id=$order_id ORDER BY user_orders.order_id asc";		// "; 	// 	
	
	
// $insert_table_to_table="INSERT INTO complete_orders_test (title,user_id,order_id, product_id,invoice_num,quantity,price,total,order_date,status)
	// VALUES ('$title', $user_id, $order_id, $product_ID,  $invoice_number, $quantity, $price, $total, NOW(),'$status') 		//ORDER BY products.product_ID";   //5 and 6 (before close bracket)
	// FROM user_orders INNER JOIN (cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)ON user_orders.order_id='$order_id'";	// ORDER BY user_orders.order_id asc";	

// FROM user_orders AS t1
// INNER JOIN cart_details AS t2
// INNER JOIN products AS t3
// INNER JOIN orders_pending AS t4
// ON t2.product_id=t3.product_ID 
// ON t1.order_id=$order_id";
// GROUP BY orders_pending.order_id";

//$insert_table_to_table="INSERT INTO complete_orders_test 
		   // (complete_orders_test.order_id, complete_orders_test.user_id, complete_orders_test.product_id, complete_orders_test.invoice_num, complete_orders_test.title, complete_orders_test.quantity, complete_orders_test.price, complete_orders_test.total, complete_orders_test.order_date,complete_orders_test.status) 
	// SELECT user_orders.order_id, $user_id, cart_details.product_id, cart_details.invoice_num, products.title, cart_details.quantity, cart_details.price, cart_details.total, NOW(),'$status'
	// FROM user_orders INNER JOIN orders_pending ON user_orders.order_id=orders_pending.order_id INNER JOIN(cart_details INNER JOIN products ON cart_details.product_id=products.product_ID) WHERE user_orders.order_id=orders_pending.order_id"; 	
	
//$insert_table_to_table="INSERT INTO complete_orders 
	//	   (complete_orders.order_id, complete_orders.user_id, complete_orders.product_id, complete_orders.invoice_num, complete_orders.product_name, complete_orders.quantity, complete_orders.price, complete_orders.total, complete_orders.subtotal, complete_orders.order_date,complete_orders.status) 
	//SELECT user_orders.order_id, $user_id, cart_details.product_id, cart_details.invoice_num, products.title, cart_details.quantity, cart_details.price, cart_details.total, user_orders.amount_due, NOW(),'$status'
	//FROM user_orders INNER JOIN (cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)ON user_orders.order_id='$order_id'";
	//FROM user_orders INNER JOIN orders_pending ON user_orders.order_id=orders_pending.order_id INNER JOIN(cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)";		// WHERE user_orders.order_id=orders_pending.order_id"; 	
	
							// $conn=mysqli_connect('localhost','root','','bazbastore');
							// $result_insert_table_to_table=mysqli_query($conn,$insert_table_to_table);
			

if($result_query){
        echo"<script>alert('Orders are submitted successfuly. ')</script>";
        echo"<script>window.open('profile.php','_self')</script>";
		
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