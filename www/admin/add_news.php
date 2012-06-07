<title>hotnews</title>
<?php

//LAST UPDATE
// 27-09-2007

include("config.php");


  if(isset($_POST['submit']))
  {//begin of if($submit).
      // Set global variables to easier names
      $title = $_POST['title'];
      $text1 = $_POST['text1'];
      $text2 = $_POST['text2'];

              //check if (title) field is empty then print error message.
              if(!$title){  //this means If the title is really empty.
                     echo "Error: News title is a required field. Please fill it.";
                     exit(); //exit the script and don't do anything else.
              }// end of if

         //run the query which adds the data gathered from the form into the database
         $result = mysql_query("INSERT INTO news (title, dtime, text1, text2)
                       VALUES ('$title',NOW(),'$text1','$text2')",$connect);
          //print success message.
          echo "<b>Thank you! News added Successfully!<br>You'll be redirected to Home Page after (4) Seconds";
          echo "<meta http-equiv=Refresh content=4;url=index.php>";
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else

      ?>
      <br>
      <h3>::Add News</h3>

      <form method="post" action="<?php echo $_SERVER[PHP_SELF] ?>">

      Title: <input name="title" size="40" maxlength="255">
      <br>
      Text1: <textarea name="text1"  rows="7" cols="30"></textarea>
      <br>
      Text2: <textarea name="text2" rows="7" cols="30"></textarea>
      <br>
      <input type="submit" name="submit" value="Add News">
      </form>
      <?
  }//end of else
  
  
?>

