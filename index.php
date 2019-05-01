<!DOCTYPE html>
<html>
<title>Bibilography Manager</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><style>
body {font-family: "Roboto", sans-serif}
.w3-bar-block .w3-bar-item {
  padding: 16px;
  font-weight: bold;
}
</style>
<body>



<!--This part is used make header visible when scrolled down-->
<div class="w3-main" >

<div id="myTop" class="w3-container w3-top w3-theme ">
  <p>
  <span id="myIntro" class="w3-hide">Bibliography Manager</span></p>
</div>

<!-- <header class="w3-container w3-theme" style="padding:34px"> -->
<header class="w3-container w3-theme" style="height:100px !important; text-align:center;">
  <h1 class="w3-xxxlarge">Bibliography Manager</h1>
</header>
<iframe class="w3-container" height="630px" width="100%" style="" src="Signin.html" name="iframe_a">
  </iframe>
  <footer class="w3-container w3-theme" style="position: fixed;width: 100%;text-align: center;">
  <p>© copyright Maynooth Students</p>
</footer>


</div>

<script>


// Change style of top container on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("myTop").classList.add("w3-card-4", "w3-animate-opacity");
    document.getElementById("myIntro").classList.add("w3-show-inline-block");
  } else {
    document.getElementById("myIntro").classList.remove("w3-show-inline-block");
    document.getElementById("myTop").classList.remove("w3-card-4", "w3-animate-opacity");
  }
}


</script>

</body>
</html>
