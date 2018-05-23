<?php

class SearchModel
{
	
 public $action;
 public $descriptions;
 public $pageNumber;
 
 private function getDescription($str)
 {
	    switch($str)
		{
		  case "fabuła_kostiumy":
            return "fabuła, kostiumy";
          break;

          case "minuty":
            return "czas trwania w minutach";
          break;
		  
		  case "fabuła":
            return "filmy";
          break;
		  
		  case "lektorpl":
            return "filmy w języku polskim";
          break;
		  
		  case "dodano":
		    return "dodano w okresie";
		  break;

          default:
            $result = str_replace("_"," ",$str);
	        $result = str_replace("1","",$result);
			return $result;
          break;		  
		}
	
 }
 
 private function getDataBaseColumnName($str)
 {
	$dataBaseColumnNames = array(
	"tits-size" => "rozmiar_cycków",
	"ass-size" => "rozmiar_dupci",
	"fatness" => "tusza",
	"hair-color" => "kolor_włosów",
	"age" => "wiek",
	"race" => "rasa",
	"nationality" => "narodowość",
	"location" => "lokalizacja",
	"history" => "fabuła_kostiumy",
	"story" => "fabuła",
	"level" => "poziom",
	"camera-style" => "ujęcie",
	"number-of-people" => "liczebność1",
	"cumshot" => "wytrysk",
	"pornstar" => "gwiazdy",
	"time-range" => "minuty",
	"date-range" => "dodano",
	"anal" => "anal",
	"blowjob" => "lodzik",
	"vaginal-sex" => "w_cipke",
	"handjob" => "trzepanie",
	"tittfuck" => "w_cyce",
	"pussy-licking" => "minetka",
	"feet" => "stópki",
	"dp" => "wtyczka",
	"69" => "lim",
	"pantyhose" => "rajstopki",
	"stockings" => "pończoszki",
	"whips" => "bicze",
	"glasses" => "okularki",
	"sex-toys" => "sex_zabawki",
	"high-heels" => "szpile",
	"polish-language" => "lektorpl",
	"big-cock" => "wielki_kutas",
	"spycam" => "kamera_szpiegowska",
	"bdsm" => "sado_maso",
	"femdom" => "kobieca_dominacja",
	"cumshot-compilation" => "kompilacja_wytrysków"
	);
	
	if(array_key_exists($str,$dataBaseColumnNames))
	{
		return $dataBaseColumnNames[$str];
	}
	else
	{
		die("Nieprawidłowa wartość parametru");
	}
 }
 
