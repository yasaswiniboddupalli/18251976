<?php include('../Connections/connSQL.php'); ?>
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
  $sql = "SELECT firstName FROM userTable WHERE email = '$userEmailId'";
  $result = $connSQL->query($sql);
  if(true) {
   while($row = $result->fetch_assoc()) {
  echo "Hello"." ".$row["firstName"];
  $id = $row1["userID"];
}}
?>
</h4>


<table id="customers" class=" table order-list">
  <thead>
    <form id="form" name="thisform" enctype="multipart/form-data" method="post" action="DeleteTrash.php">

      <tr>
        <th><input type="submit" value="Restore" name="restore" class="btn btn-info btn-lg">
            <input type="submit" value="Delete Permanently" name="delete" class="btn btn-info btn-lg">
        </th>
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
    //$user = "SELECT userID FROM userTable WHERE email = '$userEmailId'";
    //$result1 = $connSQL->query($user);
    //$row1 = mysqli_fetch_assoc($result1);
    //$id = $row1["userID"];
	echo 1;
      



?>
    </form>
</table>







</div>


</div>
</body>
</html>
