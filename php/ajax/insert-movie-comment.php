<?php
 	if(isset($_POST['opinion']) && isset($_POST['nickname']) && isset($_POST['movieID']))
	{
	  require "../extra/DataBaseConnect.php";
	  
        $nickname = mysqli_real_escape_string($dataBase, htmlspecialchars(trim($_POST['nickname'])));
        $opinion = mysqli_real_escape_string($dataBase, htmlspecialchars(trim($_POST['opinion'])));
		$movieID = mysqli_real_escape_string($dataBase, htmlspecialchars(trim($_POST['movieID'])));
		date_default_timezone_set("Europe/Prague");
		$date = date("Y-m-d H-i");
		
        $query = "INSERT INTO movie_comments (comment, date, nickname, movie_id) VALUES ('$opinion', '$date', '$nickname', '$movieID')";
       	$result = mysqli_query($dataBase,$query);
        
        if($result)
		{
          echo "success";
		}
         else
         {
            echo "error_cannot_insert";
		 }	 
	}
	else
	{
	  die("no_data");	
	}
?>