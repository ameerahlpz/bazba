<?php
include('../connect(2).php');
@session_start();
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
<body>

<?php
	require_once('header.php');
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
	<a href='.././user_area/user_login.php'>Login</a>
	</li>";
        }else{
        echo "<li class='nav-item'>
	<a href='.././user_area/logout.php'>Logout</a>
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
        ?>
        
	</ul>
</nav>

<!-------php code to access correct user ID-------->
           <?php
		   if(isset($_SESSION['user_name'])){
		   //$username=$_GET['user_name'];
		   $username=$_SESSION['user_name'];
//$user_name=$row['user_name'];
//$get_user="Select *  from user_table where user_name='$user_name'";
$get_user="Select *  from user_table where user_name='$username'";
$conn=mysqli_connect("localhost", "root", "", "bazbastore");
$result=mysqli_query($conn,$get_user);
$row=mysqli_fetch_array($result);
$user_id=$row['user_id'];
echo $user_id;
		   }
		   
				//SESSION['user_name'];
                //$get_user="Select *  from user_table where user_name='$username'";
                //$conn=mysqli_connect('localhost','root','','bazbastore');
                //$result=mysqli_query($conn,$get_user);
                //$row=mysqli_fetch_array($result);
                //$user_id=$row['user_id'];
                //echo $user_id
                ?>

<!-------php code to access user ID-------->
        <?php
        $user_ip=getIPAddress();
        $get_user="Select * from user_table where user_ip='$user_ip'";
        $conn = mysqli_connect('localhost','root','','bazbastore');
        $result=mysqli_query($conn,$get_user);
        $run_query=mysqli_fetch_array($result);
        $user_id=$run_query['user_id'];


				
        ?>

<div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
                <div class="col-md-6">
        <a href="https://www.paypal.com" target="_blank"><img src=".././images/upi.jpg" alt="PayPal"></a>
                </div>
                <div class="col-md-6">
        <a href="./order.php?user_id=<?php echo $user_id ?>"><h2 class="text-center">Pay Offline</h2></a>
                </div>
        </div>
</div>


</html>