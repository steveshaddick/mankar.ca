<title>Edit News</title>

<?php

//LAST UPDATE
// 27-09-2007

include("config.php");

   $newsid = $_GET['newsid'];

   if(isset($_POST['submit']))
  {

      $title = $_POST['title'];
      $text1 = $_POST['text1'];
      $text2 = $_POST['text2'];



         $result = mysql_query("UPDATE news SET title='$title', text1='$text1', text2='$text2' WHERE newsid='$newsid' ",$connect);

          echo "<b>Thank you! News UPDATED Successfully!<br>You'll be redirected to Home Page after (4) Seconds";
          echo "<meta http-equiv=Refresh content=4;url=index.php>";
}
elseif($newsid)
{

        $result = mysql_query("SELECT * FROM news WHERE newsid='$newsid' ",$connect);
        while($myrow = mysql_fetch_assoc($result))
             {
                $title = $myrow["title"];
                $text1 = $myrow["text1"];
                $text2= $myrow["text2"];
?>
<br>
<h3>::Edit News</h3>

<form method="post" action="<?php echo $PHP_SELF ?>">
<input type="hidden" name="newsid" value="<? echo $myrow['newsid']?>">

Title: <input name="title" size="40" maxlength="255" value="<? echo $title; ?>">
<br>
Text1: <textarea name="text1"  rows="7" cols="30"><? echo $text1; ?></textarea>
<br>
Text2: <textarea name="text2" rows="7" cols="30"><? echo $text2; ?></textarea>
<br>
<input type="submit" name="submit" value="Update News">
</form>
<?
              }//end of while loop

  }//end else
?>

