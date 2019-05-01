<?php require_once('../Connections/connSQL.php'); ?>
<!DOCTYPE html>
<html>
<title>Bibilography Manager User Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="Style.css">
<link rel="stylesheet" href="dashboardstyle.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--jquery file added-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<style>
body {font-family: "Roboto", sans-serif}
.w3-bar-block .w3-bar-item {
  padding: 16px;
  font-weight: bold;
}

#table-wrapper {
	position:relative;
}
#table-scroll {
  height:100px;
  overflow:auto;  
  margin-top:65px;
}

/* styles for share_table*/
#share_table{
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#share_table th {
  border-style: inset;
  padding-left: 5px;
}

#share_table td {
  padding: 8px;
  padding-left: 5px;
}

#share_table tr:nth-child(even){background-color: #f2f2f2;}

#share_table tr:hover {background-color: #ddd;}

#share_table thead tr th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: black;
  color: white;
  position:absolute; 
  top:-65px; 
  z-index:2; 
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

<?php
	//do{
		//echo $totalRows_RecLibraryInfo;
	//}while($row_RecLibraryInfo = mysqli_fetch_assoc($RecLibraryInfo));
?>
	<ul>
		<li><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal_createLibrary">Create New Library</button></li>
		<li><button id="mybutton_updateLibrary" type="button" class="btn btn-info btn-lg" data-toggle="modal" onclick="showLibrary();">Update Library</button></li>
		<li><button id="mybutton_deleteLibrary" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal_deleteLibrary">Delete Library</button></li>
		<!--<li><button type="button" class="btn btn-info btn-lg" onclick="deleteLibrary()">Delete Library</button></li>-->
	</ul>
	
	<p>
	<table style="table-layout: fixed;">
		<form id="form" name="thisform" enctype="multipart/form-data" method="post" action="command/command.php?table=sharelibrarytable&page=OpenLibrary">
			<tr>
				<td style="width:500px; border-style: groove;">
					
						<div id="table-wrapper">
						<div id="table-scroll">
						<table id="share_table">
							<thead>
								<tr>
									<th style="width:100%;">
										<h4>
										<input type="checkbox" onclick="select_all(this,'library');" />Library
										</h4>
									</th>
								</tr>
							</thead>
							<tbody id ="txtLibrary">
								<?php 	$query_RecWebInfo = "SELECT * FROM librarytable where userID = '$userID'";
										//$RecShareLibraryInfo = mysqli_query($connSQL, $query_RecWebInfo) or die(mysql_error());
										$RecShareLibraryInfo = $pdo->query($query_RecWebInfo);
										
										//while ($row_RecShareLibraryInfo = mysqli_fetch_assoc($RecShareLibraryInfo))
										while ($row_RecShareLibraryInfo = $RecShareLibraryInfo->fetch())
										{
										?>
											<tr>
												<td>
													<input type="checkbox" name="check_ShareLibraryList[]" value="<?php echo $row_RecShareLibraryInfo['libraryID'];?>">
													<span style="color:mediumblue" onclick="showInfo('userAndLibrary','<?php echo $row_RecShareLibraryInfo['libraryID'];?>')"><?php echo $row_RecShareLibraryInfo['libraryName'];?></span>
												</td>
											</tr>
								<?php 	} ?>
										
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
												if($userID == $list_sharelibraryID[$i] && ($userID != $row_RecLibraryInfo['userID'])){
										?>
													<tr>
														<td>
															<input type="checkbox" name="check_ShareLibraryList[]" value="<?php echo $row_RecLibraryInfo['libraryID'];?>">
															<span style="color:mediumblue" onclick="showInfo('userAndLibrary','<?php echo $row_RecLibraryInfo['libraryID'];?>')"><?php echo $row_RecLibraryInfo['libraryName'];?></span>
														</td>
													</tr>
										<?php 			
													break;
												}
											}
										} ?>								
							</tbody>
						</table>
						</div>
						</div>
				</td>
				<td style="width:10%;">
				</td>
				<td style="width:500px; border-style: groove; height:150px;">
						<div id="table-wrapper">
						<div id="table-scroll">
						<table id="share_table">
							<thead>
								<tr>
									<th style="width:100%;"><h4>Shared with User</h4></th>
								</tr>
							</thead>
							<tbody id ="txtShareWithUser">	
								<tr></tr>
							</tbody>
						</table>
						</div>
						</div>
				</td>
			</tr>
			<tr>
				<td>
						<div style="height:5px;"></div>
				</td>
			</tr>
			<table>
				<tr>
					<td>
						<!--
						<input  type="submit" name="Update" value="Update" style="float:left;"></input>
						<input  type="submit" name="Create" value="Create" style="float:left;"></input>
						<input  type="submit" name="Delete" value="Delete" style="float:left;"></input>
						-->
						
					</td>
				</tr>
			</table>
		</form>
	</table>
	<p style="height:20px;">
	
	<ul>
		<li><button id="mybutton_addReference" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Record</button></li>
		<li><button id="mybutton_updateReference" type="button" class="btn btn-info btn-lg" data-toggle="modal" onclick="openModal_Reference('updateReference');">Update Reference</button></li>
		<li><button id="mybutton_deleteReference" type="button" class="btn btn-info btn-lg" data-toggle="modal" onclick="openModal_Reference('deleteReference');">Delete Reference</button></li>
		<li><button id="mybutton_addToOtherLibrary" type="button" class="btn btn-info btn-lg" data-toggle="modal" onclick="openModal_Reference('addToOtherLibrary');">Add To Other Library</button></li>
		<li><button id="mybutton_removeFromLibrary" type="button" class="btn btn-info btn-lg" data-toggle="modal" onclick="openModal_Reference('removeFromLibrary');">Remove From Library</button></li>
	</ul>
	
	<!--table-->
	<form id="form" name="thisform" enctype="multipart/form-data" method="post" action="command/command.php?table=sharelibrarytable&page=OpenLibrary">
		<table id="customers">
			<thead>
				<tr>
					<th><input type="checkbox" onclick="select_all(this, 'reference');" />Library</th>
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
				<?php
					$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID'");
					while($row = $stmt->fetch()) {
						$refernce_libraryID = $row['libraryID'];
						$stmt_lib = $pdo->query("SELECT * FROM librarytable where libraryID='$refernce_libraryID'");
						$row_lib = $stmt_lib->fetch();
												
						echo "<input type='text' id='libraryID' name='libraryID' value='0' hidden />";
						//echo "<input type='text' id='libraryName' name='libraryName' value='".$row_lib['libraryName']."' hidden />";
						//if($DataInfo==$row['libraryID']){
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
						//}
					}
				?>
			</tbody>
			
		</table>
	</form>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Insert Data</h4>
      </div>
      <div class="modal-body">

        <form action="command/control_book.php" method="post">

      <diV class="row">
  
      <div class="col-sm-4">Entry Type </div>
      <div class="col-sm-8">
      <input type="text" name="entryType" require_once>
       </div><br/><br/>
      <div class="col-sm-4">Author </div>
      <div class="col-sm-8"><input type="text" name="author"> </div><br/>
      <tr id='BookTitle'>
      <div class="col-sm-4" >Book Title </div>
      <div class="col-sm-8"><input type="text" name="booktitle" > </div><br/>
      </tr>
      <div class="col-sm-4">Editor </div>
      <div class="col-sm-8"><input type="text" name="editor" > </div><br/>
      <div class="col-sm-4">Title </div>
      <div class="col-sm-8"><input type="text" name="title" > </div><br/>
      <div class="col-sm-4">Journal </div>
      <div class="col-sm-8"><input type="text" name="journal" ></div> <br/>
      <div class="col-sm-4">Publisher </div>
      <div class="col-sm-8"><input type="text" name="publisher" > </div><br/>
      <div class="col-sm-4">Year </div>
      <div class="col-sm-8"><input type="text" name="year" ></div> <br/>
      <div class="col-sm-4">Volume </div>
      <div class="col-sm-8"><input type="text" name="volume" > </div><br/>
      <input type="submit" value="Insert" name="submitData" >

         </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div class="modal fade" id="modal_updateReference" role="dialog" aria-labelledby="dialog1Title" aria-describedby="dialog1Desc">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Insert Data</h4>
      </div>
      <div class="modal-body">

        <form action="command/control_book.php" method="post">

      <diV class="row">
  
      <div class="col-sm-4">Entry Type </div>
      <div class="col-sm-8">
      <input type="text" name="entryType" require_once>
       </div><br/><br/>
      <div class="col-sm-4">Author </div>
      <div class="col-sm-8"><input type="text" name="author"> </div><br/>
      <tr id='BookTitle'>
      <div class="col-sm-4" >Book Title </div>
      <div class="col-sm-8"><input type="text" name="booktitle" > </div><br/>
      </tr>
      <div class="col-sm-4">Editor </div>
      <div class="col-sm-8"><input type="text" name="editor" > </div><br/>
      <div class="col-sm-4">Title </div>
      <div class="col-sm-8"><input type="text" name="title" > </div><br/>
      <div class="col-sm-4">Journal </div>
      <div class="col-sm-8"><input type="text" name="journal" ></div> <br/>
      <div class="col-sm-4">Publisher </div>
      <div class="col-sm-8"><input type="text" name="publisher" > </div><br/>
      <div class="col-sm-4">Year </div>
      <div class="col-sm-8"><input type="text" name="year" ></div> <br/>
      <div class="col-sm-4">Volume </div>
      <div class="col-sm-8"><input type="text" name="volume" > </div><br/>
      <input type="submit" value="Insert" name="submitData" >

         </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<fieldset class="modal fade" id="myModal_deleteReference" role="dialog" aria-labelledby="dialog1Title" aria-describedby="dialog1Desc">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Delete Reference</h4>
			</div>
			<div class="modal-body">
				<form name="form_deleteReference" onsubmit="reference_operator('deleteReference',<?php echo $userID?>)">
					<div class="row">
						
						<div class="col-sm">Are you sure to delete the selected references from the library?</div>
						

						<input type="submit" value="Delete" name="submitData">

					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</fieldset>

