<?php

	if(isset($_POST['movieID']) && isset($_POST['vote']))
	{
	  require "../extra/DataBaseConnect.php";
	  
	  $movieID = mysqli_real_escape_string($dataBase, $_POST['movieID']);
      $query = "SELECT * FROM Pornusy WHERE klucz LIKE '$movieID'";
      $result = mysqli_query($dataBase,$query);
      $row = mysqli_fetch_assoc($result);

      $votesNumber = Intval($row['liczba_głosów']) + 1;
      $votesTotal = Floatval($row['suma_głosów']) + Floatval($_POST['vote']);
	  $averageRate = round($votesTotal / $votesNumber,1);
      $query = "UPDATE Pornusy SET liczba_głosów = $votesNumber, suma_głosów = $votesTotal WHERE klucz LIKE '$movieID'";
      $result = mysqli_query($dataBase,$query);

        if($result)
        {
          echo "success|$averageRate|$votesNumber";
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