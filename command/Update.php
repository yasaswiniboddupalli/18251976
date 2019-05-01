<?php 
echo 'Hello';
require_once('../../Connections/connSQL.php');

if(isset($_POST['Update'])){
	$userID=$_GET['userID'];
	//$email=$_POST['email'];
	$pwd_new=$_POST['pwd_new'];
	$pwd_origin=$_POST['pwd_origin'];
	$lastName=$_POST['lastName'];
	$firstName=$_POST['firstName'];
	//$password1=$_POST['password1'];
	
	$sql = "SELECT * FROM userTable WHERE userID = '$userID'";
	$result = $connSQL->query($sql);
	$row = $result->fetch_assoc();
	$pwd_origin = sha1($pwd_origin); //security
	if($pwd_origin == $row['password']) {
		//create user
		$password = sha1($pwd_new); //security
		$sql = "UPDATE userTable SET firstName='$firstName', lastName='$lastName', password='$password' WHERE userID='$userID'";
		//echo '1';
		if ($connSQL->query($sql) === TRUE) {
			echo "Record updated successfully";
			header("location:../Dashboard.php");
			//return;
		} else {
			echo "Error updating record: " . $connSQL->error;
		}
	}
}
?>