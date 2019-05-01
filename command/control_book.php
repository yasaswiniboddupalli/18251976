<?php require_once('../../Connections/connSQL.php'); ?>
<?php
	  $operator ="";
	  $operator =$_GET["operator"];
	  
	  if($operator=="deleteReference"){
		$deleteReference = $_REQUEST['deleteReference'];
		
		$list_deleteReference = explode(',',$deleteReference);
		$listLength_deleteLibrary = sizeof($list_deleteReference);
		$result_All = true;
		for($i=0;$i<$listLength_deleteLibrary;$i++){
			$sqldelete = "UPDATE referenceTable SET isDelete = 1 WHERE referenceID=".$list_deleteReference[$i];
			$result2 = $connSQL->query($sqldelete);
			if($result2 != true) $result_All = false;
		}
	  }else if($operator=="DeleteTrash"){
				// to get the user id of the loggedin user
				//echo 1;
			  // each checkbox is given referenceId so that we can delete  them easily
			  if(!empty($_POST['selectedcheckbox'])&& isset($_POST['restore'])){
				//echo 2;
				// Loop to store and display values of individual checked checkbox.
				foreach($_POST['selectedcheckbox'] as $selected){
				  $sqldelete = "UPDATE referenceTable SET isDelete = 0 WHERE referenceID='$selected'";
				  $result2 = $connSQL->query($sqldelete);
				}
			  }
		 
			  // each checkbox is given referenceId so that we can delete  them easily
		  if(!empty($_POST['selectedcheckbox'])&& isset($_POST['delete'])){
		  // Loop to store and display values of individual checked checkbox.
		  foreach($_POST['selectedcheckbox'] as $selected){
			$sqldelete = "DELETE from referenceTable WHERE referenceID='$selected'";
			$result2 = $connSQL->query($sqldelete);
		  }
		  } 



	  }else if($operator=="showReference"){
		  $referenceID = $_REQUEST['referenceID'];
		  $sql = "SELECT * FROM referencetable WHERE referenceID = '$referenceID'";
		  $RecReferenceInfo = $pdo->query($sql);
		  $row_RecReferenceInfo = $RecReferenceInfo->fetch();
		  $entryType=$row_RecReferenceInfo['entryType'];
		  $author=$row_RecReferenceInfo['author'];
		  $bookTitle=$row_RecReferenceInfo['bookTitle'];
		  $editor=$row_RecReferenceInfo['editor'];
		  $title=$row_RecReferenceInfo['title'];
		  $journal=$row_RecReferenceInfo['journal'];
		  $publisher=$row_RecReferenceInfo['publisher'];
		  $year=$row_RecReferenceInfo['year'];
		  $volume=$row_RecReferenceInfo['volume'];
		  
		  {
			  echo "<input type='text' id='referenceID' name='referenceID' value='".$referenceID."' hidden />";
			  echo "<div class='col-sm-4'>Entry Type </div>";
			  echo "<div class='col-sm-8'>";
			  echo "<input type='text' name='entryType' value='".$entryType."' require_once> </div><br/><br/>";
			  echo "<div class='col-sm-4'>Author </div>";
			  echo "<div class='col-sm-8'><input type='text' name='author' value='".$author."' > </div><br/>";
			  echo "<tr id='BookTitle'>";
			  echo "<div class='col-sm-4' >Book Title </div>";
			  echo "<div class='col-sm-8'><input type='text' name='booktitle' value='".$bookTitle."' > </div><br/>";
			  echo "</tr>";
			  echo "<div class='col-sm-4'>Editor </div>";
			  echo "<div class='col-sm-8'><input type='text' name='editor' value='".$editor."' > </div><br/>";
			  echo "<div class='col-sm-4'>Title </div>";
			  echo "<div class='col-sm-8'><input type='text' name='title' value='".$title."' > </div><br/>";
			  echo "<div class='col-sm-4'>Journal </div>";
			  echo "<div class='col-sm-8'><input type='text' name='journal' value='".$journal."' ></div> <br/>";
			  echo "<div class='col-sm-4'>Publisher </div>";
			  echo "<div class='col-sm-8'><input type='text' name='publisher' value='".$publisher."' > </div><br/>";
			  echo "<div class='col-sm-4'>Year </div>";
			  echo "<div class='col-sm-8'><input type='text' name='year' value='".$year."' ></div> <br/>";
			  echo "<div class='col-sm-4'>Volume </div>";
			  echo "<div class='col-sm-8'><input type='text' name='volume' value='".$volume."' > </div><br/>";
			  echo "<input type='submit' value='Update' name='submitData' >";
		  }
		  
	  }else if($operator=="updateReference"){
		  $referenceID = $_REQUEST['referenceID'];
		  $entryType = $_REQUEST['entryType'];
		  $author = $_REQUEST['author'];
		  $booktitle = $_REQUEST['booktitle'];
		  $editor = $_REQUEST['editor'];
		  $title = $_REQUEST['title'];
		  $journal = $_REQUEST['journal'];
		  $publisher = $_REQUEST['publisher'];
		  $year = $_REQUEST['year'];
		  $volume = $_REQUEST['volume'];
		  
		  $sql = "update referencetable set entryType='$entryType',author='$author',booktitle='$booktitle',editor='$editor',title='$title',journal='$journal',publisher='$publisher',year='$year',volume='$volume'  where referenceID='$referenceID'";
		  $result_2 = $pdo->query($sql);
		  if($result_2==True){
			echo "Successful";
		}else{
			echo "Fail";
		}
	  }else if($operator=="showUnfiled"){
		    $userID =$_GET["userID"];
		    $stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID'");
			while($row = $stmt->fetch()) {
				$refernce_libraryID = $row['libraryID'];
				$stmt_lib = $pdo->query("SELECT * FROM librarytable where libraryID='$refernce_libraryID'");
				$row_lib = $stmt_lib->fetch();

				echo "<input type='text' id='libraryID' name='libraryID' value='0' hidden />";
				echo "<input type='text' id='libraryName' name='libraryName' value='Unfiled' hidden />";
				//if($DataInfo==$row['libraryID']){
					echo "<tr>";
					echo "<td><input type='checkbox' name='check_ReferenceList[]' value='" . $row['referenceID'] . "'></td>";
					echo "<td>" . $row['entryType'] . "</td>";
					echo "<td>" . $row['author'] . "</td>";
					echo "<td>" . $row['bookTitle'] . "</td>";
					echo "<td>" . $row['editor'] . "</td>";
					echo "<td>" . $row['title'] . "</td>";
					echo "<td>" . $row['journal'] . "</td>";
					echo "<td>" . $row['publisher'] . "</td>";
					echo "<td>" . $row['year'] . "</td>";
					echo "<td>" . $row['volume'] . "</td>";
					echo "</tr>";
				//}
			}
	  }else{
		  $userEmailId =$_SESSION["email"];
		  $user = "SELECT userID FROM userTable WHERE email = '$userEmailId'";
		  $result1 = $connSQL->query($user);
		  $row = mysqli_fetch_assoc($result1);
		  $id = $row["userID"];

		  if (isset($_REQUEST["submitData"]))
		  {
			$entryType  = $_POST['entryType'];
			$author = $_POST['author'];
			$booktitle = $_POST['booktitle'];
			$editor = $_POST['editor'];
			$title = $_POST['title'];
			$journal = $_POST['journal'];
			$publisher = $_POST['publisher'];
			$year = $_POST['year'];
			$volume = $_POST['volume'];

				$addsql = "Insert into referenceTable(entryType, author, bookTitle, editor, title, journal, publisher, year, volume, userID, defaultLibrary) values('$entryType','$author','$booktitle','$editor','$title','$journal','$publisher','$year','$volume','$id',1)";


				if (mysqli_query($connSQL, $addsql))
				{
					//echo "Data added successfully";

				}
				else {

					//echo "Data not added";
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
	  }
  ?>
<script>
	window.location.href = '../Dashboard.php';
</script>