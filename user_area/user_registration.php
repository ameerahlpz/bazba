<?php

include('../connect(2).php');

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

<!--------<h1>User Registration<h1>--------->
<div class="container-fluid m-3">
		
<h2 class="text-center">New User Registration Form</h2>
<div class="row d-flex align-items-center justify-content-center">

<div class="col-lg-12 col-xl-6">
<form action="" method="post" enctype="multipart/form-data">
<!------username field--------->
<div class="form-outline mb-4">
	<label form="user_name" class="form-label">Username</label>
	<input type="text" id="user_name" class="form-control" placeholder="Enter Your User Name" autocomplete="off" required="required" name="user_name"/>

</div>

<!------email field--------->
<div class="form-outline mb-4">
	<label form="user_email" class="form-label">User Email</label>
	<input type="email" id="user_email" class="form-control" placeholder="Enter Your Email" autocomplete="off" required="required" name="user_email"/>
</div>
<!------image field--------->
<div class="form-outline mb-4">
	<label form="user_image" class="form-label">User Image</label>
	<input type="file" id="user_image" class="form-control" required="required" name="user_userimage"/>
</div>
<!------password field--------->
<div class="form-outline mb-4">
	<label form="user_password" class="form-label">Password</label>
	<input type="password" id="user_password" class="form-control" placeholder="Enter Your Password" autocomplete="off" required="required" name="user_password"/>
</div>
<!------confirm password field--------->
<div class="form-outline mb-4">
	<label form="confirm_user_password" class="form-label">Confirm Password</label>
	<input type="password" id="confirm_user_password" class="form-control" placeholder="Confirm Password" autocomplete="off" required="required" name="confirm_user_password"/>
</div>
<!------address field--------->
<div class="form-outline mb-4">
	<label form="user_address" class="form-label">User Address</label>
	<input type="text" id="user_address" class="form-control" placeholder="Enter Your Address" autocomplete="off" required="required" name="user_address"/>
</div>
<!------contact field--------->
<div class="form-outline mb-4">
	<label form="user_contact" class="form-label">Contact</label>
	<input type="text" id="user_contact" class="form-control" placeholder="Enter Your Mobile Number" autocomplete="off" required="required" name="user_contact"/>
</div>
<div class="mt-4 pt-2">
	<input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
</div>
<h1 class="small mt-2 pt-1">
Already have an account?<a href="user_login.php">  Login</a></h1>

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

<!------php code for entering data----->
<?php
$conn = mysqli_connect('localhost','root','','bazbastore');
if(isset($_POST['user_register'])){
        $user_name=$_POST['user_name'];
        $user_email=$_POST['user_email'];
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        $user_password=$_POST['user_password'];
        $confirm_user_password=$_POST['confirm_user_password'];
        $user_address=$_POST['user_address'];
        $user_contact=$_POST['user_contact'];
        $user_ip=getIPAddress();
        //select query
        $select_query="Select * from user_table where user_name='$user_name' or user_email='$user_email'";
        $result=mysqli_query($conn,$select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0){
                echo "<script>alert ('Username or User Email already exists in database')</script>";
                }else if($user_password!=$confirm_user_password){
                echo "<script>alert ('Passwords do not match')</script>";
        }else{
        //insert query
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");
        $insert_query="insert into user_table (user_name,user_email,user_password,user_image,user_ip,user_address,user_mobile) values ('$user_name','$user_email','$user_password', '$user_image','$user_ip','$user_address','$user_contact')";
        $sql_execute=mysqli_query($conn, $insert_query);
		
		}
		//selecting cart items
        $select_cart_items="Select * from cart_details where ip_address='$user_ip'";
        $result_cart=mysqli_query($conn,$select_cart_items);
        $rows_count=mysqli_num_rows($result_cart);
        if($rows_count>0){
        echo "<script>alert ('You have items in the cart.')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
        }else{
        echo "<script>window.open('bazba.php','_self')</script>";
        }

        
}
?>