 private function parseInput()
 {
	 $selectsSingle = array(
		"tits-size",
		"ass-size",
		"fatness",
		"hair-color",
		"age",
		"race",
		"nationality",
		"location",
		"history",
		"story",
		"level",
		"camera-style",
		"number-of-people",
		"cumshot",
		"time-range",
		"date-range"
	);
	
	$sexTypeCheckbox = array(
	  "anal",
	  "blowjob",
	  "vaginal-sex",
	  "handjob",
	  "tittfuck",
	  "pussy-licking",
	  "feet",
	  "dp",
	  "69"
	);
	
	$uncoupledCheckBoxes = array(
	  "pantyhose",
	  "stockings",
	  "whips",
	  "glasses",
	  "sex-toys",
	  "high-heels",
	  "polish-language",
	  "big-cock",
	  "spycam",
	  "bdsm",
	  "femdom",
	  "cumshot-compilation"
	);
	
	$chosenParameters = array();
	$this->descriptions = array();
	
	foreach($selectsSingle as $select)
	{
	   if(isset($_POST[$select]))
	   {
		 $selectValue =  $_POST[$select];
		 
		    if($selectValue !== "--")
			{
			  $columnName = $this->getDataBaseColumnName($select);
              $description = $this->getDescription($columnName)." : ".$selectValue;
              array_push($chosenParameters, new FormData($columnName,$selectValue,"simple-select"));
              array_push($this->descriptions,$description);			  
			}
			else
			{
			  continue;	
			}
			
	   }
	   else
	   {
		  die("brak odpowiednich parametrów"); 
	   }
	     
	}
	
	foreach($sexTypeCheckbox as $checkboxName)
	{
		if(isset($_POST[$checkboxName]))
		{
		   $value = $_POST[$checkboxName."-ammount"];
		   
		   if($value !== "--")
		   {
		      $columnName = $this->getDataBaseColumnName($checkboxName);
              $description = $this->getDescription($columnName)." : ".$value;
              array_push($chosenParameters, new FormData($columnName,$value,"sex-select"));
			  array_push($this->descriptions,$description);
		   }
		}
	}
	
	foreach($uncoupledCheckBoxes as $checkbox)
	{
	  if(isset($_POST[$checkbox]))
	  {
		 $value =  "1";
         $columnName = $this->getDataBaseColumnName($checkbox);
		 $description = $this->getDescription($columnName);
         array_push($chosenParameters, new FormData($columnName,$value,"simple-checkbox"));
         array_push($this->descriptions,$description);		 
	  }
	}
	
	
	   $pornstar = $_POST['pornstar'];
	   
	   switch($pornstar)
	   {
		  case "tylko gwiazdy":
            array_push($this->descriptions, "filmy tylko z gwiazdami porno");
            array_push($chosenParameters, new FormData("gwiazdy","%","simple-select"));
          break;

          case "--":

          break;

          default:
            array_push($this->descriptions, "filmy z $pornstar");
            array_push($chosenParameters, new FormData("gwiazdy",$pornstar,"simple-select"));
          break;		  
	   }
	
	if(!isset($_SESSION['descriptions']))
	{
	  $_SESSION['descriptions'] = $this->descriptions;	
	}
	
	return $chosenParameters;
 }
 
 private function parseSexAmmount($sexType, $ammount)
 {
	 
	 $queryPart = "";
	 
    switch($ammount)
	{
	  case "tylko i wyłącznie":
		  $sexTypesColumns = array(
			"anal",
			"lodzik",
			"w_cipke",
			"minetka",
			"lim",
			"w_cyce",
			"stópki",
			"trzepanie",
			"wtyczka"
		  );
		  
		  if(($key = array_search($sexType,$sexTypesColumns)) !== false )
		  {
			 unset($sexTypesColumns[$key]);
             
               foreach($sexTypesColumns as $column)
			   {
                 $queryPart .= "$column is NULL AND "; 
			   }

                $queryPart .= "$sexType > 89 AND "; 			   
		  }
		  else
		  {
			die("nieprawidłowa wartość parametru ilości");  
		  }
		break;
		
		case "trochę":
		  $queryPart .= "$sexType < 35 AND ";
		break;
		
		case "średnio":
		  $queryPart .= "$sexType > 34 AND $sexType < 61 AND ";
		break;
		
		case "dużo":
		  $queryPart .= "$sexType > 60 AND ";
		break;
		
		case "maksimum":
		  $queryPart .= "$sexType > 89 AND ";
		break;
		
		default:
		 die("nieprawidłowa wartość parametru ilości"); 
		break;
    }
	
   return $queryPart;  
 }
 
