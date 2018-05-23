<?php

	if(isset($_POST['opinion']) && isset($_POST['nickname']) && isset($_POST['pornstar']) && isset($_POST['annonymous']))
	{
	  require "../extra/DataBaseConnect.php";
	  
        $nickname = mysqli_real_escape_string($dataBase, htmlspecialchars(trim($_POST['nickname'])));
        $opinion = mysqli_real_escape_string($dataBase, htmlspecialchars(trim($_POST['opinion'])));
		$pornstar = mysqli_real_escape_string($dataBase, htmlspecialchars(trim($_POST['pornstar'])));
		date_default_timezone_set("Europe/Prague");
		$date = date("Y-m-d H-i");
		$annonymous = Intval($_POST['annonymous']);
		
        $query = "INSERT INTO pornstars_comments (pornstar_name, user_nickname, comment, date, anonymous) VALUES ('$pornstar', '$nickname', '$opinion', '$date', $annonymous)";
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