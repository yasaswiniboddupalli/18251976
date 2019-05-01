<?php require_once('../../Connections/connSQL.php'); 
$libraryType = intval($_GET['libraryType']);
$libraryID = intval($_GET['libraryID']);

/*
$q = intval($_GET['q']);
$con = mysqli_connect('localhost','peter','abc123','my_db');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM user WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);
*/

if($libraryType=='sharelibrary'){
	//$stmt = $pdo->query('SELECT * FROM referenceTable where shareLibraryID='.$libraryID);
	$stmt = $pdo->query('SELECT * FROM referenceTable');
	//while ($row = $stmt->fetch())
	//{
	//	echo $row['referenceID'] . "\n";
	//}


	while($row = $stmt->fetch()) {
		$list_sharelibraryID = explode(',',$row['shareLibraryID']);
		$listLength_sharelibraryID = sizeof($list_sharelibraryID);
		
		for($i=0;$i<$listLength_sharelibraryID;$i++){
			if($libraryID==$list_sharelibraryID[$i]){
				echo "<tr>";
				echo "<td><input type='checkbox' name='check_ReferenceList[]' value='" . $row['referenceID'] . "'></td>";
				echo "<td>" . $row['entryType'] . "</td>";
				echo "<td>" . $row['author'] . "</td>";
				echo "<td>" . $row['bookTitle'] . "</td>";
				echo "<td>" . $row['editor'] . "</td>";
				echo "<td>" . $row['title'] . "</td>";
				echo "<td>" . $row['journal'] . "</td>";
				echo "<td>" . $row['publisher'] . "</td>";
				echo "<td>" . $row['year'] . "</td>";
				echo "<td>" . $row['volume'] . "</td>";
				echo "</tr>";
				/*
				echo "<td>" . $row['FirstName'] . "</td>";
				echo "<td>" . $row['LastName'] . "</td>";
				echo "<td>" . $row['Age'] . "</td>";
				echo "<td>" . $row['Hometown'] . "</td>";
				echo "<td>" . $row['Job'] . "</td>";
				echo "</tr>";
				*/
			}
		}
	}
}

//mysqli_close($con);
?>