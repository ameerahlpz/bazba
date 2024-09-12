<!----connect file----->
<?php
include('../connect(2).php');
include('../common_function.php');

 
 
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

if(isset($_GET['user_id'])){
$user_id=$_GET['user_id'];
echo $user_id;
 } 

 
        $user_ip=getIPAddress();
        $get_user="Select user_ip from user_table";	// where user_id='$user_id'"; 	// where user_ip='$user_ip'";
        $conn = mysqli_connect('localhost','root','','bazbastore');
        $result=mysqli_query($conn,$get_user);
		while($run_query=mysqli_fetch_array($result)){
				//$user_id=$run_query['user_id'];
				$user_ip=$run_query['user_ip'];
		}
		// echo $user_ip;

if(isset($_GET['user_id'])){
	$user_id=$_GET['user_id'];  //2
}
@session_start();
?>
<HTML lang="en">
<HEAD>
<meta charset="utf-8">
	<title>Bazba Profile Page</title>
	<!-----bootstrap css link------->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-----font awesome link----->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-----header----->
        <div id="wrap">
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
	<a href='./user_login.php'>Login</a>
	</li>";
        }else{
        echo "<li class='nav-item'>
	<a href='./logout.php'>Logout</a>
	</li>";
        
        }
		?>
	</ul>
	</nav>
	<table>
    <tr>
	
    <td width=25%>
            <div id="header">
    <img id="logo" alt="Bazba Theatrical Players" src="../images/bazba_logo.jpg" style="width:75%"/>
            </div>
    <td width=75%>
            <div id="header">
    <img id="logo" alt="Bazba Theatrical Players" src="../images/Bazba_Theatrical_Players.jpg" style="width:100%"/>
            </div>
    </tr>
    </table></div>
	<style>
img {
  float: right;
  max-width: 100%;
  height: auto;
  image-rendering: pixelated;
  image-rendering: -moz-crisp-edges;
  image-rendering: crisp-edges;
  width:80px;
  height: 80px;
}
</style></HEAD>
<BODY>
<?php
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
 
 if(isset($_SESSION['user_name'])){
        $user_name=$_SESSION['user_name'];
        $user_image="Select * from user_table where user_name='$user_name'";
        $conn=mysqli_connect("localhost", "root", "", "bazbastore");
        $user_image=mysqli_query($conn,$user_image);
        $row_image=mysqli_fetch_array($user_image);
        $user_image=$row_image['user_image'];
        echo"<ul class='nav navbar-nav'><li class='nav-item'><img src='../images/$user_image' class='profile_img my-4'></li></ul>";
 }
?>
<h4><p><center>Profile Page</center></p></h4>
</BODY>
<table class="table table-bordered mt-5 striped">
<thead class="bg-info">
<tr>
<th>User Id</th>
<th>Subtotal</th>
<th>Invoice Number</th>
<th>Total Products</th>
<th>Order Date</th>
<th>Complete/Incomplete</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php

$get_order_details="Select * from user_orders where user_id=$user_id";
$conn=mysqli_connect("localhost", "root", "", "bazbastore");
$result_orders=mysqli_query($conn,$get_order_details);


$number=1;
while($row_orders=mysqli_fetch_assoc($result_orders)){
			$order_id=$row_orders['order_id'];
			$amount_due=$row_orders['amount_due'];
			$invoice_number=$row_orders['invoice_num'];
			$total_products=$row_orders['total_products'];
			$order_status=$row_orders['order_status'];
			if($order_status=='pending'){
					$order_status='Incomplete';
				}else{
					$order_status='Complete';
				}
			$order_date=$row_orders['order_date'];
			
			echo "<tr>
				<td>$number</td>
				<td>$amount_due</td>
				<td>$invoice_number</td>
				<td>$total_products</td>
				<td>$order_date</td>
				<td>$order_status</td>";
				?>
				<?php
				if($order_status=='Complete'){
				echo "<td>Paid</td>";
				}else{
				echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td></tr>";
				}
				
				
			$number++;
}
?>


</tbody>

</table>
</HTML>
