<?php 
echo 'Hello';
require_once('../../Connections/connSQL.php');

if(isset($_POST['Update'])){
	$email=$_POST['email'];
	$password=$_POST['password'];
	$password1=$_POST['password1'];
	
	if($password == $password1) {
		//create user
		$password = sha1($password); //security
		$sql = "UPDATE userTable SET password='$password' WHERE email='$email'";
		echo '1';
		if ($connSQL->query($sql) === TRUE) {
			echo "Record updated successfully";
			header("location:../Dashboard.php");
		} else {
			echo "Error updating record: " . $connSQL->error;
		}
	}
}
?>