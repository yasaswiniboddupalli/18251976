<?php include('../Connections/connSQL.php'); ?>
<?php
mysqli_select_db($connSQL, $database_connSQL);
?>

<!DOCTYPE html>

<html>
<title>Bibilography Manager User Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/Style.css">
<link rel="stylesheet" href="css/dashboardstyle.css">
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

</style>
<body>
<div class="w3-container" style="padding:32px">
<!--Home of user dashboard--->

  <!--Code to print user name--->
<h4 style="text-align:left">
  <?php
    $userEmailId =$_SESSION["email"];
    $sql = "SELECT userID, firstName FROM userTable WHERE email = '$userEmailId'";
    $result = $connSQL->query($sql);
    if(true) {
     while($row = $result->fetch_assoc()) {
  	   $id = $row["userID"];


  }}
  ?>
</h4>

<form id="form" name="thisform" enctype="multipart/form-data" method="post" action="command/control_book.php?operator=DeleteTrash">

	<ul style="border-radius:32px !important; width:31% !important;">
		<li><input type="submit" class="btn btn-lg" style="border-radius:38px;width: 185px;  background-color:cadetblue;" value="Restore Selected" name="restore" ></li>
        <li><input type="submit" class="btn btn-lg" style="border-radius:38px;width: 185px;  background-color:cadetblue;" value="Empty Trash" name="delete" ></li>
	</ul>

<table id="customers" class=" table order-list">
  <thead>


      <tr>
		<th><input type="checkbox" onclick="selectall(this);" />Reference</th>
        <!--<th>ReferenceID</th>-->
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

<?php
    // to get the user id of the loggedin user
      // each checkbox is given referenceId so that we can delete  them easily
      if(!empty($_POST['selectedcheckbox'])&& isset($_POST['restore'])){
        // Loop to store and display values of individual checked checkbox.
        foreach($_POST['selectedcheckbox'] as $selected){
          $sqldelete = "UPDATE referenceTable SET isDelete = 0 WHERE referenceID='$selected'";
          $result2 = $connSQL->query($sqldelete);
        }
      }

      // each checkbox is given referenceId so that we can delete  them easily
  if(!empty($_POST['selectedcheckbox'])&& isset($_POST['delete'])){
  // Loop to store and display values of individual checked checkbox.
  foreach($_POST['selectedcheckbox'] as $selected){
    $sqldelete = "DELETE from referenceTable WHERE referenceID='$selected'";
    $result2 = $connSQL->query($sqldelete);
  }
  }



    // to show all the data of the loged in user
    $sql = "SELECT referenceID, entryType, author, bookTitle, editor, title, journal, publisher, year, volume FROM referenceTable WHERE isDelete = 1 and userID='$id'";
    $result = $connSQL->query($sql);
    if ($result->num_rows > 0)
    {
     // output data of each row
     while($row = $result->fetch_assoc())
      {
        $selected = $row["referenceID"];
        //echo "<tr><td><input type='checkbox' name='selectedcheckbox[]' value='$selected' ></td><td>". $row["referenceID"]. "</td><td>". $row["entryType"] . "</td><td>"
        echo "<tr><td><input type='checkbox' name='selectedcheckbox[]' value='$selected' ></td><td>". $row["entryType"] . "</td><td>"
          . $row["author"]. "</td><td>" . $row["bookTitle"]. "</td><td>" . $row["editor"] . "</td><td>"
             . $row["title"]. "</td><td>" . $row["journal"]. "</td><td>" . $row["publisher"] . "</td><td>"
             . $row["year"]. "</td><td>" . $row["volume"]. "</td></tr>";
      }
        echo "</table>";
    } else{ echo "0 results found"; }



?>


	</thead>
</table>
    </form>






</div>


</div>
</body>
<script>
	function selectall(source) {
			var checkboxes = document.getElementsByName('selectedcheckbox[]');

		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i] != source)
				checkboxes[i].checked = source.checked;
		}
	}
</script>
</html>
