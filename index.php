<!DOCTYPE html>
<html>
<title>Bibilography Manager</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><style>

body {font-family: "Roboto", sans-serif;
background-image: url('./Images/Books.jpg');
background-repeat: no-repeat;
background-size: 1440px 788px;
}

.w3-bar-block .w3-bar-item {
  padding: 16px;
  font-weight: bold;

}
.headerFooter{
  color: #fff;
  background-color: transparent;
}
</style>
<body>



<!--This part is used make header visible when scrolled down-->
<div class="w3-main" >

   <div id="myTop" class="w3-container w3-top headerFooter" style="background-color:black !important">
      <p>
      <span id="myIntro" class="w3-hide">Bibliography Manager</span>
      </p>
   </div>


<header class="w3-container w3-card-4  headerFooter" style="height:75px !important; text-align:center;">
  <h1 style="font-size: 44px; margin-top: 6px;" >Bibliography Manager</h1>
</header>
<iframe height="685px" width="100%" style="border-width: 0px !important; margin-bottom: -6px;" src="Signin.html" name="iframe_a">
  </iframe>
  <footer class="w3-container w3-card-4 headerFooter" style="position: fixed;width: 100%;text-align: center; background-color: black !important; font-style:bold">
  <p style="margin-top: 2px;">© Copyright Maynooth Students</p>
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
