<?php

	if(isset($_POST['pornstar']) && isset($_POST['vote']))
	{
	  require "../extra/DataBaseConnect.php";
	  
	  $pornstar = mysqli_real_escape_string($dataBase, $_POST['pornstar']);
      $query = "SELECT * FROM pornstars_info WHERE nickname LIKE '$pornstar'";
      $result = mysqli_query($dataBase,$query);
      $row = mysqli_fetch_assoc($result);

      $votesNumber = Intval($row['votes_number']) + 1;
      $votesTotal = Floatval($row['votes_summary']) + Floatval($_POST['vote']);
	  $averageRate = round($votesTotal / $votesNumber,1);
      $query = "UPDATE pornstars_info SET votes_number = $votesNumber, votes_summary = $votesTotal WHERE nickname LIKE '$pornstar'";
      $result = mysqli_query($dataBase,$query);

        if($result)
        {
          echo "success|$averageRate";
	    }
        else
	    {
           echo "error_could_not_insert_data";
	    }   
	}
	else
	{
		die("not enough data");
	}
 


?>