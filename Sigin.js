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
<div class="w3-main" style="margin-left:250px;">

<div id="myTop" class="w3-container w3-top w3-theme w3-large">
  <p>
  <span id="myIntro" class="w3-hide">Bibliography Manager</span></p>
</div>

<header class="w3-container w3-theme" style="padding:64px 32px">
  <h1 class="w3-xxxlarge">Bibliography Manager</h1>
</header>
<!--end of head part-->
<div class="w3-container" style="padding:32px">





<div class="w3-panel w3-light-grey w3-padding-16 w3-card">
<h3 class="w3-center">Sign In</h3>
<div class="w3-content" style="max-width:800px">
<a href="tryw3css_templates_band.htm" target="_self"  title="sign-in">
<div class="w3-row">
  <div class="w3-col m6">
    <a href="tryw3css_templates_band.htm" target="_blank" class="w3-button w3-padding-large w3-dark-grey" style="width:98.5%">Demo</a>
  </div>
  <div class="w3-col m6">
    <a href="w3css_templates.asp" class="w3-button w3-padding-large w3-dark-grey" style="width:98.5%">More Templates »</a>
  </div>
</div>





</div>

</div>

<footer class="w3-container w3-theme" style="padding:32px">
  <p>Developed by Yash, Hung & Sam</p>
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
