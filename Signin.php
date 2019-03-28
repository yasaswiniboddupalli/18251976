
<?php
include('dbcon.php');
if(isset($_POST['email'])){
	$email=$_POST['email'];
	$password=sha1($_POST['password']);

if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM users where email= '$email' AND password= '$password'")))
{
	//correct information
	$result=mysqli_query($con,"SELECT * FROM users where email='$email' AND password='$password'");
	while($row = mysqli_fetch_array($result))
	{
		header("location:user_dashboard.html");
		
	}
	
	
	
	
}else{
	//false information
	echo "<b> email or password invaid</b>";
}
	
	
	//mysql_close($con);
	
	
}

?>
