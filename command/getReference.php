<?php require_once('../../Connections/connSQL.php'); ?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

/*
$con = mysqli_connect('localhost','peter','abc123','my_db');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM user WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);
*/

$stmt = $pdo->query('SELECT * FROM referenceTable');
while ($row = $stmt->fetch())
{
	echo $row['referenceID'] . "\n";
}


//while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td><input type='checkbox' value=''></td>";
	echo "<td>Psychology of reading</td>";
    echo "<td>Jill</td>";
    echo "<td>1950</td>";
    echo "<td>A</td>";
    echo "<td>A</td>";
    echo "<td>A</td>";
    echo "</tr>";
	/*
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['Age'] . "</td>";
    echo "<td>" . $row['Hometown'] . "</td>";
    echo "<td>" . $row['Job'] . "</td>";
    echo "</tr>";
	*/
//}

//mysqli_close($con);
?>
</body>
</html>