<fieldset class="modal fade" id="myModal_createLibrary" role="dialog" aria-labelledby="dialog1Title" aria-describedby="dialog1Desc">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Create Library</h4>
			</div>
			<div class="modal-body">
				<form action="dashboard.php?lastpage=openlibrary" name="form_createNewLibrary" onsubmit="library_operator('createNewLibrary',<?php echo $userID?>)">
					<div class="row">

						<div class="col-sm-4">Library Name</div>
						<div class="col-sm-8">
							<input type="text" id="libraryName_create" name="libraryName" required>
						</div>

						<input type="submit" value="Create" name="submitData">

					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</fieldset>

<fieldset class="modal fade" id="myModal_updateLibrary" role="dialog" aria-labelledby="dialog1Title" aria-describedby="dialog1Desc">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Update Library</h4>
			</div>
			<div class="modal-body">
				<form name="form_updateLibrary" onsubmit="library_operator('updateLibrary',<?php echo $userID?>)">
					<div class="row" id="txtUpdateLibrary">

						<div class="col-sm-4">Library Name</div>
						<div class="col-sm-8">
							<input type="text" id="libraryName_update" name="libraryName" required>
						</div>
						
						<div class="col-sm-4">Share with User</div>
						<div class="col-sm-8">
							<input type="text" id="shareWithUser_update" name="shareWithUser">
						</div>

						<input type="submit" value="Update" name="submitData">

					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</fieldset>

