<?php require_once('../Connections/connSQL.php'); ?>
<?php
mysqli_select_db($connSQL, $database_connSQL);
$lastpage = "";
if(isset($_GET['lastpage'])){
	$lastpage = $_GET['lastpage'];
}
?>

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
   
   $('#Home').load("OpenLibrary.php");

});

$(document).ready(function(){
   
   $('#OpenLibrary').load("OpenLibrary.php");

});

$(document).ready(function(){
   
   $('#Update').load("Update.html");

});
$(document).ready(function(){
   
   $('#Trash').load("DeleteTrash.php");

});
</script>
<body>

<div class="w3-container">
  

  <div class="w3-bar w3-black">
    <button class="w3-bar-item w3-button tablink w3-red w3-mobile" onclick="openCity(event,'Home')">Home</button>
    
    
    <button class="w3-bar-item w3-button tablink w3-mobile" onclick="openCity(event,'OpenLibrary')">Library</button>

    <button class="w3-bar-item w3-button tablink w3-mobile" onclick="openCity(event,'Update')">Update Details</button>
    <button class="w3-bar-item w3-button tablink w3-mobile" onclick="openCity(event,'Trash')">Trash</button>
	<span class="w3-bar-item w3-right"><a href="Signin.html" style="text-decoration: none; color: white;">Logout</a></span>
  </div>
  
  <?php if($lastpage!="openlibrary"){ ?>
  <div id="Home" class="w3-container w3-border city">
  <?php }else{ ?>
  <div id="Home" class="w3-container w3-border city" style="display:none">
  <?php } ?>
  </div>

  <?php if($lastpage=="openlibrary"){ ?>
  <div id="OpenLibrary" class="w3-container w3-border city">
  <?php }else{ ?>
  <div id="OpenLibrary" class="w3-container w3-border city" style="display:none">
  <?php } ?>
  </div>
  

  <div id="Update" class="w3-container w3-border city" style="display:none">
    
  </div>
  <div id="Trash" class="w3-container w3-border city" style="display:none">
    
  </div>
</div>

<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
</script>

</body>
</html>
