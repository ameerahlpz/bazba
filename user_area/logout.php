<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
//session_start();
session_unset();
session_destroy();
//header('location:../bazba.php');
echo "<script>window.open('../bazba.php','_self')</script>";
?>
</body>
</html>
        