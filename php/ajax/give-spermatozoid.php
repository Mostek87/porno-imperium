<?php

     if(isset($_POST['movieID']))
	{
	  require "../extra/DataBaseConnect.php";
	  
	  $movieID = mysqli_real_escape_string($dataBase, $_POST['movieID']);
	  $result = mysqli_query($dataBase, "SELECT ilość_wytrysków FROM Pornusy WHERE klucz = $movieID ");
	  $row = mysqli_fetch_assoc($result);
	  $cumshotsNumber = Intval($row['ilość_wytrysków']) + 1;
	  $result = mysqli_query($dataBase, "UPDATE Pornusy SET ilość_wytrysków = $cumshotsNumber WHERE klucz = $movieID");
	  
	  if($result)
	  {
		echo "success|$cumshotsNumber";  
	  }
	  else
	  {
		die("mysql error");  
	  }
	   
	}
	else
	{
		die("not enough data");
	}

?>