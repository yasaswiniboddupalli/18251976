// code show reference  when type selected is book, Article and so on

function chooseEntryType(id) {
  var x = document.getElementById(id).value;
  var Bookid="Bookid";
  var Articleid="Articleid";
  var Incollectionid="Incollectionid";
  var Inproceedingsid="Inproceedingsid";
  
  if(id=="mySelect_update"){
	  Bookid+="_update";
	  Articleid+="_update";
	  Incollectionid+="_update";
	  Inproceedingsid+="_update";
  }
  
  if(x=='SelectItems')
  {
    document.getElementById(Bookid).style = "display:none;";
    document.getElementById(Articleid).style = "display:none;";
      document.getElementById(Incollectionid).style = "display:none;";
        document.getElementById(Inproceedingsid).style = "display:none;";
 }
// only selected items will be displayed
else  if(x=='Book')
  {
    document.getElementById(Bookid).style = "display:initial;";
    document.getElementById(Articleid).style = "display:none;";
      document.getElementById(Incollectionid).style = "display:none;";
        document.getElementById(Inproceedingsid).style = "display:none;";
  } else if(x=='Article') // only selected items will be displayed
  {
document.getElementById(Bookid).style = "display:none;";
document.getElementById(Articleid).style = "display:initial";
document.getElementById(Incollectionid).style = "display:none;";
  document.getElementById(Inproceedingsid).style = "display:none;";

  }  else if(x=='Incollection') // only selected items will be displayed
   {
 document.getElementById(Bookid).style = "display:none;";
 document.getElementById(Articleid).style = "display:none";
 document.getElementById(Incollectionid).style = "display:initial";
   document.getElementById(Inproceedingsid).style = "display:none;";

   }else if(x=='Inproceedings') // only selected items will be displayed
    {
  document.getElementById(Bookid).style = "display:none;";
  document.getElementById(Articleid).style = "display:none";
   document.getElementById(Incollectionid).style = "display:none";
  document.getElementById(Inproceedingsid).style = "display:initial";

    }
}
