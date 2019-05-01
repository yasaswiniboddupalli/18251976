<?php require_once('../../Connections/connSQL.php'); ?>
<?php
$table=$_GET["table"];
$page=$_GET["page"];
$operator=$_GET["operator"];
/*
if (isset($_POST['Update'])){
	$command='update';
}else if (isset($_POST['Create'])){
	$command='create';
}else if (isset($_POST['Delete'])){
	$command='delete';
}
*/
if($page=='OpenLibrary'){
	if(($table=='librarytable')&&($operator=='create')){
		$query_RecWebInfo = "SELECT * FROM librarytable ORDER BY`libraryID` DESC";
		//$RecLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
		$RecLibraryInfo = $pdo->query($query_RecWebInfo);
		//$row_RecLibraryInfo = mysqli_fetch_assoc($RecLibraryInfo);
		$row_RecLibraryInfo = $RecLibraryInfo->fetch();
		$libraryID = $row_RecLibraryInfo['libraryID'];
		//$totalRows_RecLibraryInfo = mysqli_num_rows($RecLibraryInfo);
		
		$libraryName = $_REQUEST['libraryName'];
		$userID = $_REQUEST['userID'];
		$sql = "INSERT INTO librarytable(libraryID, libraryName, userID) VALUES ($libraryID+1, '$libraryName', $userID)";
		//$result = mysqli_query($connSQL, $sql) or die(mysql_error());
		$result = $pdo->query($sql);
		if($result==True){
			echo "Successful";
		}else{
			echo "Fail";
		}
		return;
	}else if(($table=='librarytable')&&($operator=='update')){
		$libraryID = $_REQUEST['libraryID'];
		$libraryName = $_REQUEST['libraryName'];
		$shareUser = $_REQUEST['shareUser'];
		
		$sql = "update librarytable set libraryName='$libraryName' where libraryID='$libraryID'";
		//$result_1 = mysqli_query($connSQL, $sql) or die(mysql_error());
		$result_1 = $pdo->query($sql);
		
		$query_RecWebInfo = "SELECT * FROM sharelibrarytable where libraryID='$libraryID'";
		//$RecLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
		$RecLibraryInfo = $pdo->query($sql);
		//$totalRows_RecLibraryInfo = mysqli_num_rows($RecLibraryInfo);
		$totalRows_RecLibraryInfo = $RecLibraryInfo->fetchColumn();
		
		$result_2=True;
		if($shareUser==""){
			if($totalRows_RecLibraryInfo > 0){
				$sql = "DELETE FROM `sharelibrarytable` WHERE libraryID='$libraryID'";
				//$result_2 = mysqli_query($connSQL, $sql) or die(mysql_error());
				$result_2 = $pdo->query($sql);
			}
		}else{
			if($totalRows_RecLibraryInfo > 0){
				$sql = "update sharelibrarytable set shareUser='$shareUser' where libraryID='$libraryID'";
				//$result_2 = mysqli_query($connSQL, $sql) or die(mysql_error());
				$result_2 = $pdo->query($sql);
			}else{
				$query_RecWebInfo = "SELECT * FROM sharelibrarytable";
				//$RecshareLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
				$RecshareLibraryInfo = $pdo->query($query_RecWebInfo);
				//$totalRows_RecShareLibraryInfo = mysqli_num_rows($RecshareLibraryInfo);
				$totalRows_RecShareLibraryInfo = $RecshareLibraryInfo->fetchColumn();
				
				$sql = "INSERT INTO sharelibrarytable(libraryID, shareUser) VALUES ('$libraryID', '$shareUser')";
				//$result_2 = mysqli_query($connSQL, $sql) or die(mysql_error());
				$result_2 = $pdo->query($sql);
			}
		}
		
		if($result_1==True && $result_2==True){
			echo "Successful";
		}else{
			echo "Fail";
		}
		return;
	}else if(($table=='librarytable')&&($operator=='delete')){
		$deleteLibrary = $_REQUEST['deleteLibrary'];
		
		$list_deleteLibrary = explode(',',$deleteLibrary);
		$listLength_deleteLibrary = sizeof($list_deleteLibrary);
		$result_All = true;
		for($i=0;$i<$listLength_deleteLibrary;$i++){
			$sql = "DELETE FROM `librarytable` WHERE libraryID=".$list_deleteLibrary[$i];
			//$result = mysqli_query($connSQL, $sql) or die(mysql_error());
			$result = $pdo->query($sql);
			if($result != true) $result_All = false;
			
			$sql = "DELETE FROM `sharelibrarytable` WHERE libraryID=".$list_deleteLibrary[$i];
			//$result = mysqli_query($connSQL, $sql) or die(mysql_error());
			$result = $pdo->query($sql);
			if($result != true) $result_All = false;
			
			$sql = "DELETE FROM `referencetable` WHERE libraryID=".$list_deleteLibrary[$i];
			//$result = mysqli_query($connSQL, $sql) or die(mysql_error());
			$result = $pdo->query($sql);
			if($result != true) $result_All = false;
		}
		
		if($result_All==True){
			echo "Successful";
		}else{
			echo "Fail";
		}
		
		return;
	}else if(($table=='referencetable')&&($operator=='addToOtherLibrary')){
		$result_All=true;
		
		$value_checked_cboxes = $_REQUEST['value_checked_cboxes'];
		$libraryID_DestID = $_REQUEST['libraryID_DestID'];
		$userID = $_REQUEST['userID'];
		
		$list_libraryID = explode(',',$libraryID_DestID);
		$listLength_libraryID = sizeof($list_libraryID);
		
		$list_reference = explode(',',$value_checked_cboxes);
		$listLength_reference = sizeof($list_reference);
		
		for($i=0;$i<$listLength_libraryID-1;$i++){	//minor the last " "
			$libraryID = $list_libraryID[$i];
			for($j=0;$j<$listLength_reference-1;$j++){ //minor the last " "
				$referenceID = $list_reference[$j];
				$sql = "SELECT entryType, author, bookTitle, editor, title, journal, publisher, year, volume FROM referenceTable WHERE referenceID='$referenceID' ";
				$stmt = $pdo->query($sql);
				$row = $stmt->fetch();
				$entryType = $row['entryType'];
				$author = $row['author'];
				$bookTitle = $row['bookTitle'];
				$editor = $row['editor'];
				$title = $row['title'];
				$journal = $row['journal'];
				$publisher = $row['publisher'];
				$year = $row['year'];
				$volume = $row['volume'];
				
				$sql = "INSERT INTO referenceTable(entryType, author, bookTitle, editor, title, journal, publisher, year, volume, libraryID, defaultLibrary, isDelete, userID) VALUES ('$entryType','$author','$bookTitle','$editor','$title','$journal','$publisher','$year','$volume', $libraryID, 0, 0, $userID)";
				$result = $pdo->query($sql);
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
	/*else if(($table=='sharelibrarytable')&&(isset($_POST['Update']))){
		if(!empty($_POST['check_ShareLibraryList'])) {
			$checked_count = count($_POST['check_ShareLibraryList']);
			if($checked_count==1){
				$check_ShareLibraryList = $_POST ['check_ShareLibraryList'];
				//echo $check_ShareLibraryList[0];
	?>
				<script language=JavaScript>
					window.location.href="../UpdateLibrary.php?libraryID=<?php echo $check_ShareLibraryList[0];?>"
				</script>
	<?php	
			}
		}
	}else if(($table=='sharelibrarytable')&&(isset($_POST['Create']))){
		$query_RecWebInfo = "SELECT * FROM sharelibrarytable";
		$RecShareLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
		$totalRows_RecShareLibraryInfo = mysqli_num_rows($RecShareLibraryInfo);
		
		$sql = "INSERT INTO sharelibrarytable(libraryID, libraryName, userID, shareUser) VALUES ($totalRows_RecShareLibraryInfo+1,'library_insert',4,'1,2')";
		$result = mysqli_query($connSQL, $sql) or die(mysql_error());
	}else if(($table=='sharelibrarytable')&&(isset($_POST['Delete']))){
		if(!empty($_POST['check_ShareLibraryList'])){
			// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_ShareLibraryList'] as $selected){
				$sql = "DELETE FROM `sharelibrarytable` WHERE libraryID=".$selected;
				$result = mysqli_query($connSQL, $sql) or die(mysql_error());
			}
		}
	}else if(($table=='sharelibrarytable')&&(isset($_POST['submit_addshareLibrary']))){
		if(!empty($_POST['check_ReferenceList'])){
			// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_ReferenceList'] as $selected){
				$query_RecWebInfo = "SELECT * FROM referencetable where referenceID='$selected'";
				$RecReferenceInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
				$row_RecReferenceInfo = mysqli_fetch_assoc($RecReferenceInfo);
				$shareLibraryID=$row_RecReferenceInfo['sharelibraryID'];
				//echo $shareLibraryID;
				
				$list_sharelibraryID = explode(',',$shareLibraryID);
				$listLength_sharelibraryID = sizeof($list_sharelibraryID);
				
				$needToAdd=True;
				for($i=0;$i<$listLength_sharelibraryID;$i++){
					//echo $list_sharelibraryID[$i];
					//echo "<p>";
					//echo $_POST['select_shareLibrary'];
					if($_POST['select_shareLibrary']==$list_sharelibraryID[$i]){
						$needToAdd=False;
					}
				}
				
				//echo "<p>";
				//echo $needToAdd;
				if($needToAdd){
					//echo $_POST['select_shareLibrary'];
					$shareLibraryID.=','.$_POST['select_shareLibrary'];
					//echo $shareLibraryID;
					$sql = "update referencetable set entryType='sharelibrary$shareLibraryID', sharelibraryID='$shareLibraryID' where referenceID='$selected'";
					$result = mysqli_query($connSQL, $sql) or die(mysql_error());
				}
			}
		}
	}else if(($table=='sharelibrarytable')&&(isset($_POST['submit_removeshareLibrary']))){
		if(!empty($_POST['check_ReferenceList'])){
			// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_ReferenceList'] as $selected){
				$query_RecWebInfo = "SELECT * FROM referencetable where referenceID='$selected'";
				$RecReferenceInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
				$row_RecReferenceInfo = mysqli_fetch_assoc($RecReferenceInfo);
				$shareLibraryID=$row_RecReferenceInfo['sharelibraryID'];
				//echo $shareLibraryID;
				
				$list_sharelibraryID = explode(',',$shareLibraryID);
				$listLength_sharelibraryID = sizeof($list_sharelibraryID);
				
				$needToRemove=False;
				for($i=0;$i<$listLength_sharelibraryID;$i++){
					//echo $list_sharelibraryID[$i];
					//echo "<p>";
					//echo $_POST['select_shareLibrary'];
					if($_POST['select_shareLibrary']==$list_sharelibraryID[$i]){
						$needToRemove=True;
					}
				}
				
				//echo "<p>";
				//echo $needToAdd;
				$shareLibraryID="";
				$first_add=True;
				if($needToRemove){
					//echo $_POST['select_shareLibrary'];
					for($i=0;$i<$listLength_sharelibraryID;$i++){
						if($_POST['select_shareLibrary']!=$list_sharelibraryID[$i]){
							if($first_add){
								$first_add=False;
							}else{
								$shareLibraryID.=",";
							}
							$shareLibraryID.=$list_sharelibraryID[$i];
						}
					}
					//echo $shareLibraryID;
					$sql = "update referencetable set entryType='sharelibrary$shareLibraryID', sharelibraryID='$shareLibraryID' where referenceID='$selected'";
					$result = mysqli_query($connSQL, $sql) or die(mysql_error());
				}
			}
		}
	}
	*/
}	
/*
else if($page=='UpdateLibrary'){
	if(($table=='sharelibrarytable')&&(isset($_POST['Update']))){
		$libraryID=$_GET["libraryID"];
		
		if ( isset( $_POST ) ){
			$libraryName = $_POST['libraryName'];
			$userID = $_POST['userID'];
			$shareUserID = $_POST['shareUserID'];
		}
		$sql = "update sharelibrarytable set libraryName='$libraryName',userID=$userID,shareUser='$shareUserID' where libraryID='$libraryID'";
		//echo $sql;
		$result = mysqli_query($connSQL, $sql) or die(mysql_error());

		?>
		<script language=JavaScript>
			window.location.href="../UpdateLibrary.php?libraryID=<?php echo $libraryID;?>"
		</script>
		<?php

	}
}
*/
?>
<!--
<script language=JavaScript>
	window.location.href="../OpenLibrary.php"
</script>
-->