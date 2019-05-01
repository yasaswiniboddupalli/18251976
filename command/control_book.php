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
	  
	
  ?>
<script>
	window.location.href = '../Dashboard.php';
</script>