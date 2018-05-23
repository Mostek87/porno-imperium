<?php

	if(isset($_POST['pornstarName']) && isset($_POST['offset']))
	{
	  require ("../extra/DataBaseConnect.php");
	  $pornstarName = mysqli_real_escape_string($dataBase,$_POST['pornstarName']);
	  $result = mysqli_query($dataBase, "SELECT * FROM pornstars_comments WHERE pornstar_name LIKE '$pornstarName'");
      $commentsAmmount = mysqli_num_rows($result);
	  
	    if($commentsAmmount > 0)
	    {
		   $offset = Intval($_POST['offset']) * 20;
		   $moreAvailable = ($offset + 20 >= $commentsAmmount) ? false : true;
		   $offset = ($offset > 0) ? "OFFSET $offset" : "";
		   $query = "SELECT * FROM pornstars_comments WHERE pornstar_name LIKE '$pornstarName' ORDER BY date DESC LIMIT 20 $offset";
           $result = mysqli_query($dataBase,$query);
		   $comments = array($moreAvailable);
		   $comment = array();
		 
		   while($row = mysqli_fetch_assoc($result))
		   {
			 $comment[0] = $row['user_nickname'];
             $comment[1] = $row['date'];
             $comment[2] = $row['comment'];
			 $comment[3] = $row['anonymous'];

             array_push($comments,$comment);			 
		   }
		   
		   echo json_encode($comments);
	    }
	    else
	    {
		  die("empty_table");
	    }
     	  
	}
	else
	{
	  die("no_data");	
	}




?>