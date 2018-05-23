<?php

if(isset($_POST['movieID']) && isset($_POST['offset']))
	{
	  require ("../extra/DataBaseConnect.php");
	  $movieID = mysqli_real_escape_string($dataBase,$_POST['movieID']);
	  $result = mysqli_query($dataBase, "SELECT * FROM movie_comments WHERE movie_id = $movieID");
      $commentsAmmount = mysqli_num_rows($result);
	  
	    if($commentsAmmount > 0)
	    {
		   $offset = Intval($_POST['offset']) * 20;
		   $moreAvailable = ($offset + 20 >= $commentsAmmount) ? false : true;
		   $offset = ($offset > 0) ? "OFFSET $offset" : "";
		   $query = "SELECT * FROM movie_comments WHERE movie_id = $movieID ORDER BY date DESC LIMIT 20 $offset";
           $result = mysqli_query($dataBase,$query);
		   $comments = array($moreAvailable);
		   $comment = array();
		 
		   while($row = mysqli_fetch_assoc($result))
		   {
			 $comment[0] = $row['nickname'];
             $comment[1] = $row['date'];
             $comment[2] = $row['comment'];

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