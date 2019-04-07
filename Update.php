<?php 
echo 'Hello';
include('dbcon.php');
echo 'Hello6';
if(isset($_POST['Update'])){
	$email=$_POST['email'];
	$password=$_POST['password'];
	$password1=$_POST['password1'];
	echo 'Hello';
	if($password == $password1) {
				//create user
				$password = sha1($password); //security
	$sql = "UPDATE users SET password='$password' WHERE email='$email'";
	echo 'Hello1';

if ($con->query($sql) === TRUE) {
    echo "Record updated successfully";
	header("location:Dashboard.html");
} else {
    echo "Error updating record: " . $con->error;
}
	}
}
?>