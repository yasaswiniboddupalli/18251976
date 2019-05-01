<?php
include('../../Connections/connSQL.php');
if(isset($_POST['email'])){
	$email=$_POST['email'];
	$password=sha1($_POST['password']);
  
	if(mysqli_num_rows(mysqli_query($connSQL,"SELECT * FROM userTable where email= '$email' AND password= '$password'")))
	{
		/*
		//correct information
		$result=mysqli_query($connSQL,"SELECT * FROM userTable where email='$email' AND password='$password'");
		while($row = mysqli_fetch_array($result))
		{
			$sql= "SELECT * FROM userTable where email='$email' && password='$password'";
			$rowcount = $connSQL->query($sql);
			$rowco=mysqli_num_rows($rowcount);
			$row1 = mysqli_fetch_assoc($rowcount);

			if($rowco==true)
			{
		*/
				$_SESSION["email"]=$email;
			   //header('location:user_dashboard.php');
				header('location:../Dashboard.php');
		//	}
		//}	
	}else{
		//false information
		echo "<b> email or password invaid</b>";
	}
	  //mysql_close($con);		

}
?>

