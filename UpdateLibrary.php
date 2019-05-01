<?php require_once('../Connections/connSQL.php'); 
$libraryID=$_GET["libraryID"];
//echo $libraryID;
$query_RecWebInfo = "SELECT * FROM sharelibrarytable where libraryID=".$libraryID;
$RecShareLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
$row_RecShareLibraryInfo = mysqli_fetch_assoc($RecShareLibraryInfo);
?>
<!DOCTYPE html>
<html>
<title>Bibilography Manager User Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="Style.css">
<link rel="stylesheet" href="dashboardstyle.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><style>
body {font-family: "Roboto", sans-serif}
.w3-bar-block .w3-bar-item {
  padding: 16px;
  font-weight: bold;
}
</style>
<body>
<div class="w3-container" style="padding:32px">
<!--Home of user dashboard--->
<h4 style="text-align:left">Welcome User!</h4>
<h4 style="text-align:right">Logout<h4>
<!--table nav bar-->
<ul>
  <li><a class="active" href="#add">Add</a></li>
  <li><a href="#sort">Sort</a></li>
  <li><a href="#share">Share</a></li>
  <li><a href="#delete">Delete</a></li>
</ul>
<!--search bar-->
<form>
  <input type="text" name="search" placeholder="Search..">
</form>

	<p>
	<div>
		<form id="form" name="updateLibraryForm" enctype="multipart/form-data" method="post" action="command/command.php?table=sharelibrarytable&page=UpdateLibrary&libraryID=<?php echo $libraryID;?>">
			<table id="share_table">
				<tr>
					<tr>
						<th>Name</th>
						<td><input type="text" name="libraryName" value="<?php echo $row_RecShareLibraryInfo['libraryName'];?>" style="width:100%;"></input> </td>
					</tr>
					<tr>
						<th>Abstract</th>
						<td><input type="textbox" value="Library Abstract" style="width:100%;height:100px;"></input> </td>
					</tr>
					<tr>
						<th>Owner</th>
						<td><input type="textbox" name="userID" value="<?php echo $row_RecShareLibraryInfo['userID'];?>" style="width:100%;height:100px;"></input> </td>
					</tr>
					<?php
						//echo $row_RecShareLibraryInfo['shareUser'];
						$list_shareUserInfo = explode(';',$row_RecShareLibraryInfo['shareUser']);
						$listLength_shareUserInfo = sizeof($list_shareUserInfo);
						//echo $list_shareUserInfo[0];
						//echo $listLength_shareUserInfo;
						$userName="";
						for($i=0;$i<$listLength_shareUserInfo;$i++){
							$query_RecWebInfo = "SELECT * FROM usertable";
							$RecUserInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
							while ($row_RecUserInfo = mysqli_fetch_assoc($RecUserInfo)){
								if($row_RecUserInfo['userID']==$list_shareUserInfo[$i]){
									//echo $row_RecUserInfo['userName'];
									$userName.=($row_RecUserInfo['userName'].";");
								}
							}
						}
					?>
					<tr>
						<th>ShareWith</th>
						<td><input type="textbox" name="shareUser" value="<?php echo $userName;?>" style="width:100%;height:100px;"></input> </td>
					</tr>
					<tr>
						<th>ShareWith(ID)<input type="button" value="Search User" onclick="openWindow()"></th>
						<td><input type="textbox" name="shareUserID" value="<?php echo $row_RecShareLibraryInfo['shareUser'];?>" style="width:100%;height:100px;"></input> </td>
						<script type="text/javascript">
							function openWindow(){
								window.open('command/searchUser.php','_blank','height=400,width=400');
							}
						</script>
					</tr>
				</tr>

			</table>
			<br>
			<input  type="submit" name="Update" value="Update" style="text-align:center;"></input>
		</form>
	</div>
</div>

</body>
</html>
