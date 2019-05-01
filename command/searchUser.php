<?php require_once('../../Connections/connSQL.php'); ?>
<?php
//$table=$_GET["table"];
//$page=$_GET["page"];
/*
if (isset($_POST['Update'])){
	$command='update';
}else if (isset($_POST['Create'])){
	$command='create';
}else if (isset($_POST['Delete'])){
	$command='delete';
}
*/
?>
<head>
    <script type="text/javascript">
	function closeWindow(){
		//alert(document.searchUserForm.check_ShareLibraryList.value);
		//alert(11111);
		//alert(window.opener.document.updateLibraryForm.shareUser.value);
		// 將xxx的value給父視窗的rtn
		//alert(document.searchUserForm.check_ShareLibraryList.length);
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
				textID += ';';
			}
		}
		window.opener.document.updateLibraryForm.shareUser.value = text;
		window.opener.document.updateLibraryForm.shareUserID.value = textID;
		window.close();
	}
    </script>
</head>
<body>
    <form name="searchUserForm">
		<table id="share_table">
			<tr>
				<?php 	$query_RecWebInfo = "SELECT * FROM usertable";
						$RecUserInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
						while ($row_RecUserInfo = mysqli_fetch_assoc($RecUserInfo))
						{
							//echo $row_RecUserInfo['userName'];
				?>
							<tr>
								<td>
									<input type="checkbox" name="check_ShareLibraryList" value="<?php echo $row_RecUserInfo['userName'].','.$row_RecUserInfo['userID'];?>"><?php echo $row_RecUserInfo['userName'];?>
									</input>
								</td>
							</tr>
				<?php	} ?>
			</tr>
			<tr>
				<td>
					<input type="button" value="confirm" onclick="closeWindow()">
				</td>
			</tr>
		</table>
	</form>
</body>