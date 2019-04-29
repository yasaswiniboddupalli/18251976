


<?php
SESSION_start();
$hostname_connSQL = "localhost";
$database_connSQL = "BibilographyManager";
$username_connSQL = "root";
$password_connSQL = "root";
$connSQL = mysqli_connect($hostname_connSQL, $username_connSQL, $password_connSQL) or trigger_error(mysql_error(),E_USER_ERROR); 
mysqli_query($connSQL, "SET NAMES UTF8");
mysqli_select_db($connSQL, $database_connSQL);
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$charset = 'utf8mb4';
$dsn = "mysql:host=$hostname_connSQL;dbname=$database_connSQL;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $username_connSQL, $password_connSQL, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>