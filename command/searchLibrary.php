<?php require_once('../../Connections/connSQL.php'); ?>
<?php
$userID=$_GET["userID"];
$libraryID_Origin=$_GET["libraryID_Origin"];
?>
<head>
    <script type="text/javascript">
	function closeWindow(){
		var i;
		var text = "";
		var textID = "";
		var res;
		for (i = 0; i < document.searchLibraryForm.check_ShareLibraryList.length; i++) { 
			if (document.searchLibraryForm.check_ShareLibraryList[i].checked == true){
				res = document.searchLibraryForm.check_ShareLibraryList[i].value.split(',');
				text += res[0];
				text += ';';
				textID += res[1];
				textID += ',';
			}
		}
		window.opener.document.form_addToOtherLibrary.libraryID_Dest.value = text;
		window.opener.document.form_addToOtherLibrary.libraryID_DestID.value = textID;
		window.close();
	}
    </script>
</head>
<body>
    <form name="searchLibraryForm">
		<table id="share_table">
			<tr>
				<td>
				<input type="checkbox" onclick="select_all(this,'shareUser');" />Select/Deselect All
				</td>
			</tr>
			<tr>
				<?php 	
						$query_RecWebInfo = "SELECT * FROM librarytable where userID='$userID'";
						//$RecLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
						$RecLibraryInfo = $pdo->query($query_RecWebInfo);
						//while ($row_RecLibraryInfo = mysqli_fetch_assoc($RecLibraryInfo))
						while ($row_RecLibraryInfo = $RecLibraryInfo->fetch())
						{
							if($libraryID_Origin != $row_RecLibraryInfo['libraryID']){
				?>
								<tr>
									<td>
										<input type="checkbox" name="check_ShareLibraryList" value="<?php echo $row_RecLibraryInfo['libraryName'].','.$row_RecLibraryInfo['libraryID'];?>">
											<?php echo $row_RecLibraryInfo['libraryName'];?>
										</input>
									</td>
								</tr>
				<?php		}
						} 
				?>
				
				<?php 	$query_RecWebInfo = "SELECT * FROM sharelibrarytable";
						//$RecShareLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
						$RecShareLibraryInfo = $pdo->query($query_RecWebInfo);
						
						//while ($row_RecShareLibraryInfo = mysqli_fetch_assoc($RecShareLibraryInfo))
						while ($row_RecShareLibraryInfo = $RecShareLibraryInfo->fetch())
						{
							$list_sharelibraryID = explode(',',$row_RecShareLibraryInfo['shareUser']);
							$listLength_sharelibraryID = sizeof($list_sharelibraryID);
							
							$libraryID = $row_RecShareLibraryInfo['libraryID'];
							$query_RecWebInfo = "SELECT * FROM librarytable where libraryID = '$libraryID'";
							//$RecLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
							$RecLibraryInfo = $pdo->query($query_RecWebInfo);
							//$row_RecLibraryInfo = mysqli_fetch_assoc($RecLibraryInfo);
							$row_RecLibraryInfo = $RecLibraryInfo->fetch();
							
							for($i=0;$i<$listLength_sharelibraryID;$i++){
								if($userID == $list_sharelibraryID[$i] && ($userID != $row_RecLibraryInfo['userID'])
									&& $libraryID_Origin != $row_RecLibraryInfo['libraryID']){
						?>
									<tr>
										<td>
											<input type="checkbox" name="check_ShareLibraryList" value="<?php echo $row_RecLibraryInfo['libraryName'].','.$row_RecLibraryInfo['libraryID'];?>">
												<?php echo $row_RecLibraryInfo['libraryName'];?>
											</input>
										</td>
									</tr>
						<?php 			
									break;
								}
							}
						} ?>
			</tr>
			<tr>
				<td>
					<input type="button" value="confirm" onclick="closeWindow()">
				</td>
			</tr>
		</table>
	</form>
</body>

<script>
	function select_all(source, type) {
		for (var i = 0; i < document.searchLibraryForm.check_ShareLibraryList.length; i++) {
			if (document.searchLibraryForm.check_ShareLibraryList[i] != source)
				document.searchLibraryForm.check_ShareLibraryList[i].checked = source.checked;
		}
	}
</script>