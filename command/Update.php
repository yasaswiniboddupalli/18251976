<?php 
echo 'Hello';
require_once('../../Connections/connSQL.php');

//this file foucs on update user information

if(isset($_POST['Update'])){
	$userID=$_GET['userID'];
	$pwd_new=$_POST['pwd_new'];
	$pwd_origin=$_POST['pwd_origin'];
	$lastName=mysqli_real_escape_string($connSQL,$_POST['lastName']);
	$firstName=mysqli_real_escape_string($connSQL,$_POST['firstName']);


	$sql = "SELECT * FROM userTable WHERE userID = '$userID'";
	$result = $connSQL->query($sql);
	$row = $result->fetch_assoc();
	$pwd_origin = sha1($pwd_origin); //security
	if($pwd_origin == $row['password']) {
		//create user
		if($pwd_new==""){
			$sql = "UPDATE userTable SET firstName='$firstName', lastName='$lastName' WHERE userID='$userID'";
			//echo '1';
			if ($connSQL->query($sql) === TRUE) {
				echo "Record updated successfully";
				header("location:../Dashboard.php");
				//return;
			} else {
				echo "Error updating record: " . $connSQL->error;
			}
		}else{
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
}
?>