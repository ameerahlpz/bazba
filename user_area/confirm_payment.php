<!---connect file--->
<?php
include('../connect(2).php');
@session_start();
        
//if(isset($_POST['confirm_payment'])){ 
  //          $invoice_number=$_POST['invoice_number'];
  //          $amount_due=$_POST['amount_due'];
  //          $order_id=$_POST['order_id'];
	//}   
if(isset($_GET['order_id'])){
        $order_id=$_GET['order_id'];
        $select_data="Select * from user_orders where order_id=$order_id";
        $conn = mysqli_connect('localhost','root','','bazbastore');
        $result=mysqli_query($conn,$select_data);
        $row=mysqli_fetch_assoc($result);
        $invoice_number=$row['invoice_num'];
        $amount_due=$row['amount_due'];
		echo $invoice_number;
		echo $amount_due;
		$order_id=$row['order_id'];
        }

if(isset($_POST['confirm_payment'])){
        $invoice_number=$_POST['invoice_number'];
		//$order_id=$_POST['order_id'];
        $amount_due=$_POST['amount'];
        $payment_mode=$_POST['payment_mode'];
        $insert_query="insert into orders (invoice_number, order_id, amount, payment_mode)  
        values ($invoice_number,$order_id,$amount_due,'$payment_mode')";
        $conn = mysqli_connect('localhost','root','','bazbastore');
        $result=mysqli_query($conn,$insert_query);
        if($result){
        	echo"<h3>Successfully Completed the Payment</h3>";
            echo"<script>window.open('profile.php', '_self')</script>";
        }
        $update_orders="update user_orders set order_status='Complete' where order_id=$order_id"; //need Incomplete turned to Complete and Confirm turned to Paid
		$conn = mysqli_connect('localhost','root','','bazbastore');
        $result_orders=mysqli_query($conn, $update_orders);
        
        }
		
	
	
		$get_user_order="Select * from user_orders where order_id=$order_id";   //need one line at a time
		$conn=mysqli_connect("localhost", "root", "", "bazbastore");
		$result=mysqli_query($conn,$get_user_order);
		$row=mysqli_fetch_assoc($result);
		//$order_id=$row['order_id'];
		$invoice_number=$row['invoice_num'];
		$amount_due=$row['amount_due'];
		echo $invoice_number;
		echo $amount_due;
		
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bazba Theatrical Players</title>
	<!-----bootstrap css link------->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-----font awesome link----->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-secondary">
	<h1 class="text-center text-light">Confirm Payment</h1>
	

	<div class="container my-5">
	<form action="" method="post">
	<div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number; ?>">
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                <label class=text-light>Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due; ?>">
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                	<select name="payment_mode" class="form-select w-50 m-auto">
                            <option>Select Payment Mode</option>
                            <option>Cash on Delivery</option>
                            <option>Pay Offline</option>
                            <option>PayPal</option>
                            <option>Wire Transfer</option>
                    </select>
                     
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                			<input type="submit" class="bg-info py-2 px-3 border-1" value="Confirm" name="confirm_payment">
                </div>
	</form></div>
</body>
</html>