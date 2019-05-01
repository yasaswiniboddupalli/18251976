<?php
$hostname_connSQL = "localhost";
$database_connSQL = "bibilography";
$username_connSQL = "xxx";
$password_connSQL = "xxx";
$connSQL = mysqli_connect($hostname_connSQL, $username_connSQL, $password_connSQL) or trigger_error(mysql_error(),E_USER_ERROR); 
mysqli_query($connSQL, "SET NAMES UTF8");
?>