<fieldset class="modal fade" id="myModal_deleteLibrary" role="dialog" aria-labelledby="dialog1Title" aria-describedby="dialog1Desc">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Delete Library</h4>
			</div>
			<div class="modal-body">
				<form name="form_deleteLibrary" onsubmit="library_operator('deleteLibrary',<?php echo $userID?>)">
					<div class="row" id="txtDeleteLibrary">

						<div class="col-sm">Are you sure to delete the selected libraries?</div>

						<input type="submit" value="Delete" name="submitData">

					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</fieldset>

<fieldset class="modal fade" id="myModal_addToOtherLibrary" role="dialog" aria-labelledby="dialog1Title" aria-describedby="dialog1Desc">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add to other Library</h4>
			</div>
			<div class="modal-body">
				<form name="form_addToOtherLibrary" onsubmit="reference_operator('addToOtherLibrary',<?php echo $userID?>)">
					<div class="row">

						<div class="col-sm-4">Original Library</div>
						<div class="col-sm-8">
							<input type="text" id="libraryID_Origin" name="libraryID_Origin" required>
						</div>
						
						<div class="col-sm-4">Destination Library</div>
						<div class="col-sm-8">
							<input type="text" id="libraryID_Dest" name="libraryID_Dest" required>
							<input type='text' id='libraryID_DestID' name='libraryID_DestID' hidden>
							<input type='button' value='Search Library' onclick='openWindow_searchLibrary(<?php echo $userID?>)'>
						</div>
						

						<input type="submit" value="Add To" name="submitData">

					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</fieldset>

