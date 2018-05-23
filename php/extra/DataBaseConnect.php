<?php

$dataBase = mysqli_connect(''); ///obviously removed
	  
	    if(!$dataBase)
	    {
		  die("database_error");
	    }
		
		mysqli_query($dataBase,"SET CHARSET utf8");
?>
