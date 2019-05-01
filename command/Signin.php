<?php
include('../../Connections/connSQL.php');
//this file foucs on signin function
if(isset($_POST['email'])){
	$email=$_POST['email'];
	$password=sha1($_POST['password']);
  
	if(mysqli_num_rows(mysqli_query($connSQL,"SELECT * FROM userTable where email= '$email' AND password= '$password'")))
	{

				$_SESSION["email"]=$email;

				header('location:../Dashboard.php');

	}else{
		//false information
		echo "<b> Email id or password is invaid</b>";
	}


}
?>

