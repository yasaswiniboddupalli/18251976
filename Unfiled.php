<?php require_once('../Connections/connSQL.php'); ?>
<?php
mysqli_select_db($connSQL, $database_connSQL);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--jquery file added-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
  $userEmailId =$_SESSION["user"];
  $sql = "SELECT firstName FROM userTable WHERE email = '$userEmailId'";
  $result = $connSQL->query($sql);
  if(true) {
   while($row = $result->fetch_assoc()) {
  echo "Hello"." ".$row["firstName"];
}}
?>
</h4>


<h4 style="text-align:center">Unfiled Data</h4>

<!--table-->
<table id="customers" class=" table order-list">
  <thead>
    <form id="form" name="thisform" enctype="multipart/form-data" method="post" action="Unfiled.php">

      <tr>
        <th><input type="submit" value="Delete" name="submit" class="btn btn-info btn-lg"></th>
        <th>ReferenceID</th>
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

<?php
    // to get the user id of the loggedin user
    $user = "SELECT userID FROM userTable WHERE email = '$userEmailId'";
    $result1 = $connSQL->query($user);
    $row1 = mysqli_fetch_assoc($result1);
    $id = $row1["userID"];

    // each checkbox is given referenceId so that we can delete  them easily
        if(!empty($_POST['selectedcheckbox'])){
        			// Loop to store and display values of individual checked checkbox.
        			foreach($_POST['selectedcheckbox'] as $selected){
        				$sqldelete = "UPDATE referenceTable SET isDelete = 1 WHERE referenceID='$selected'";
                $result2 = $connSQL->query($sqldelete);
        			}
        		}

    // to show all the data of the loged in user
    $sql = "SELECT referenceID, entryType, author, bookTitle, editor, title, journal, publisher, year, volume FROM referenceTable WHERE isDelete = 0 and user_ID='$id'";
    $result = $connSQL->query($sql);
    if ($result->num_rows > 0)
    {
     // output data of each row
     while($row = $result->fetch_assoc())
      {
        $selected = $row["referenceID"];
        echo "<tr><td><input type='checkbox' name='selectedcheckbox[]' value='$selected' ></td><td>". $row["referenceID"]. "</td><td>". $row["entryType"] . "</td><td>"
          . $row["author"]. "</td><td>" . $row["bookTitle"]. "</td><td>" . $row["editor"] . "</td><td>"
             . $row["title"]. "</td><td>" . $row["journal"]. "</td><td>" . $row["publisher"] . "</td><td>"
             . $row["year"]. "</td><td>" . $row["volume"]. "</td></tr>";
      }
        echo "</table>";
    } else{ echo "0 results found"; }


?>
    </form>
</table>



</div>


</div>
</body>
</html>