<fieldset class="modal fade" id="myModal_removeFromLibrary" role="dialog" aria-labelledby="dialog1Title" aria-describedby="dialog1Desc">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Remove From Library</h4>
			</div>
			<div class="modal-body">
				<form name="form_removeFromLibrary" onsubmit="reference_operator('removeFromLibrary',<?php echo $userID?>)">
					<div class="row">

						<div class="col-sm-4">Original Library</div>
						<div class="col-sm-8">
							<input type="text" id="libraryID_Origin" name="libraryID_Origin" required>
						</div>
						
						<div class="col-sm-4"></div>
						<div class="col-sm">Are you sure to delete the selected references from the library?</div>
						

						<input type="submit" value="Remove From" name="submitData">

					</div>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</fieldset>

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
		
		function showInfo(type,id) {
			if(type != "userAndLibrary"){
				document.getElementById("txtShareWithUser").innerHTML = "";
			}
			
			if (id == "") {
				document.getElementById("txtHint").innerHTML = "";
				document.getElementById("txtShareWithUser").innerHTML = "";
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
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
					}
				};
				xmlhttp.open("GET","command/getReference.php?DataType=reference"+"&DataInfo="+id,true);
				xmlhttp.send();
				
				if(type == "userAndLibrary"){
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp_user = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xmlhttp_user = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp_user.onreadystatechange = function() {
						if (xmlhttp_user.readyState == 4 && xmlhttp_user.status == 200) {
							document.getElementById("txtShareWithUser").innerHTML = xmlhttp_user.responseText;
						}
					};
					xmlhttp_user.open("GET","command/getReference.php?DataType="+type+"&DataInfo="+id,true);
					xmlhttp_user.send();
				}
				
				
			}
		}
		
		function showLibrary() {
			var cboxes = document.getElementsByName('check_ShareLibraryList[]');
			var len = cboxes.length;
			var count_checked_cboxes = 0;
			var value_checked_cboxes = '';
			for (var i=0; i<len; i++) {
				if(cboxes[i].checked){
					count_checked_cboxes++;
					value_checked_cboxes = cboxes[i].value;
				}
				//alert(i + (cboxes[i].checked?' checked ':' unchecked ') + cboxes[i].value);
			}
			if(count_checked_cboxes == 1){
				$("#myModal_updateLibrary").modal();
				
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						//document.getElementById("libraryName_update").value = xmlhttp.responseText;
						document.getElementById("txtUpdateLibrary").innerHTML = xmlhttp.responseText;
					}
				};
				xmlhttp.open("GET","command/getReference.php?DataType=libraryDetail"+"&DataInfo="+value_checked_cboxes,true);
				xmlhttp.send();
			}else{
				alert("the amount of the selected libraries needs to be 1");
				return;
			}
		}
		
		function select_all(source, type) {
			if(type=='library'){
				var checkboxes = document.getElementsByName('check_ShareLibraryList[]');
			}else if(type=='reference'){
				var checkboxes = document.getElementsByName('check_ReferenceList[]');
			}
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i] != source)
					checkboxes[i].checked = source.checked;
			}
		}
		
		function library_operator(parameter, userID) {
			if(parameter == "createNewLibrary"){
				//alert(document.forms["form_createNewLibrary"]["libraryName"].value);
				
				var data = new FormData();
				data.append('libraryName', document.forms["form_createNewLibrary"]["libraryName"].value);
				data.append('userID', userID);

				url1 = "command/command.php?page=OpenLibrary&table=librarytable&operator=create";
				//url2 = "command/getReference.php?DataType=library";
				var index = [url1];//, url2];
				var xhr = new XMLHttpRequest();
				(function loop(i, length) {
					if (i>= length) {
						return;
					}
					
					//var url = index[i];
					
					if(i==0){
						xhr.open('POST', url1, true);
						//Send the proper header information along with the request
						//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

						xhr.onreadystatechange = function() {//Call a function when the state changes.
							if(xhr.readyState == 4 && xhr.status == 200) {
								alert(xhr.responseText);
								loop(i + 1, length);
							}
						}
						xhr.send(data);
					}else if(i==1){
						document.getElementById("txtLibrary").innerHTML = "";
						if (window.XMLHttpRequest) {
							// code for IE7+, Firefox, Chrome, Opera, Safari
							xmlhttp = new XMLHttpRequest();
						} else {
							// code for IE6, IE5
							xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
							if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
								document.getElementById("txtLibrary").innerHTML = xmlhttp.responseText;
								loop(i + 1, length);
							}
						};
						xmlhttp.open("GET","command/getReference.php?DataType=library"+"&DataInfo=1",true);
						xmlhttp.send();
					}					
				})(0, index.length);
				
			}else if(parameter == "updateLibrary"){
				var cboxes = document.getElementsByName('check_ShareLibraryList[]');
				var len = cboxes.length;
				var value_checked_cboxes = '';
				for (var i=0; i<len; i++) {
					if(cboxes[i].checked){
						value_checked_cboxes = cboxes[i].value;
					}
					//alert(i + (cboxes[i].checked?' checked ':' unchecked ') + cboxes[i].value);
				}
				var data = new FormData();
				data.append('libraryID', value_checked_cboxes);
				data.append('libraryName', document.forms["form_updateLibrary"]["libraryName"].value);
				data.append('shareUser', document.forms["form_updateLibrary"]["shareUserID"].value);

				url1 = "command/command.php?page=OpenLibrary&table=librarytable&operator=update";
				var xhr = new XMLHttpRequest();
				
				xhr.open('POST', url1, true);
				//Send the proper header information along with the request
				//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

				xhr.onreadystatechange = function() {//Call a function when the state changes.
					if(xhr.readyState == 4 && xhr.status == 200) {
						alert(xhr.responseText);
					}
				}
				xhr.send(data);
			}else if(parameter == "deleteLibrary"){
				var cboxes = document.getElementsByName('check_ShareLibraryList[]');
				var len = cboxes.length;
				var count_checked_cboxes = 0;
				var value_checked_cboxes = '';
				for (var i=0; i<len; i++) {
					if(cboxes[i].checked){
						count_checked_cboxes++;
						if(count_checked_cboxes>1){
							value_checked_cboxes += ",";
						}
						value_checked_cboxes += (cboxes[i].value);
					}
					//alert(i + (cboxes[i].checked?' checked ':' unchecked ') + cboxes[i].value);
				}
				
				var txt;
				var result = confirm("Are you sure to delete the selected libraries? ("+count_checked_cboxes+" libraries:" + value_checked_cboxes+")");
				if (result == true) {
					var data = new FormData();
					data.append('deleteLibrary', value_checked_cboxes);

					url1 = "command/command.php?page=OpenLibrary&table=librarytable&operator=delete";
					var xhr = new XMLHttpRequest();
					
					xhr.open('POST', url1, true);
					//Send the proper header information along with the request
					//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

					xhr.onreadystatechange = function() {//Call a function when the state changes.
						if(xhr.readyState == 4 && xhr.status == 200) {
							alert(xhr.responseText);
						}
					}
					xhr.send(data);
				}
			}
		}
		
		function openWindow_searchUser(){
			window.open('command/searchUser.php?shareUserID='+document.forms["form_updateLibrary"]["shareUserID"].value,'_blank','height=400,width=400');
		}
		
		function openWindow_searchLibrary(userID){
			window.open('command/searchLibrary.php?userID='+userID+'&libraryID_Origin='+document.getElementById("libraryID").value,'_blank','height=400,width=400');
		}
		
		function deleteLibrary() {
			var cboxes = document.getElementsByName('check_ShareLibraryList[]');
			var len = cboxes.length;
			var count_checked_cboxes = 0;
			var value_checked_cboxes = '';
			for (var i=0; i<len; i++) {
				if(cboxes[i].checked){
					count_checked_cboxes++;
					if(count_checked_cboxes>1){
						value_checked_cboxes += ",";
					}
					value_checked_cboxes += (cboxes[i].value);
				}
				//alert(i + (cboxes[i].checked?' checked ':' unchecked ') + cboxes[i].value);
			}
			
			/*
			var txt;
			var result = confirm("Are you sure to delete the selected libraries? ("+count_checked_cboxes+" libraries:" + value_checked_cboxes+")");
			if (result == true) {
				var data = new FormData();
				data.append('deleteLibrary', value_checked_cboxes);

				url1 = "command/command.php?page=OpenLibrary&table=librarytable&operator=delete";
				var xhr = new XMLHttpRequest();
				
				xhr.open('POST', url1, true);
				//Send the proper header information along with the request
				//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

				xhr.onreadystatechange = function() {//Call a function when the state changes.
					if(xhr.readyState == 4 && xhr.status == 200) {
						alert(xhr.responseText);
					}
				}
				xhr.send(data);
			}
			*/
		}
		
		function openModal_Reference(param){
			var cboxes = document.getElementsByName('check_ReferenceList[]');
			var len = cboxes.length;
			var count_checked_cboxes = 0;
			for (var i=0; i<len; i++) {
				if(cboxes[i].checked){
					count_checked_cboxes++;
				}
				//alert(i + (cboxes[i].checked?' checked ':' unchecked ') + cboxes[i].value);
			}
			
			if(count_checked_cboxes==0){
				alert("Please choose at least one reference!");
				return;
			}
			
			if((param="updateReference")&&(count_checked_cboxes!=1)){
				alert("Please choose only one reference!");
				return;
			}
			
			if(param == "addToOtherLibrary"){				
				document.forms["form_addToOtherLibrary"]["libraryID_Origin"].value = document.getElementById("libraryName").value;
				
				$("#myModal_addToOtherLibrary").modal();
			}else if(param == "removeFromLibrary"){			
				document.forms["form_removeFromLibrary"]["libraryID_Origin"].value = document.getElementById("libraryName").value;
				
				$("#myModal_removeFromLibrary").modal();
			}else if(param == "deleteReference"){
				$("#myModal_deleteReference").modal();
			}else if(param="updateReference"){
				$("#modal_updateReference").modal();
			}
		}
		
		function reference_operator(type, userID){
			if(type == "addToOtherLibrary"){
				var cboxes = document.getElementsByName('check_ReferenceList[]');
				var len = cboxes.length;
				var value_checked_cboxes = '';
				for (var i=0; i<len; i++) {
					if(cboxes[i].checked){
						value_checked_cboxes += (cboxes[i].value+",");
					}
					//alert(i + (cboxes[i].checked?' checked ':' unchecked ') + cboxes[i].value);
				}
				
				var data = new FormData();
				data.append('value_checked_cboxes', value_checked_cboxes);
				data.append('libraryID_DestID', document.forms["form_addToOtherLibrary"]["libraryID_DestID"].value);
				data.append('userID', userID);
				
				url1 = "command/command.php?page=OpenLibrary&table=referencetable&operator=addToOtherLibrary";
				var xhr = new XMLHttpRequest();
				
				xhr.open('POST', url1, true);
				//Send the proper header information along with the request
				//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

				xhr.onreadystatechange = function() {//Call a function when the state changes.
					if(xhr.readyState == 4 && xhr.status == 200) {
						alert(xhr.responseText);
					}
				}
				xhr.send(data);
			}else if(type=="removeFromLibrary"){
				var cboxes = document.getElementsByName('check_ReferenceList[]');
				var len = cboxes.length;
				var count_checked_cboxes = 0;
				var value_checked_cboxes = '';
				for (var i=0; i<len; i++) {
					if(cboxes[i].checked){
						count_checked_cboxes++;
						if(count_checked_cboxes>1){
							value_checked_cboxes += ",";
						}
						value_checked_cboxes += (cboxes[i].value);
					}
					//alert(i + (cboxes[i].checked?' checked ':' unchecked ') + cboxes[i].value);
				}
				
				var txt;
				var result = confirm("Are you sure to delete the selected references? ("+count_checked_cboxes+" references:" + value_checked_cboxes+")");
				if (result == true) {
					var data = new FormData();
					data.append('deleteReference', value_checked_cboxes);

					url1 = "command/command.php?page=OpenLibrary&table=referencetable&operator=delete";
					var xhr = new XMLHttpRequest();
					
					xhr.open('POST', url1, true);
					//Send the proper header information along with the request
					//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

					xhr.onreadystatechange = function() {//Call a function when the state changes.
						if(xhr.readyState == 4 && xhr.status == 200) {
							alert(xhr.responseText);
						}
					}
					xhr.send(data);
				}
			}else if(type=="deleteReference"){
				var cboxes = document.getElementsByName('check_ReferenceList[]');
				var len = cboxes.length;
				var count_checked_cboxes = 0;
				var value_checked_cboxes = '';
				for (var i=0; i<len; i++) {
					if(cboxes[i].checked){
						count_checked_cboxes++;
						if(count_checked_cboxes>1){
							value_checked_cboxes += ",";
						}
						value_checked_cboxes += (cboxes[i].value);
					}
					//alert(i + (cboxes[i].checked?' checked ':' unchecked ') + cboxes[i].value);
				}
				
				var txt;
				//var result = confirm("Are you sure to delete the selected references? ("+count_checked_cboxes+" references:" + value_checked_cboxes+")");
				//if (result == true) {
					var data = new FormData();
					data.append('deleteReference', value_checked_cboxes);

					url1 = "command/control_book.php?operator=deleteReference";
					var xhr = new XMLHttpRequest();
					
					xhr.open('POST', url1, true);
					//Send the proper header information along with the request
					//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

					xhr.onreadystatechange = function() {//Call a function when the state changes.
						if(xhr.readyState == 4 && xhr.status == 200) {
							//alert(xhr.responseText);
						}
					}
					xhr.send(data);
				//}
			}
		}
	</script>
</body>
</html>
