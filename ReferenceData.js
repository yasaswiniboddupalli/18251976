function chooseEntryType() {
  var x = document.getElementById("mySelect").value;
  if(x=='SelectItems')
  {
    document.getElementById("Bookid").style = "display:none;";
    document.getElementById("Articleid").style = "display:none;";
      document.getElementById("Incollectionid").style = "display:none;";
        document.getElementById("Inproceedingsid").style = "display:none;";
 }

else  if(x=='Book')
  {
    document.getElementById("Bookid").style = "display:initial;";
    document.getElementById("Articleid").style = "display:none;";
      document.getElementById("Incollectionid").style = "display:none;";
        document.getElementById("Inproceedingsid").style = "display:none;";
  }
 else if(x=='Article')
  {
document.getElementById("Bookid").style = "display:none;";
document.getElementById("Articleid").style = "display:initial";
document.getElementById("Incollectionid").style = "display:none;";
  document.getElementById("Inproceedingsid").style = "display:none;";

  }else if(x=='Incollection')
   {
 document.getElementById("Bookid").style = "display:none;";
 document.getElementById("Articleid").style = "display:none";
 document.getElementById("Incollectionid").style = "display:initial";
   document.getElementById("Inproceedingsid").style = "display:none;";

   }else if(x=='Inproceedings')
    {
  document.getElementById("Bookid").style = "display:none;";
  document.getElementById("Articleid").style = "display:none";
   document.getElementById("Incollectionid").style = "display:none";
  document.getElementById("Inproceedingsid").style = "display:initial";

    }
}
