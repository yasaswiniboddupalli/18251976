<?php 
include('connSQL.php');
mysqli_select_db($connSQL, $database_connSQL);

if(isset($_POST['signup'])){
	$firstName=$_POST['firstName'];
	$lastName=$_POST['lastName'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$password1=$_POST['password1'];
	$sql="SELECT * FROM userTable where email='$email' ";
	$res=mysqli_query($connSQL, $sql) or die(mysqli_error($connSQL));
	if (mysqli_num_rows($sql)>0){
		$error="Sorry..Email already taken";
	}else{
	if($password == $password1) {
				//create user
				$password = sha1($password); //security
	$query="insert into userTable(firstName,lastName,email,password)values('$firstName','$lastName','$email','$password')";
	echo('inserted');
	if(!mysqli_query($connSQL,$query)){
		die('failed');
	}
	}else{
		echo "The two passwords do not match";
	}
	header("location:Signin.html");
	}
}
?>