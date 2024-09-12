<?php

include('../connect(2).php');

@session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>User Login</title>
	<!-----bootstrBazba Theatrical Playersap css link------->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-----font awesome link----->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<!--------<h1>User Registration<h1>--------->
<div class="container-fluid m-3">
		
<h2 class="text-center">User Login</h2>
<div class="row d-flex align-items-center justify-content-center mt-5">

<div class="col-lg-12 col-xl-6">
<form action="" method="post" enctype="multipart/form-data">
<!------username field--------->
<div class="form-outline mb-4">
	<label form="user_name" class="form-label">Username</label>
	<input type="text" id="user_name" class="form-control" placeholder="Enter Your User Name" autocomplete="off" required="required" name="user_name"/>

</div>

<!------password field--------->
<div class="form-outline mb-4">
	<label form="user_password" class="form-label">Password</label>
	<input type="password" id="user_password" class="form-control" placeholder="Enter Your Password" autocomplete="off" required="required" name="user_password"/>
</div>

<div class="mt-4 pt-2">
	<input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login"/>
</div>
<h1 class="small mt-2 pt-1">
Don't have an account?<a href="../user_area/user_registration.php">  Register</a></h1>

</form>
</div>
</div>
</div>

</body>
</html>
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

<?php
if(isset($_POST['user_login'])){
        $conn = mysqli_connect('localhost','root','','bazbastore');
        $user_name=$_POST['user_name'];
        $user_password=$_POST['user_password'];
       echo $user_password;
        
        $select_query="select * from user_table where user_name='$user_name'";
        $result=mysqli_query($conn,$select_query);
        $row_count=mysqli_num_rows($result);
        $row_data=mysqli_fetch_assoc($result);
        $user_ip=getIPAddress();
	   echo $row_data['user_password'];
        
        //cart item
        $conn = mysqli_connect('localhost','root','','bazbastore');
        $select_query_cart="select * from cart_details where ip_address='$user_ip'";
        $select_cart=mysqli_query($conn,$select_query_cart);
        $conn = mysqli_connect('localhost','root','','bazbastore');
        $row_count_cart=mysqli_num_rows($select_cart);
               
        if($row_count>0){
                $_SESSION['user_name']=$user_name;
                if($user_password=$row_data['user_password']){
        echo"<script>alert('Login successful.')</script>";
                if($row_count==1 and $row_count_cart==0){
                $_SESSION['user_name']=$user_name;
                //if($row_count && $row_count_cart >0){
                echo"<script>alert('Login successful.')</script>";
                echo"<script>window.open('./profile.php','_self')</script>";
        }else{
                $_SESSION['user_name']=$user_name;
                echo"<script>alert('Login successful.')</script>";
                echo"<script>window.open('./profile.php','_self')</script>";
              }
        }else{
        echo"<script>alert('Invalid credentials. Username does not exist in database. Kindly register.')</script>";
        }
               }else{
        echo"<script>alert('Invalid credentials.')</script>";
        }
		}
        
?>

