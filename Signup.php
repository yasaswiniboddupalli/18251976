<?php 
if(isset($_POST['firstname'])){
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
		/*echo "<h3>successfully inserted</h3>";
		$_SESSION['message'] = "you are now logged in";
				$_SESSION['firstname'] = $firstname;
				header("location: home1.php"); */
	}
	}else{
		echo "The two passwords do not match";
	}
}

?>