<?php include('../Connections/connSQL.php'); ?>
<!Doctype html>
<html>
<head>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><style>
  body {font-family: "Roboto", sans-serif}
  .w3-bar-block .w3-bar-item {
    padding: 16px;
    font-weight: bold;
  }
  .buttonUpdate{
    color: #fff;
    background-color: cadetblue !important;
    width:50% !important;
    border-radius:15px;
    margin-top:16px!important;
    margin-bottom:22px!important;
  }
  </style>
</head>
<body>
<div class="w3-container" style="padding:32px">
  <!--Code to print user name--->
<h4 style="text-align:left">
<?php
  $userEmailId =$_SESSION["email"];
  $sql = "SELECT * FROM userTable WHERE email = '$userEmailId'";
  $result = $connSQL->query($sql);
  if(true) {
   while($row = $result->fetch_assoc()) {
	    $id = $row["userID"];
	    $firstName = $row["firstName"];
	    $lastName = $row["lastName"];
	    $email = $row["email"];
		

}}
?>
</h4>
<div  style="padding:0px">
<!--update form--->
<center>
<form action="command/Update.php?userID=<?=$id;?>" class="w3-container w3-card-4 w3-light-grey w3-text-black w3-margin" style="width:35%;margin-top:50px !important; height:auto;" method="post">
<h2 class="w3-center">Update Details</h2>

	<div class="form-group">
      <label for="firstName" >First Name</label>
      <input type="text" class="form-control" style="width:80%;" id="firstName" name="firstName" value="<?=$firstName;?>">
    </div>
	<div class="form-group">
      <label for="lastName">Last Name</label>
      <input type="text" class="form-control" style="width:80%;" id="lastName" name="lastName" value="<?=$lastName;?>">
    </div>
	<div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" style="width:80%;" id="email" value="<?=$email;?>" name="email" disabled>
    </div>
	<div class="form-group">
      <label for="pwd_origin">Original Password</label>
      <input type="password" class="form-control" style="width:80%;" id="pwd_origin" name="pwd_origin">
    </div>
    <div class="form-group">
      <label for="pwd_new">New Password</label>
      <input type="password" class="form-control" style="width:80%;" id="pwd_new" name="pwd_new">
    </div>
	<div class="form-group">
      <label for="pwd_new_comfirm">Re-type New Password</label>
      <input type="password" class="form-control" style="width:80%;" id="pwd_new_comfirm" name="pwd_new_comfirm">
    </div>
<input type="hidden" name="submitted" value="true">
<input type ="submit" class="w3-button buttonUpdate w3-block w3-section w3-ripple w3-padding" name="Update" value="Update Details">


</form>
</center>
<!-- end of update form--->
</div>
</body>
<script>
var password = document.getElementById("pwd_new")
  , confirm_password = document.getElementById("pwd_new_comfirm");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
</html>
