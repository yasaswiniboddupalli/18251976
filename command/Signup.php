
<?php
include('../Connections/connSQL.php');
mysqli_select_db($connSQL, $database_connSQL);
$emailError ="";
$accountCreated ="";
$passwordDoesNotMatch="";


if(isset($_POST['signup'])){
	$firstName=$_POST['firstName'];
	$lastName=$_POST['lastName'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$password1=$_POST['password1'];
	$sql="SELECT * FROM userTable where email='$email' ";
	$res=mysqli_query($connSQL, $sql) or die(mysqli_error($connSQL));

	if (mysqli_num_rows($res)>0){

		$emailError="Email-id already exsists.";

	}else{
	if($password == $password1 && strlen($password) >8) {
				//create user
				$password = sha1($password); //security
	$query="insert into userTable(firstName,lastName,email,password)values('$firstName','$lastName','$email','$password')";

$accountCreated = "Account Created Successfully";


	if(!mysqli_query($connSQL,$query)){
		die('failed');
	}
	}else{

$passwordDoesNotMatch = "The passwords does not match";

	}

	//header("location:Signin.html");
	}
}
?>

<html>
<input id="test1" value="<?=$emailError;?>" hidden>
<input id="test2" value="<?=$accountCreated;?>" hidden>
<input id="test3" value="<?=$passwordDoesNotMatch;?>" hidden>
</html>
<script>
	test =document.getElementById('test1').value;
	if(test!=""){
	alert(test);
}

	test=document.getElementById('test2').value;
	if(test!=""){
	alert(test);
}

	test=document.getElementById('test3').value;
	if(test!=""){
	alert(test);
}
	window.location.href = "Signup.html";
</script>
