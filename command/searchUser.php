<?php require_once('../../Connections/connSQL.php'); ?>
<?php
$shareUserID=$_GET["shareUserID"];
?>
<head>
    <script type="text/javascript">
	function closeWindow(){
		var i;
		var text = "";
		var textID = "";
		var res;
		for (i = 0; i < document.searchUserForm.check_ShareLibraryList.length; i++) { 
			if (document.searchUserForm.check_ShareLibraryList[i].checked == true){
				res = document.searchUserForm.check_ShareLibraryList[i].value.split(',');
				text += res[0];
				text += ';';
				textID += res[1];
				textID += ',';
			}
		}
		window.opener.document.form_updateLibrary.shareUser.value = text;
		window.opener.document.form_updateLibrary.shareUserID.value = textID;
		window.close();
	}
    </script>
</head>
<body>
    <form name="searchUserForm">
		<table id="share_table">
			<tr>
				<td>
				<input type="checkbox" onclick="select_all(this,'shareUser');" />Select/Deselect All
				</td>
			</tr>
			<tr>
				<?php 	
						$list_shareUser = explode(',',$shareUserID);
						$listLength_shareUser = sizeof($list_shareUser);
						
						$query_RecWebInfo = "SELECT * FROM usertable";
						//$RecUserInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
						$RecUserInfo = $pdo->query($query_RecWebInfo);
						//while ($row_RecUserInfo = mysqli_fetch_assoc($RecUserInfo))
						while ($row_RecUserInfo = $RecUserInfo->fetch())
						{
							$checkbox = false;
							for($i=0;$i<$listLength_shareUser;$i++){
								if($row_RecUserInfo['userID'] == $list_shareUser[$i]){
									$checkbox = true;
								}
							}
							
							if($checkbox){
				?>
								<tr>
									<td>
										<input type="checkbox" name="check_ShareLibraryList" value="<?php echo $row_RecUserInfo['firstName']. " ". $row_RecUserInfo['lastName'].','.$row_RecUserInfo['userID'];?>" checked>
											<?php echo $row_RecUserInfo['firstName'];
												  echo " ";
												  echo $row_RecUserInfo['lastName'];?>
										</td>
										<td>
											<?php echo $row_RecUserInfo['email'];?>
										</td>
										</input>
								</tr>
				<?php		}else{?>
								<tr>
									<td>
										<input type="checkbox" name="check_ShareLibraryList" value="<?php echo $row_RecUserInfo['firstName']. " ". $row_RecUserInfo['lastName'].','.$row_RecUserInfo['userID'];?>">
											<?php echo $row_RecUserInfo['firstName'];
												  echo " ";
												  echo $row_RecUserInfo['lastName'];?>
										</td>
										<td>
											<?php echo $row_RecUserInfo['email'];?>
										</td>
										</input>
								</tr>
				<?php		}
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
		for (var i = 0; i < document.searchUserForm.check_ShareLibraryList.length; i++) {
			if (document.searchUserForm.check_ShareLibraryList[i] != source)
				document.searchUserForm.check_ShareLibraryList[i].checked = source.checked;
		}
	}
</script>