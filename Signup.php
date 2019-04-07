<?php 
include('dbcon.php');
if(isset($_POST['signup'])){
	include('dbcon.php');
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$password1=$_POST['password1'];
	if($password == $password1) {
				//create user
				$password = sha1($password); //security
	$query="insert into users(firstname,lastname,email,password)values('$firstname','$lastname','$email','$password')";
	echo('inserted');
	if(!mysqli_query($con,$query)){
		die('failed');
	}
	}else{
		echo "The two passwords do not match";
	}
	header("location:Signin.html");
}

?>