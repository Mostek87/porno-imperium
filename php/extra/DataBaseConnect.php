<?php

$dataBase = mysqli_connect('mysql6.superhost.pl', 'sh194765_giermek', 'tutajgiermek', 'sh194765_pornobaza');
	  
	    if(!$dataBase)
	    {
		  die("database_error");
	    }
		
		mysqli_query($dataBase,"SET CHARSET utf8");
?>