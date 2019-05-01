<?php require_once('../../Connections/connSQL.php'); ?>
<?php
	  $userEmailId =$_SESSION["email"];
      $user = "SELECT userID FROM userTable WHERE email = '$userEmailId'";
      $result1 = $connSQL->query($user);
      $row = mysqli_fetch_assoc($result1);
      $id = $row["userID"];

      if (isset($_REQUEST["submitData"]))
      {
        $entryType  = $_POST['entryType'];
        $author = $_POST['author'];
        $booktitle = $_POST['bookTitle'];
        $editor = $_POST['editor'];
        $title = $_POST['title'];
        $journal = $_POST['journal'];
        $publisher = $_POST['publisher'];
        $year = $_POST['year'];
        $volume = $_POST['volume'];

            $addsql = "Insert into referenceTable(entryType, author, bookTitle, editor, title, journal, publisher, year, volume, userID) values('$entryType','$author','$booktitle','$editor','$title','$journal','$publisher','$year','$volume','$id')";


            if (mysqli_query($connSQL, $addsql))
            {
                echo "Data added successfully";

            }
            else {

                echo "Data not added";
            }
      }
	  
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
			header("location:Dashboard.php");
		}
	
  ?>
<script>
	window.location.href = '../Dashboard.php';
</script>