<?php
include('connect(2).php');
@session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bazba Payment</title>
	<!-----bootstrap css link------->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-----font awesome link----->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
  <style>
    .cart_image {
	width:80px;
	height: 80px;
	}
  </style>
<body>

<?php
	require_once './header.php';
?>
 <nav class="navbar navbar-expand-lg navbar-light bg-purple">
	<ul class="navbar-nav me-auto">
	
        
          <?php
        
        if(!isset($_SESSION['user_name'])){
        echo"<li class='nav-item'>
		<a class='nav-link' href='#'><p style='color:blue;'>Welcome Guest</p></a>
	</li>";
        }else{
        echo "<li class='nav-item'>
	<a class='nav-link' href='#'><p style='color:blue;'>Welcome ".$_SESSION['user_name']."</p></a>
	</li>";
        
        }
        
        
        ?>
	  <?php
        if(!isset($_SESSION['user_name'])){
        echo"<li class='nav-item'>
	<a href='./user_area/user_login.php'>Login</a>
	</li>";
        }else{
        echo "<li class='nav-item'>
	<a href='./user_area/logout.php'>Logout</a>
	</li>";
        
        }
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

//echo $ip;  

if(isset($_GET['user_id'])){
$user_id=$_GET['user_id'];
//echo $user_id;	
 } 

if(isset($_GET['invoice_num'])){
$invoice_number=$_GET['invoice_num'];
//echo $invoice_number;
}
 
 if(isset($_SESSION['user_name'])){
$username=$_SESSION['user_name'];
//$user_name=$row['user_name'];
//$get_user="Select *  from user_table where user_name='$user_name'";
$get_user="Select *  from user_table where user_name='$username'";
$conn=mysqli_connect("localhost", "root", "", "bazbastore");
$result=mysqli_query($conn,$get_user);
while($row=mysqli_fetch_array($result)){
$user_id=$row['user_id'];
$user_ip=$row['user_ip'];
}
//echo $user_id;   
//echo $user_ip;   
}
        ?>
        
	</ul>
</nav>

<!-------php code to access user ID-------->
        <?php
        // $user_ip=getIPAddress();
        // $get_user="Select * from user_table";  	// where user_ip='$user_ip'";
        // $conn = mysqli_connect('localhost','root','','bazbastore');
        // $result=mysqli_query($conn,$get_user);
        //$run_query=mysqli_fetch_assoc($result);									//*********
		// while($run_query=mysqli_fetch_assoc($result)){
				// $user_id=$run_query['user_id'];
				// $user_ip=$run_query['user_ip'];
		// }
// echo $user_ip;
				
		// $user_ip=getIPAddress();
        // $get_user="Select * from user_table where user_ip='$user_ip'";
        // $conn = mysqli_connect('localhost','root','','bazbastore');
        // $result=mysqli_query($conn,$get_user);
        // $run_query=mysqli_fetch_array($result);
				// $user_id=$run_query['user_id'];
				// echo $user_id;
        ?>

<div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
                <div class="col-md-6">
        <a href="https://www.paypal.com" target="_blank"><img src="./images/upi.jpg" alt="PayPal"></a>
                </div>
                <div class="col-md-6">
        <a href="./user_area/order(5).php?user_id=<?php echo $user_id?>"><h2 class="text-center">Pay Offline</h2></a>
                </div>
        </div>
</div>
			<!-------<?php echo $user_id ?>-------->
  <!----------invoice-------->
	<h2 class="text-center text-info">Review Your Order</h2>
	<h3>Invoice Number</h3>
            
            <?php
			
		$select_invoice_number_query = "SELECT invoice_num	FROM cart_details";
		$conn = mysqli_connect("localhost", "root", "", "bazbastore");
				$result_invoice_number_query=mysqli_query($conn,$select_invoice_number_query);
				$row_select_invoice_number=mysqli_fetch_assoc($result_invoice_number_query);
				$invoice_number=$row_select_invoice_number['invoice_num'];
				
            
     	$total_invoice_num_query = "SELECT amount_due, invoice_num, order_date FROM user_orders";
            $conn = mysqli_connect("localhost", "root", "", "bazbastore");
            $result_total_invoice_num_query=mysqli_query($conn,$total_invoice_num_query);
            echo $invoice_number;
				while($row_total_invoice_num=mysqli_fetch_assoc($result_total_invoice_num_query)){
				$amount_due=$row_total_invoice_num['amount_due'];	
				$invoice_number=$row_total_invoice_num['invoice_num'];
				$order_date=$row_total_invoice_num['order_date'];
				}	
            
           ?>
        <table class="table table-bordered mt-5 striped">
                <?php
				
                echo"<br><br>";
                echo "Today is " . date("Y-m-d") . "<br>";
				echo "The time is " . date("h:i:sa"). "<br>";
				?>
                <br>
                <thead class="bg-info">
                <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Cost</th>
                <th>Quantity</th>
                <th>Total</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
<?php     
    
         $get_order_receipt="SELECT products.title AS title, products.image AS image, cart_details.price AS price, cart_details.quantity AS quantity, cart_details.total AS total  
		FROM cart_details 
		INNER JOIN products ON
		cart_details.product_id = products.product_ID";
                        $conn = mysqli_connect("localhost", "root", "", "bazbastore");
                        $result_orders=mysqli_query($conn,$get_order_receipt);
            			//$index=0;
            	$total_amount=array();         															
        while($row_receipt=mysqli_fetch_assoc($result_orders)){
                ?><?php
                        $title=$row_receipt['title'];
                        $product_image=$row_receipt['image'];
                        $price=$row_receipt['price'];	
                        $quantity=$row_receipt['quantity'];
                        $total=$row_receipt['total'];
                        echo "<tr>
                        <td>$title</td>
                        <td><img src='images/$product_image' alt='' class='cart_image'></td>
                        <td>$price</td>
                        <td>$quantity</td>
                        <td>$total</td>
                        <tr>";
		       
            ?>
            <?php
                
             $total_amount[] = $row_receipt['total'];
                }
    echo '<h4>Grand Total: $'.array_sum($total_amount).'</h4><br>';
                
            
	?>
	<br><button href="#" type="button" class="btn btn-info my-4">Print</button></br>

</html>