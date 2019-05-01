
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
		  
		  $posts = array('entryType'=> $entryType, 'author'=> $author, 'bookTitle'=> $bookTitle, 'editor'=> $editor, 'title'=> $title, 'journal'=> $journal, 'publisher'=> $publisher, 'year'=> $year, 'volume'=> $volume);
		  
			
			$json_data = json_encode($posts);
			file_put_contents('../json/getReference.json', $json_data);
			return;
		  
		/*
		echo "<div class='col-sm-4'>Entry Type </div>";
		echo "<div class='col-sm-8'>";
		echo "	<select id='mySelect_update' onchange='chooseEntryType('mySelect_update')' name='entryType'>";
		//echo "		<option value='SelectItems'>Select</option>";
		if($entryType=="Book"){
			echo "		<option value='Book' seleted>Book</option>";
			echo "		<option value='Article'>Article</option>";
			echo "		<option value='Incollection'>Incollection</option>";
			echo "		<option value='Inproceedings'>Inproceedings</option>";
		}else if($entryType=="Article"){
			echo "		<option value='Book'>Book</option>";
			echo "		<option value='Article' seleted>Article</option>";
			echo "		<option value='Incollection'>Incollection</option>";
			echo "		<option value='Inproceedings'>Inproceedings</option>";
		}else if($entryType=="Incollection"){
			echo "		<option value='Book'>Book</option>";
			echo "		<option value='Article'>Article</option>";
			echo "		<option value='Incollection' seleted>Incollection</option>";
			echo "		<option value='Inproceedings'>Inproceedings</option>";
		}else if($entryType=="Inproceedings"){
			echo "		<option value='Book'>Book</option>";
			echo "		<option value='Article'>Article</option>";
			echo "		<option value='Incollection'>Incollection</option>";
			echo "		<option value='Inproceedings' seleted>Inproceedings</option>";
		}
		echo "	</select>";
		echo "</div>";
		echo "<br/>";
		echo "<br/>";
		echo "<br/>";

		if($entryType=="Book"){
			echo "<div id='Bookid_update' class='col-sm-12'>";
		}else{
			echo "<div id='Bookid_update' style = 'display:none;'  class='col-sm-12'>";
		}
		echo "<div class='col-sm-4'>Author </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='author' value='".$author."' > </div><br/>";
		echo "<div class='col-sm-4' >Book Title </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='booktitle' value='".$bookTitle."' > </div><br/>";
			  
		echo "<div class='col-sm-4'>Publisher </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='publisher' value='".$publisher."' > </div><br/>";

		echo "<div class='col-sm-4'>Year </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='year' value='".$year."' ></div> <br/>";
			  
		echo "<div class='col-sm-4'>Volume </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='volume' value='".$volume."' > </div><br/>";
		
		echo "<div class='col-sm-4'>Title </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='title' value='".$title."' hidden> </div><br/>";
		echo "<div class='col-sm-4'>Journal </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='journal' value='".$journal."' hidden></div> <br/>";
		echo "<div class='col-sm-4'>Editor </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='editor' value='".$editor."' hidden> </div><br/>";

		
		echo "	<input type='submit' class='btn btn-default' id='ReferenceSubmitButton' style='margin-left: 216px; ' value='Insert' name='submitData' >";
		echo "</div>";

		if($entryType=="Articleid"){
			echo "<div id='Articleid_update' class='col-sm-12'>";
		}else{
			echo "<div id='Articleid_update' style = 'display:none;' class='col-sm-12'>";
		}
		echo "<div class='col-sm-4'>Author </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='author' value='".$author."' > </div><br/>";
		
		echo "<div class='col-sm-4'>Title </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='title' value='".$title."' > </div><br/>";

		echo "<div class='col-sm-4'>Journal </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='journal' value='".$journal."' ></div> <br/>";


		echo "<div class='col-sm-4'>Year </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='year' value='".$year."' ></div> <br/>";

		echo "<div class='col-sm-4'>Volume </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='volume' value='".$volume."' > </div><br/>";
		
		echo "<div class='col-sm-4' >Book Title </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='booktitle' value='' hidden> </div><br/>";
		echo "<div class='col-sm-4'>Publisher </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='publisher' value='' hidden> </div><br/>";
		echo "<div class='col-sm-4'>Editor </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='editor' value='".$editor."' hidden> </div><br/>";
		
		echo "	<input type='submit' class='btn btn-default' id='ReferenceSubmitButton' style='margin-left: 216px; ' value='Insert' name='submitData' >";
		echo "</div>";

		if($entryType=="Incollectionid"){
			echo "<div id='Incollectionid_update' class='col-sm-12'>";
		}else{
			echo "<div id='Incollectionid_update' style = 'display:none;' class='col-sm-12'>";
		}
		echo "<div class='col-sm-4'>Author </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='author' value='".$author."' > </div><br/>";
		
		echo "<div class='col-sm-4'>Editor </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='editor' value='".$editor."' > </div><br/>";


		echo "<div class='col-sm-4'>Title </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='title' value='".$title."' > </div><br/>";

		echo "<div class='col-sm-4'>Publisher </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='publisher' value='".$publisher."' > </div><br/>";


		echo "<div class='col-sm-4'>Year </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='year' value='".$year."' ></div> <br/>";

		echo "<div class='col-sm-4'>Volume </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='volume' value='".$volume."' > </div><br/>";
		
		echo "<div class='col-sm-4' >Book Title </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='booktitle' value='' hidden> </div><br/>";
		echo "<div class='col-sm-4'>Journal </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='journal' value='".$journal."' hidden></div> <br/>";
		
		echo "	<input type='submit' class='btn btn-default' id='ReferenceSubmitButton' style='margin-left: 216px; ' value='Insert' name='submitData' >";
		echo "</div>";

		if($entryType=="Inproceedingsid"){
			echo "<div id='Inproceedingsid_update' class='col-sm-12'>";
		}else{
			echo "<div id='Inproceedingsid_update' style = 'display:none;' class='col-sm-12'>";
		}
		echo "<div class='col-sm-4'>Author </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='author' value='".$author."' > </div><br/>";
		
		echo "<div class='col-sm-4'>Editor </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='editor' value='".$editor."' > </div><br/>";


		echo "<div class='col-sm-4'>Title </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='title' value='".$title."' > </div><br/>";

		echo "<div class='col-sm-4'>Year </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='year' value='".$year."' ></div> <br/>";

		echo "<div class='col-sm-4'>Volume </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='volume' value='".$volume."' > </div><br/>";
		
		echo "<div class='col-sm-4' >Book Title </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='booktitle' value='' hidden> </div><br/>";
		echo "<div class='col-sm-4'>Publisher </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='publisher' value='' hidden> </div><br/>";
		echo "<div class='col-sm-4'>Journal </div>";
		echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='journal' value='".$journal."' hidden></div> <br/>";
		
		echo "	<input type='submit' class='btn btn-default' id='ReferenceSubmitButton' style='margin-left: 216px; ' value='Insert' name='submitData' >";
		echo "	</div>";

		
			if($entryType=="Book"){
			  echo "<div class='col-sm-4'>Author </div>";
			  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='author' value='".$author."' > </div><br/>";
			  echo "<div class='col-sm-4' >Book Title </div>";
			  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='booktitle' value='".$bookTitle."' > </div><br/>";
			  echo "<div class='col-sm-4'>Publisher </div>";
			  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='publisher' value='".$publisher."' > </div><br/>";
			  echo "<div class='col-sm-4'>Year </div>";
			  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='year' value='".$year."' ></div> <br/>";
			  echo "<div class='col-sm-4'>Volume </div>";
			  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='volume' value='".$volume."' > </div><br/>";
			  echo "<div class='col-sm-4'>Volume </div>";
			  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='volume' value='".$volume."' > </div><br/>";
			  echo "<div class='col-sm-4'>Volume </div>";
			  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='volume' value='".$volume."' > </div><br/>";
			  echo "<input type='submit' value='Update' name='submitData' >";
			}
		else if($entryType=="Article"){
				echo "<div class='col-sm-4'>Author </div>";
				echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='author' value='".$author."' > </div><br/>";
				echo "<div class='col-sm-4'>Title </div>";
			    echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='title' value='".$title."' > </div><br/>";
				echo "<div class='col-sm-4'>Journal </div>";
				echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='journal' value='".$journal."' ></div> <br/>";
				echo "<div class='col-sm-4'>Year </div>";
				echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='year' value='".$year."' ></div> <br/>";
				echo "<div class='col-sm-4'>Volume </div>";
				echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='volume' value='".$volume."' > </div><br/>";
				echo "<input type='submit' value='Update' name='submitData' >";
			}
			else if($entryType=="Incollection"){
					echo "<div class='col-sm-4'>Author </div>";
					echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='author' value='".$author."' > </div><br/>";
					echo "<div class='col-sm-4'>Editor </div>";
				    echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='editor' value='".$editor."' > </div><br/>";
					echo "<div class='col-sm-4'>Title </div>";
				  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='title' value='".$title."' > </div><br/>";
					echo "<div class='col-sm-4'>Publisher </div>";
					echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='publisher' value='".$publisher."' > </div><br/>";
					echo "<div class='col-sm-4'>Year </div>";
					echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='year' value='".$year."' ></div> <br/>";
					echo "<div class='col-sm-4'>Volume </div>";
					echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='volume' value='".$volume."' > </div><br/>";
					echo "<input type='submit' value='Update' name='submitData' >";
				}
				else if($entryType=="Inproceedings"){
					  echo "<input type='text' id='referenceID' name='referenceID' value='".$referenceID."' hidden />";
					  echo "<div class='col-sm-4'>Author </div>";
					  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='author' value='".$author."' > </div><br/>";
					  echo "<div class='col-sm-4'>Editor </div>";
					  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='editor' value='".$editor."' > </div><br/>";
					  echo "<div class='col-sm-4'>Title </div>";
					  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='title' value='".$title."' > </div><br/>";
					  echo "<div class='col-sm-4'>Year </div>";
					  echo "<div class='col-sm-8'><input type='text' style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='year' value='".$year."' ></div> <br/>";
					  echo "<div class='col-sm-4'>Volume </div>";
					  echo "<div class='col-sm-8'><input type='text'  style='border: none !important; border-bottom: solid 1px !important; padding: 5px !important; border-radius: unset !important;width: 90%;margin-bottom: 9px;' name='volume' value='".$volume."' > </div><br/>";
					  echo "<input type='submit' value='Update' name='submitData' >";
				  }
		*/
	  }else if($operator=="updateReference"){
		  $referenceID = $_REQUEST['referenceID'];
		  $entryType = $_REQUEST['entryType'];
		  if($entryType=="Book"){
			  $author = $_REQUEST['author_Bookid'];
		  }else if($entryType=="Article"){
			  $author = $_REQUEST['author_Articleid'];
		  }else if($entryType=="Incollection"){
			  $author = $_REQUEST['author_Incollectionid'];
		  }else{
			  $author = $_REQUEST['author_Inproceedingsid'];
		  }
		  
		  if($entryType=="Book"){
			  $booktitle = $_REQUEST['booktitle_Bookid'];
		  }else{
			  $booktitle="";
		  }
		  
		  if($entryType=="Incollection"){
			$editor = $_REQUEST['editor_Incollectionid'];
		  }else if($entryType=="Inproceedings"){
			$editor = $_REQUEST['editor_Inproceedingsid'];
		  }else{
			  $editor="";
		  }
		  
		  if($entryType=="Article"){
			  $title = $_REQUEST['title_Articleid'];
		  }else if($entryType=="Incollection"){
			  $title = $_REQUEST['title_Incollectionid'];
		  }else if($entryType=="Inproceedings"){
			  $title = $_REQUEST['title_Inproceedingsid'];
		  }else{
			  $title="";
		  }
		  
		  if($entryType=="Article"){
			$journal = $_REQUEST['journal_Articleid'];
		  }else{
			  $journal ="";
		  }
		  
		  if($entryType=="Incollection"){
			  $publisher = $_REQUEST['publisher_Incollectionid'];
		  }else if($entryType=="Book"){
			  $publisher = $_REQUEST['publisher_Bookid'];
		  }else{
			  $publisher="";
		  }
		  
		  if($entryType=="Book"){
			  $year = $_REQUEST['year_Bookid'];
		  }else if($entryType=="Article"){
			  $year = $_REQUEST['year_Articleid'];
		  }else if($entryType=="Incollection"){
			  $year = $_REQUEST['year_Incollectionid'];
		  }else{
			  $year = $_REQUEST['year_Inproceedingsid'];
		  }
		  if($entryType=="Book"){
			  $volume = $_REQUEST['volume_Bookid'];
		  }else if($entryType=="Article"){
			  $volume = $_REQUEST['volume_Articleid'];
		  }else if($entryType=="Incollection"){
			  $volume = $_REQUEST['volume_Incollectionid'];
		  }else{
			  $volume = $_REQUEST['volume_Inproceedingsid'];
		  }

		  $sql = "update referencetable set entryType='$entryType',author='$author',booktitle='$booktitle',editor='$editor',title='$title',journal='$journal',publisher='$publisher',year='$year',volume='$volume'  where referenceID='$referenceID'";
		  $result_2 = $pdo->query($sql);
		  if($result_2==True){
			echo "Successful";
		}else{
			echo "Fail";
		}
	  }else if($operator=="showUnfiled"){
		    $userID =$_GET["userID"];
		    $sorttype =$_GET["sorttype"];
		    $datatype =$_GET["datatype"];
			if($sorttype==""){
				$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID'");
			}else if($sorttype=="order_asc"){
				if($datatype=="Sort_Author"){
					$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID' ORDER BY author ASC");
				}else if($datatype=="Sort_Title"){
					$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID' ORDER BY title ASC");
				}else if($datatype=="Sort_Booktitle"){
					$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID' ORDER BY bookTitle ASC");
				}else if($datatype=="Sort_Year"){
					$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID' ORDER BY year ASC");
				}
			}else{
				if($datatype=="Sort_Author"){
					$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID' ORDER BY author DESC");
				}else if($datatype=="Sort_Title"){
					$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID' ORDER BY title DESC");
				}else if($datatype=="Sort_Booktitle"){
					$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID' ORDER BY bookTitle DESC");
				}else if($datatype=="Sort_Year"){
					$stmt = $pdo->query("SELECT * FROM referenceTable where isDelete=0 and defaultLibrary=1 and userID='$userID' ORDER BY year DESC");
				}
			}
			while($row = $stmt->fetch()) {
				$refernce_libraryID = $row['libraryID'];
				$stmt_lib = $pdo->query("SELECT * FROM librarytable where libraryID='$refernce_libraryID'");
				$row_lib = $stmt_lib->fetch();

				echo "<input type='text' id='libraryID' name='libraryID' value='0'  hidden />";
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
			$author = "";
			$booktitle = "";
			$publisher = "";
			$year = "";
			$volume = "";
			$editor = "";
			$title = "";
			$journal = "";
			if($entryType=="Book"){
				$author = mysqli_real_escape_string($connSQL,$_POST['author_Bookid']);
				$booktitle = mysqli_real_escape_string($connSQL,$_POST['booktitle_Bookid']);
				$publisher = mysqli_real_escape_string($connSQL,$_POST['publisher_Bookid']);
				$year = mysqli_real_escape_string($connSQL,$_POST['year_Bookid']);
				$volume = mysqli_real_escape_string($connSQL,$_POST['volume_Bookid']);
			}else if($entryType=="Article"){
				$author = mysqli_real_escape_string($connSQL,$_POST['author_Articleid']);
				$title = mysqli_real_escape_string($connSQL,$_POST['title_Articleid']);
				$journal = mysqli_real_escape_string($connSQL,$_POST['journal_Articleid']);
				$year = mysqli_real_escape_string($connSQL,$_POST['year_Articleid']);
				$volume = mysqli_real_escape_string($connSQL,$_POST['volume_Articleid']);
			}else if($entryType=="Incollection"){
				$author = mysqli_real_escape_string($connSQL,$_POST['author_Incollectionid']);
				$editor = mysqli_real_escape_string($connSQL,$_POST['editor_Incollectionid']);
				$title = mysqli_real_escape_string($connSQL,$_POST['title_Incollectionid']);
				$publisher = mysqli_real_escape_string($connSQL,$_POST['publisher_Incollectionid']);
				$year = mysqli_real_escape_string($connSQL,$_POST['year_Incollectionid']);
				$volume = mysqli_real_escape_string($connSQL,$_POST['volume_Incollectionid']);
			}elseif($entryType=="Inproceedings"){
				$author = mysqli_real_escape_string($connSQL,$_POST['author_Inproceedingsid']);
				$editor = mysqli_real_escape_string($connSQL,$_POST['editor_Inproceedingsid']);
				$title = mysqli_real_escape_string($connSQL,$_POST['title_Inproceedingsid']);
				$year = mysqli_real_escape_string($connSQL,$_POST['year_Inproceedingsid']);
				$volume = mysqli_real_escape_string($connSQL,$_POST['volume_Inproceedingsid']);
			}

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