 private function createQuery()
 {
	 
	 if(isset($_SESSION['query']))
	 {
		return $_SESSION['query'];
	 }
	
	$formData = $this->parseInput();
	$query = "";
    
    foreach($formData as $dataBaseQueryData)
    {
      $columnName = &$dataBaseQueryData->columnName;
	  $value = &$dataBaseQueryData->value;
	  
	   switch($columnName)
	   {
		  case "minuty":
		  
		     switch($value)
			 {
				case "--" :

                break;

                case "powyżej 40" :
                  $query .= "minuty > 40 AND ";
                break;

               default:
			    $offsets = explode("-",$value);
			    $offsetBeginning = $offsets[0];
			    $offsetEnd = $offsets[1];
			    $query .= "minuty > $offsetBeginning AND minuty < $offsetEnd AND godziny is NULL AND ";
               break;			   
			 }
           
          break;

         case "dodano":
		    switch($value)
			{
				case '--' :
				
				break;
				
				case 'dzisiejsze' :
				 $query .= 'dodano = CURDATE() AND ';
				break;
				
				case 'ostatnie dwa dni' :
				  $query .= "dodano >= DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND ";
				break;
				
				case 'ostatni tydzień' :
				  $query .= "dodano >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND ";
				break;
				
				case 'ostatni miesiąc' :
				  $query .= "dodano >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND ";
				break;
				
				case 'ostatni rok' :
				  $query .= "dodano >= DATE_SUB(CURDATE(), INTERVAL 365 DAY) AND ";
				break;
			}
         break;	
		 
		 case "fabuła":
		   if($value === "z fabułą")
		   {
			  $query .= "fabuła = 1 AND "; 
		   }
		   else
		   {
			  $query .= "fabuła is NULL AND ";  
		   }
		 break;

         default:
		 
			   switch($dataBaseQueryData->parsingType)
			   {
				  case "simple-select":
                    $query .= "$columnName LIKE '$value' AND ";
				  break;

				  case "simple-checkbox":
                    $query .= "$columnName = 1 AND ";
				  break;

				 case "sex-select":
                   $query .= $this->parseSexAmmount($columnName,$value);
				 break;	

                 default:
                  die("nieprawidłowy typ kontrolki");
                 break;				 
			   }
			   
         break;		 
	   }
	}
	
    if($query !== "")
	{
	  $query = substr($query,0,strlen($query) - 5);
	  $_SESSION['query'] = $query;
      return $query;
	}
    else
    {
      return null;
	}
 }
 
    private function calculatePageControls($total)
	{
	  $maxPageNumber = ceil($total / 50);
	  $pageNumber = $this->pageNumber;
	  $pageControls = new PageControlsData();
	  
      if($maxPageNumber - 5 >= $pageNumber)
      {
        $pageControls->pageControlNumberLeft = $pageNumber;
		$pageControls->activePagePosition = 1;
	  }
      else
	  {
        $pageControls->pageControlNumberLeft = $maxPageNumber - 4;
		$pageControls->activePagePosition = 5 + $pageNumber - $maxPageNumber;
	  }
	  
	  if($maxPageNumber > 5 )
	  {
		$pageControls->previousPageNumber = ($pageNumber > 1) ? $pageNumber - 1 : null;
        $pageControls->nextPageNumber = ($pageNumber < $maxPageNumber) ? $pageNumber + 1 : null;		
	  }
	  
      $pageControls->maxPageNumber = $maxPageNumber;
	  $pageControls->totalMovies = $total;
	  
	  return $pageControls;	
	}
 
 
 public function searchMovies()
 {
	require "php/extra/DataBaseConnect.php";
	$movies = array();
	$queryCore = $this->createQuery();
   
    if($queryCore !== null)
	{		
		$query = "SELECT COUNT(*) as total FROM Pornusy WHERE $queryCore";
		$result = mysqli_query($dataBase,$query);
		$row = mysqli_fetch_assoc($result);
		$total = $row['total'];
		$controls = $this->calculatePageControls($total);
		
		$offset = ($this->pageNumber === 1) ? "" : "OFFSET ".(($this->pageNumber -1) * 50);
		
		$query = "SELECT * FROM Pornusy WHERE $queryCore ORDER BY klucz DESC LIMIT 50 $offset";
		$result = mysqli_query($dataBase,$query);
		
		while($row = mysqli_fetch_assoc($result))
		{
		  array_push($movies, new Movie($row['opis'], $row['gwiazdy'],$row['wyswietlenia'], $row['sekundy'],$row['minuty'],$row['godziny'], $row['lektorpl'],$row['klucz']));	
		}
		
		return new PagePackage($movies,$controls);
	}
	else
	{
		return null;
	}
	
 }
 
}

?>