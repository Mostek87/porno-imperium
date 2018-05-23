<?php

class PornstarsModel
{
  public $pornstar;
  public $parsedPornstarName;
	
  function getPornstarData()
  {
    require "php/extra/DataBaseConnect.php";
	
	 $pornstar = &$this->parsedPornstarName;
	 $query = "SELECT * FROM pornstars_comments WHERE pornstar_name LIKE '$pornstar'";
	 $result = mysqli_query($dataBase,$query);
	 $commentsNumber = mysqli_num_rows($result);
	 
	 $query = "SELECT * FROM pornstars_info WHERE nickname LIKE '$pornstar'";
	 $result = mysqli_query($dataBase,$query);
	 $row = mysqli_fetch_assoc($result);
	 
	 $rated = (isset($_COOKIE['rated'])) ? Intval($_COOKIE['rated']) : -1; 
	 return new Pornstar($pornstar, $row['birth_place'], $row['true_name'], $row['nationality'], $row['years_active'],
	 $row['official_website'], $row['description_beginning'],$row['description_end'],$row['votes_number'],$row['votes_summary'], $row['tits_type'], $commentsNumber, $rated);
  }  
  
  function getPornstarMovies()
  {
	 require "php/extra/DataBaseConnect.php";
	 $pornstar = &$this->parsedPornstarName;
	 $query = "SELECT * FROM Pornusy WHERE gwiazdy LIKE '%$pornstar%' ORDER BY klucz DESC";
	 $result = mysqli_query($dataBase,$query);
	 $movies = array();
	 
	    while($row = mysqli_fetch_assoc($result))
		{
		  array_push($movies, new Movie($row['opis'], null,$row['wyswietlenia'], $row['sekundy'],$row['minuty'],$row['godziny'], $row['lektorpl'], $row['klucz']));
		}
		
	 return $movies;
	 
  }
  
}

?>