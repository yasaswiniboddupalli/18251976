<?php
$con=mysqli_connect("localhost","root","") or die("connection failed");
//$con=mysqli_connect("localhost","root","");
if(!$con){
	die('could not connect:'.mysqli_error());
}
mysqli_select_db($con, 'Bibliography') or die("db not found");
?>