<?php require_once('../Connections/connSQL.php'); ?>
<?php
//mysqli_select_db($connSQL, $database_connSQL);
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

#table-wrapper {
	position:relative;
}
#table-scroll {
  height:150px;
  overflow:auto;  
  margin-top:65px;
  border: 1px solid #ddd;
}
#table-wrapper table {
  width:100%;
    
}

/* styles for share_table*/
#share_table{
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#share_table td, #share_table th {

  padding: 8px;
}

#share_table tr:nth-child(even){background-color: #f2f2f2;}

#share_table tr:hover {background-color: #ddd;}

#share_table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: black;
  color: white;
}
</style>
<body>
<div class="w3-container" style="padding:32px">
<!--Home of user dashboard--->
<h4 style="text-align:left">
<?php
	$userEmailId =$_SESSION["email"];
	$sql = "SELECT firstName, userID FROM userTable WHERE email = '$userEmailId'";
	$result = $connSQL->query($sql);
	if(true) {
		while($row = $result->fetch_assoc()) {
			echo "Hello"." ".$row["firstName"];
			$userID = $row["userID"];
		}
	}
?>
</h4>
<h4 style="text-align:right">Logout<h4>

<?php
	//do{
		//echo $totalRows_RecLibraryInfo;
	//}while($row_RecLibraryInfo = mysqli_fetch_assoc($RecLibraryInfo));
