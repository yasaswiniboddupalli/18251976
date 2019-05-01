<?php require_once('../../Connections/connSQL.php'); 
$userEmailId =$_SESSION["email"];
$sql = "SELECT firstName, userID FROM userTable WHERE email = '$userEmailId'";
$result = $connSQL->query($sql);
if(true) {
	while($row = $result->fetch_assoc()) {
		$userID = $row["userID"];
	}
}
$DataType = $_GET['DataType'];
if(isset($_GET['DataInfo'])){
	$DataInfo = $_GET['DataInfo'];
}

if($DataType=='reference'){
	$stmt = $pdo->query("SELECT * FROM librarytable where libraryID='$DataInfo'");
	$row = $stmt->fetch();
	
	echo "<input type='text' id='libraryID' name='libraryID' value='".$DataInfo."' hidden />";
	echo "<input type='text' id='libraryName' name='libraryName' value='".$row['libraryName']."' hidden />";
	
	$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0");
	while($row = $stmt->fetch()) {
		if($DataInfo==$row['libraryID']){
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
		}
	}
}else if($DataType=='userAndLibrary'){
	$stmt = $pdo->query('SELECT * FROM sharelibrarytable');

	while($row = $stmt->fetch()) {
		if($DataInfo==$row['libraryID']){
			$list_shareUser = explode(',',$row['shareUser']);
			$listLength_shareUser = sizeof($list_shareUser);
			
			for($i=0;$i<$listLength_shareUser;$i++){
				$userID = $list_shareUser[$i];
				$stmt_userID = $pdo->query("SELECT * FROM usertable where userID='$userID'");
				$row_userID = $stmt_userID->fetch();
				echo "<tr>";
				echo "<td>".$row_userID['firstName']." ".$row_userID['lastName']."</td>";
				echo "<td>" . $row_userID['email'] . "</td>";
				echo "</tr>";
			}
		}
		/*
		$list_sharelibraryID = explode(',',$row['shareLibraryID']);
		$listLength_sharelibraryID = sizeof($list_sharelibraryID);
		
		for($i=0;$i<$listLength_sharelibraryID;$i++){
			if($DataInfo==$list_sharelibraryID[$i]){
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
			//}
		//}
		//*/
	}
}else if($DataType=='library'){
	echo "1";
}else if($DataType=='libraryDetail'){
	$stmt = $pdo->query("SELECT * FROM librarytable where libraryID='$DataInfo'");
	$row = $stmt->fetch();
	//echo $row['libraryName'];
	
	$stmt_shareLibrary = $pdo->query("SELECT * FROM sharelibrarytable where libraryID='$DataInfo'");
	$count_shareLibrary = $stmt_shareLibrary->fetchColumn();
	if($count_shareLibrary>0){
		$stmt_shareLibrary = $pdo->query("SELECT * FROM sharelibrarytable where libraryID='$DataInfo'");
		$row_shareLibrary = $stmt_shareLibrary->fetch();
		
		$list_shareUserInfo = explode(',',$row_shareLibrary['shareUser']);
		$listLength_shareUserInfo = sizeof($list_shareUserInfo);
		$userName="";
		for($i=0;$i<$listLength_shareUserInfo;$i++){
			$RecUserInfo = $pdo->query("SELECT * FROM usertable");
			while ($row_RecUserInfo = $RecUserInfo->fetch()){
				if($row_RecUserInfo['userID']==$list_shareUserInfo[$i]){
					$userName.=($row_RecUserInfo['firstName']." ".$row_RecUserInfo['lastName'].";");
				}
			}
		}
	}
	
	if($row['userID']==$userID){
			echo "<div class='col-sm-4'>Library Name</div>";
			echo "<div class='col-sm-8'>";
			echo "	<input type='text' id='libraryName_update' name='libraryName' value='".$row['libraryName']."' required>";
			echo "</div>";
			
			echo "<div class='col-sm-4'>Share with User</div>";
			echo "<div class='col-sm-8' rows='10' cols='30'>";
			
		if($count_shareLibrary>0){
			echo "	<input type='text' class='scrollabletextbox' id='shareWithUser_update' name='shareUser' value='".$userName."' disabled>";
			echo "	<input type='text' id='shareWithUser_update' name='shareUserID' value='".$row_shareLibrary['shareUser']."' hidden disabled>";
		}else{
			echo "	<input type='text' id='shareWithUser_update' name='shareUser' disabled>";
			echo "	<input type='text' id='shareWithUser_update' name='shareUserID' hidden disabled>";
		}
	}else{
			echo "<div class='col-sm-4'>Library Name</div>";
			echo "<div class='col-sm-8'>";
			echo "	<input type='text' id='libraryName_update' name='libraryName' value='".$row['libraryName']."' required disabled>";
			echo "</div>";
			
			echo "<div class='col-sm-4'>Share with User</div>";
			echo "<div class='col-sm-8' style='width: 200px; height: 100px; overflow-y: scroll;'>";
			
		if($count_shareLibrary>0){
			echo "	<input type='text' id='shareWithUser_update' name='shareUser' value='".$userName."' disabled>";
			echo "	<input type='text' id='shareWithUser_update' name='shareUserID' value='".$row_shareLibrary['shareUser']."' hidden disabled>";
		}else{
			echo "	<input type='text' id='shareWithUser_update' name='shareUser' disabled>";
			echo "	<input type='text' id='shareWithUser_update' name='shareUserID' hidden disabled>";
		}
	}
	if($row['userID']==$userID){
			echo "  <input type='button' value='Search User' onclick='openWindow_searchUser()'>";
	}
			echo "</div>";

			echo "<input type='submit' value='Update' name='submitData'>";
}

//mysqli_close($con);
?>