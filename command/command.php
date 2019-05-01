<?php require_once('../../Connections/connSQL.php'); ?>
<?php
$table=$_GET["table"];
$page=$_GET["page"];
$operator=$_GET["operator"];

if($page=='OpenLibrary'){	//This is controllor for page OpenLibrary
	
	if(($table=='librarytable')&&($operator=='create')){
	//here will modify librarytable by create library
		$query_RecWebInfo = "SELECT * FROM librarytable ORDER BY`libraryID` DESC";

		$RecLibraryInfo = $pdo->query($query_RecWebInfo);

		$row_RecLibraryInfo = $RecLibraryInfo->fetch();
		$libraryID = $row_RecLibraryInfo['libraryID'];


		$libraryName = mysqli_real_escape_string($connSQL,$_REQUEST['libraryName']);
		$userID = $_REQUEST['userID'];
		$sql = "INSERT INTO librarytable(libraryID, libraryName, userID) VALUES ($libraryID+1, '$libraryName', $userID)";

		$result = $pdo->query($sql);
		if($result==True){
			echo "New Library Created Successfully";
		}else{
			echo "Library Creation Failed";
		}
		return;
	}else if(($table=='librarytable')&&($operator=='update')){
	//here will modify librarytable by update library
	
		$libraryID = $_REQUEST['libraryID'];
		$libraryName = mysqli_real_escape_string($connSQL,$_REQUEST['libraryName']);
		$shareUser = $_REQUEST['shareUser'];

		$sql = "update librarytable set libraryName='$libraryName' where libraryID='$libraryID'";

		$result_1 = $pdo->query($sql);

		$query_RecWebInfo = "SELECT * FROM sharelibrarytable where libraryID='$libraryID'";

		$RecLibraryInfo = $pdo->query($query_RecWebInfo);

		$totalRows_RecLibraryInfo = $RecLibraryInfo->fetchColumn();

		$result_2=True;
		if($shareUser==""){
			if($totalRows_RecLibraryInfo > 0){
				$sql = "DELETE FROM `sharelibrarytable` WHERE libraryID='$libraryID'";

				$result_2 = $pdo->query($sql);
			}
		}else{
			if($totalRows_RecLibraryInfo > 0){
				$sql = "update sharelibrarytable set shareUser='$shareUser' where libraryID='$libraryID'";

				$result_2 = $pdo->query($sql);
			}else{
				$query_RecWebInfo = "SELECT * FROM sharelibrarytable";

				$RecshareLibraryInfo = $pdo->query($query_RecWebInfo);

				$totalRows_RecShareLibraryInfo = $RecshareLibraryInfo->fetchColumn();

				$sql = "INSERT INTO sharelibrarytable(libraryID, shareUser) VALUES ('$libraryID', '$shareUser')";

				$result_2 = $pdo->query($sql);
			}
		}

		if($result_1==True && $result_2==True){
			echo "Library Shared Successfully";
		}else{
			echo "Library Sharing Failed";
		}
		return;
	}else if(($table=='librarytable')&&($operator=='delete')){
	//here will modify librarytable by delete library
	
		$deleteLibrary = $_REQUEST['deleteLibrary'];

		$list_deleteLibrary = explode(',',$deleteLibrary);
		$listLength_deleteLibrary = sizeof($list_deleteLibrary);
		$result_All = true;
		for($i=0;$i<$listLength_deleteLibrary;$i++){
			$sql = "DELETE FROM `librarytable` WHERE libraryID=".$list_deleteLibrary[$i];

			$result = $pdo->query($sql);
			if($result != true) $result_All = false;

			$sql = "DELETE FROM `sharelibrarytable` WHERE libraryID=".$list_deleteLibrary[$i];

			$result = $pdo->query($sql);
			if($result != true) $result_All = false;

			$sql = "DELETE FROM `referencetable` WHERE libraryID=".$list_deleteLibrary[$i];

			$result = $pdo->query($sql);
			if($result != true) $result_All = false;
		}

		if($result_All==True){
			echo "Library Deleted";
		}else{
			echo "Library Deletion Failed";
		}

		return;
	}else if(($table=='referencetable')&&($operator=='addToOtherLibrary')){
	//here will modify referencetable by add to libraries
	//We can add the same references into different libraries
	
		$result_All=true;

		$value_checked_cboxes = $_REQUEST['value_checked_cboxes'];
		$libraryID_DestID = $_REQUEST['libraryID_DestID'];
		$userID = mysqli_real_escape_string($connSQL,$_REQUEST['userID']);
		$keepOne = $_REQUEST['keepOne'];


			$list_libraryID = explode(',',$libraryID_DestID);
			$listLength_libraryID = sizeof($list_libraryID);

			$list_reference = explode(',',$value_checked_cboxes);
			$listLength_reference = sizeof($list_reference);

			for($i=0;$i<$listLength_libraryID-1;$i++){
				//minor the last " "
				$libraryID = $list_libraryID[$i];
				for($j=0;$j<$listLength_reference-1;$j++){
					 //minor the last " "
					$referenceID = $list_reference[$j];
					$sql = "SELECT entryType, author, bookTitle, editor, title, journal, publisher, year, volume FROM referenceTable WHERE referenceID='$referenceID' ";
					$stmt = $pdo->query($sql);
					$row = $stmt->fetch();
					$entryType = mysqli_real_escape_string($connSQL,$row['entryType']);
					$author = mysqli_real_escape_string($connSQL,$row['author']);
					$bookTitle = mysqli_real_escape_string($connSQL,$row['bookTitle']);
					$editor = mysqli_real_escape_string($connSQL,$row['editor']);
					$title = mysqli_real_escape_string($connSQL,$row['title']);
					$journal = mysqli_real_escape_string($connSQL,$row['journal']);
					$publisher = mysqli_real_escape_string($connSQL,$row['publisher']);
					$year = mysqli_real_escape_string($connSQL,$row['year']);
					$volume = mysqli_real_escape_string($connSQL,$row['volume']);

					$defaultLibrary=0;
					if($libraryID==0){
						$defaultLibrary=1;
					}

					$sql = "INSERT INTO referenceTable(entryType, author, bookTitle, editor, title, journal, publisher, year, volume, libraryID, defaultLibrary, isDelete, userID) VALUES ('$entryType','$author','$bookTitle','$editor','$title','$journal','$publisher','$year','$volume', $libraryID, $defaultLibrary, 0, $userID)";
					$result = $pdo->query($sql);
					if($result!=true){
						$result_All=false;
					}
				}
			}


		if($keepOne=="no"){
			for($j=0;$j<$listLength_reference-1;$j++){ //minor the last " "
				$referenceID = $list_reference[$j];
				//echo $list_reference[$j];
				$sql_delete = "DELETE from referenceTable WHERE referenceID='$referenceID'";
				$result = $pdo->query($sql_delete);
				if($result!=true){
					$result_All=false;
				}
			}
		}

		if($result_All==True){
			echo "Successful";
		}else{
			echo "Fail";
		}
		return;
	}else if(($table=='referencetable')&&($operator=='delete')){
	//here will modify referencetable by delete libraries
	
		$deleteReference = $_REQUEST['deleteReference'];

		$list_deleteReference = explode(',',$deleteReference);
		$listLength_deleteReference = sizeof($list_deleteReference);
		$result_All = true;
		for($i=0;$i<$listLength_deleteReference;$i++){
			$sql = "DELETE FROM `referencetable` WHERE referenceID=".$list_deleteReference[$i];
			$result = $pdo->query($sql);
			if($result != true) $result_All = false;
		}

		if($result_All==True){
			echo "Successful";
		}else{
			echo "Fail";
		}

		return;
	}
}
?>