?>

	<p>
	<table style="table-layout: fixed;">
		<tr>
			<td style="width:500px">
				<table id="share_table">
					<thead>
						<tr>
							<th><h4>Library</h4></th>
						</tr>
					</thead>
					<!--
					<tbody>
						<tr>
							<td>
								<input type="checkbox" value="">
								<span style="color:mediumblue" onclick="myFunction('library1')">library1</span>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" value="">
								<span style="color:mediumblue" onclick="myFunction('library2')">library2</span>
							</td>
						</tr>
						<tr>
							<td>
								<form action="OpenLibrary.php"><input  type="submit" value="Update" style="float:left;"></input></form>
								<form action="CreateLibrary.html"><input  type="submit" value="Create" style="float:left;"></input></form>
								<form action="CreateLibrary.html"><input  type="submit" value="Delete" style="float:left;"></input></form>
							</td>
						</tr>
					</tbody>
					-->
					<tbody>
							<!--
							<tr>
								<td>
									<input type="checkbox" value="">
									<span style="color:mediumblue" onclick="myFunction('sharelibrary1')">Shared_library1</span>
								</td>
							</tr>
							<tr>
								<td>
									<input type="checkbox" value="">
									<span style="color:mediumblue" onclick="myFunction('sharelibrary2')">Shared_library2</span>
								</td>
							</tr>
							-->
							<?php 	$query_RecWebInfo = "SELECT * FROM librarytable where userID = '$userID'";
									$RecShareLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());

									$index =1;
									//$libraryName;
									while ($row_RecShareLibraryInfo = mysqli_fetch_assoc($RecShareLibraryInfo))
									{
										/*
										$query_RecWebInfo = "SELECT * FROM librarytable";
										$RecLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
										while ($row_RecLibraryInfo = mysqli_fetch_assoc($RecLibraryInfo))
										{
											if($row_RecShareLibraryInfo['libraryID']==$row_RecLibraryInfo['libraryID'])
											{
												$libraryName = $row_RecLibraryInfo['libraryName'];
											}
										}
										*/
									?>
										<tr>
											<td>
												<input type="checkbox" name="check_ShareLibraryList[]" value="<?php echo $row_RecShareLibraryInfo['libraryID'];?>">
												<!--	<span style="color:mediumblue" onclick="myFunction('sharelibrary1')">Shared_library1</span>	-->
												<span style="color:mediumblue" onclick="showUser('sharelibrary','<?php echo $row_RecShareLibraryInfo['libraryID'];?>')"><?php echo $row_RecShareLibraryInfo['libraryName'];?></span>
											</td>
										</tr>
							<?php 	$index++;
									} ?>		
									
							<tr>
								<td>
									<input  type="submit" name="Update" value="Update" style="float:left;"></input>
									<input  type="submit" name="Create" value="Create" style="float:left;"></input>
									<input  type="submit" name="Delete" value="Delete" style="float:left;"></input>
								</td>
							</tr>
						</tbody>
				</table>
			</td>
			<td style="width:100px;">
			</td>
			<td style="width:500px">
				<form id="form" name="thisform" enctype="multipart/form-data" method="post" action="command/command.php?table=sharelibrarytable&page=OpenLibrary">
					<div id="table-wrapper">
					<div id="table-scroll">
					<table id="share_table">
						<thead>
							<tr>
								<th style="position:absolute; top:-65px; z-index:2; width:100%;"><h4>Shared Library</h4></th>
							</tr>
						</thead>
						<tbody>
							<!--
							<tr>
								<td>
									<input type="checkbox" value="">
									<span style="color:mediumblue" onclick="myFunction('sharelibrary1')">Shared_library1</span>
								</td>
							</tr>
							<tr>
								<td>
									<input type="checkbox" value="">
									<span style="color:mediumblue" onclick="myFunction('sharelibrary2')">Shared_library2</span>
								</td>
							</tr>
							-->
							<?php 	$query_RecWebInfo = "SELECT * FROM sharelibrarytable";
									$RecShareLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
									//$row_RecShareLibraryInfo = mysqli_fetch_assoc($RecShareLibraryInfo);
									//$totalRows_RecShareLibraryInfo = mysqli_num_rows($RecShareLibraryInfo);

									//$query_RecWebInfo = "SELECT * FROM librarytable";
									//$RecLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
									//$row_RecLibraryInfo = mysqli_fetch_assoc($RecLibraryInfo);
									//$totalRows_RecLibraryInfo = mysqli_num_rows($RecLibraryInfo);
									//$index =1;
									//$libraryName;
									while ($row_RecShareLibraryInfo = mysqli_fetch_assoc($RecShareLibraryInfo))
									{
										$list_sharelibraryID = explode(',',$row_RecShareLibraryInfo['shareUser']);
										$listLength_sharelibraryID = sizeof($list_sharelibraryID);
										
										for($i=0;$i<$listLength_sharelibraryID;$i++){
											if($userID == $list_sharelibraryID[$i]){
									?>
												<tr>
													<td>
														<input type="checkbox" name="check_ShareLibraryList[]" value="<?php echo $row_RecShareLibraryInfo['libraryID'];?>">
														<!--	<span style="color:mediumblue" onclick="myFunction('sharelibrary1')">Shared_library1</span>	-->
														<span style="color:mediumblue" onclick="showUser('sharelibrary','<?php echo $row_RecShareLibraryInfo['libraryID'];?>')"><?php echo $row_RecShareLibraryInfo['libraryName'];?></span>
													</td>
												</tr>
									<?php 			
												break;
											}
										}
										//$index++;
									} ?>								
						</tbody>
					</table>
					</div>
					</div>
					<table>
						<tr>
							<td>
								<input  type="submit" name="Update" value="Update" style="float:left;"></input>
								<input  type="submit" name="Create" value="Create" style="float:left;"></input>
								<input  type="submit" name="Delete" value="Delete" style="float:left;"></input>
							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
	<p>

	<!--table-->
	<form id="form" name="thisform" enctype="multipart/form-data" method="post" action="command/command.php?table=sharelibrarytable&page=OpenLibrary">
		<table id="customers">
			<thead>
				<tr>
					<th><input type="checkbox" value="">All</th>
					<th>Entry Type</th>
					<th>Author</th>
					<th>Book Title</th>
					<th>Editor</th>
					<th>Title</th>
					<th>Journal</th>
					<th>Publisher</th>
					<th>Year</th>
					<th>Volume</th>
				</tr>
			</thead>
			<tbody id ="txtHint">	
				<tr>
					Reference info will be listed here...
				</tr>
			</tbody>
			
		</table>

		<input  type="submit" value="UpdateReference" style="text-align:center;">
		<input  type="submit" value="AddToLibrary" style="text-align:center;">

		<select name="select_shareLibrary">
		<option value="">Share Library:</option>
		<option value="1">sharelibrary1</option>
		<option value="2">sharelibrary2</option>
		<option value="3">sharelibrary3</option>
		</select>
		<input  type="submit" name="submit_addshareLibrary" value="Add To" style="text-align:center;"></input>
		<input  type="submit" name="submit_removeshareLibrary" value="Remove from" style="text-align:center;"></input>
	</form>
</div>

	<script>
		function myFunction(parameter1) {
			if(parameter1 == "library1"){
				document.getElementById("library2_hidden").style.display = "none";
				document.getElementById("library1_hidden").style.display = "table-row-group";
			}else if(parameter1 == "library2"){
				document.getElementById("library1_hidden").style.display = "none";
				document.getElementById("library2_hidden").style.display = "table-row-group";
			}
		}
		
		function showUser(type,id) {
			if (id == "") {
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else { 
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET","command/getReference.php?libraryType="+type+"&libraryID="+id,true);
				xmlhttp.send();
			}
		}
	</script>
</body>
</html>
