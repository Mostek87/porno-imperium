<?php

class WatchModel
{
  public $movieID;
  
   private function getSimilarMovies($movie, $dataBase)
  {
	$movies = array(); 
	$id = &$this->movieID;
	$columnNames = array(
	array("pornstars","gwiazdy"),
	array("simple-checkbox","kompilacja_wytrysków"),
	array("simple-checkbox","sado_maso"),
	array("simple-checkbox","kamera_szpiegowska"),
	array("simple-checkbox","kobieca_dominacja"),
	array("simple-checkbox","wielki_kutas"),
	
	array("sex-type","anal"), 
	array("sex-type","lodzik"), 
	array("sex-type","minetka"), 
	array("sex-type","lim"), 
	array("sex-type","wtyczka"), 
	array("sex-type","trzepanie"), 
	array("sex-type","w_cipke"), 
	array("sex-type","w_cyce"), 
	array("sex-type","stópki"),
	
	array("simple-select","liczebność1"),
	array("simple-select","poziom"),
	array("simple-select","ujęcie"),
	array("simple-select","wytrysk"),
	array("simple-checkbox","bicze"),
	array("simple-checkbox","rajstopki"), 
	array("simple-checkbox","okularki"), 
	array("simple-checkbox","pończoszki"), 
	array("simple-select","lokalizacja"),
	array("simple-checkbox","szpile"),
    array("simple-checkbox","sex_zabawki"),	

	array("simple-select","fabuła_kostiumy"),
	array("simple-select","narodowość"),
	array("simple-select","wiek"),
	array("simple-select","rozmiar_cycków"),
	array("simple-select","rozmiar_dupci"),
	array("simple-select","kolor_włosów"),
	array("simple-select","rasa"),
	
	);
	
	$queryParts = array();
	
	foreach($columnNames as $column)
	{
	    $columnName = &$column[1];
		$value = &$movie[$columnName];
		
		if($value == "")
		{
		  continue;	
		}
		
		switch($column[0])
		{
		   
		   case "simple-checkbox" :
		     if($value == 1)
			 {
				array_push($queryParts,"$columnName = 1 AND "); 
			 }
		   break;
		   
		   case "sex-type" :
			  $value = Intval($value);
			  
			  if($value > 88)
			  {
			    array_push($queryParts,"$columnName > 89 AND ");
			  }
		   break;
		   
		   case "simple-select":
		      switch($columnName)
			  {
				 case "narodowość" :
                    if($value != "amerykanki")
					{
						array_push($queryParts, "$columnName LIKE '$value' AND ");
					}
                 break;	

                case "rozmiar_cycków":
                   if($value != "średnie")
					{
						array_push($queryParts, "$columnName LIKE '$value' AND ");
					}
                break;

                case "rozmiar_dupci":
                   if($value != "średnia")
					{
						array_push($queryParts, "$columnName LIKE '$value' AND ");
					}
                break;

                case "rozmiar_dupci":
                    if($value != "średnia")
					{
						array_push($queryParts, "$columnName LIKE '$value' AND ");
					}
                break;	

                case "wiek":
                    if($value != "młode")
					{
						array_push($queryParts, "$columnName LIKE '$value' AND ");
					}
                break;

                case "rasa":
                    if($value != "białe")
					{
						array_push($queryParts, "$columnName LIKE '$value' AND ");
					}
                break;

                case "fabuła":
                    if($value != 0)
					{
						array_push($queryParts, "$columnName LIKE '$value' AND ");
					}
                break; 

                case "poziom":
                    if($value != "profesjonalny")
					{
						array_push($queryParts, "$columnName LIKE '$value' AND ");
					}
                break; 

                case "ujęcie":
                    if($value === "POV")
					{
						array_push($queryParts, "$columnName LIKE 'POV' AND ");
					}
                break;

                case "liczebność1":
                    if($value != "1 na 1")
					{
						array_push($queryParts, "$columnName LIKE '$value' AND ");
					}
                break;

               case "lokalizacja":
                    if($value != "dom")
					{
						array_push($queryParts, "$columnName LIKE '$value' AND ");
					}
                break; 	 				
                
                				
			  }
		   break;
		   
		   case "pornstars":
			   array_push($queryParts, "gwiazdy LIKE '%$value%' AND "); 
		   break;
		}
	}
	
	do
	{
	  $queryCore = implode($queryParts);
	  $query = "SELECT * FROM Pornusy WHERE ".$queryCore."klucz != $id LIMIT 30";
	  $result = mysqli_query($dataBase,$query);
	  $moviesNumber = mysqli_num_rows($result);
	  array_pop($queryParts);
	  $numberOfElements = count($queryParts);
	}
	while(($moviesNumber < 8 ) && ($numberOfElements > 0));
    
     while($row = mysqli_fetch_assoc($result))
     {
       array_push($movies, new Movie($row['opis'], $row['gwiazdy'],$row['wyswietlenia'], $row['sekundy'],$row['minuty'],$row['godziny'], $row['lektorpl'],$row['klucz']));
	 } 
	 
	 return $movies;
  }
  
  private function getRateInfo()
  {
	if(isset($_COOKIE['rated']))
    {
           
	  if(is_numeric($_COOKIE['rated']))
	   {
		  
		  return  $_COOKIE['rated'];
	   }
	   else
	   {
		 die("błąd pliku cookie");  
	   }
	}
	else
	{
	  return -1;
	}
  }
  
  private function getCumshotDescription()
  {
	if(isset($_COOKIE['cumshot']))
    {
       return new SpermatozoidInfo("bright-spermatozoid", "Niedawno prysnąłeś");
	}
	else
	{
		return new SpermatozoidInfo("", "Daj plemnika jeśli prysnąłeś");
	}
  }
 
  public function getMovieData()
  {
    require "php/extra/DataBaseConnect.php";
	
	$id = &$this->movieID;
	$query = "UPDATE Pornusy SET wyswietlenia = wyswietlenia + 1 WHERE klucz = $id";
	mysqli_query($dataBase,$query);
	$query = "SELECT * FROM Pornusy WHERE klucz = $id";
	$result = mysqli_query($dataBase,$query);
	
	$row = mysqli_fetch_assoc($result);
	$votesSummary = &$row['suma_głosów'];
	$votesNumber = &$row['liczba_głosów'];
	$tittle = &$row['opis'];
	$views = &$row['wyswietlenia'];
	$added = &$row['dodano'];
	$cumshotsNumber = &$row['ilość_wytrysków'];
	$pornstars = ($row['gwiazdy'] != "") ? $row['gwiazdy'] : null;
	$movies = $this->getSimilarMovies($row, $dataBase);
	
	$result = mysqli_query($dataBase, "SELECT * FROM movie_comments WHERE movie_id = $id");
	$commentsNumber = mysqli_num_rows($result);
	$singleUserRate = $this->getRateInfo();
	$spermatozoidInfo = $this->getCumshotDescription();
	return new MovieData($votesNumber, $votesSummary, $tittle, $movies, $added, $views, $cumshotsNumber, $pornstars, $singleUserRate, $spermatozoidInfo, $commentsNumber);
	
  }  
}

?>