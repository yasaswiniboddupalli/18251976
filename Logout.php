<!-- to close the session -->
<?php
SESSION_start();
SESSION_destroy();
header('location:Signin.html');
 ?>
