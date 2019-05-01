<?php require_once('../../Connections/connSQL.php'); ?>
<?php
$table=$_GET["table"];
$page=$_GET["page"];
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
	if(($table=='sharelibrarytable')&&(isset($_POST['Update']))){
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
		/*
		$query_RecWebInfo = "SELECT * FROM sharelibrarytable";
		$RecShareLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
		$totalRows_RecShareLibraryInfo = mysqli_num_rows($RecShareLibraryInfo);
		
		$sql = "INSERT INTO sharelibrarytable(libraryID, libraryName, userID, shareUser) VALUES ($totalRows_RecShareLibraryInfo+1,'library_insert',4,'1,2')";
		$result = mysqli_query($connSQL, $sql) or die(mysql_error());
		*/
	}else if(($table=='sharelibrarytable')&&(isset($_POST['Delete']))){
		/*
		if(!empty($_POST['check_ShareLibraryList'])){
			// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_ShareLibraryList'] as $selected){
				$sql = "DELETE FROM `sharelibrarytable` WHERE libraryID=".$selected;
				$result = mysqli_query($connSQL, $sql) or die(mysql_error());
			}
		}
		*/
	}
}else if($page=='UpdateLibrary'){
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
?>
<!--
<script language=JavaScript>
	window.location.href="../OpenLibrary.php"
</script>
-->