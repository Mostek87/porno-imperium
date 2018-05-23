<?php

class CategoriesModel
{
  public $pageNumber;
  public $categoryName;
  
     private function createCoreQuery()  //tworzę zapytanie do bazy danych na podstawie wybranej kategorii
	{

      switch($this->categoryName)
      {
        case "anal" :
		  return "anal > 89 ";
		break;
		
		case "amatorskie-porno" :
		 return "poziom LIKE 'amatorski' " ;
		break;
		
		case "azjatki" :
		  return "rasa LIKE 'azjatki' ";
		break;
		
		case "amerykanki" :
		  return "narodowość LIKE 'amerykanki' ";
		break;
		
		case "blondynki" :
		  return "kolor_włosów LIKE 'blondynki' ";
		break;
		
		case "brunetki" :
		  return "kolor_włosów LIKE 'brunetki' ";
		break;
		
		case "bukkake" :
		  return "liczebność1 LIKE 'Bukkake' ";
		break;
		
		case "biale" :
		  return "rasa LIKE 'białe' ";
		break;
		
		case "blowbang" :
		  return "lodzik > 89 AND liczebność1 LIKE 'GangBang' ";
		break;
		
		case "bicze" :
		  return "bicze = 1 ";
		break;
		
		case "biuro" :
		  return "lokalizacja LIKE 'biuro' ";
		break;
		
		case "czeszki" :
		  return "narodowość LIKE 'czeszki' ";
		break;
		
		case "chude" :
		  return "tusza LIKE 'chuda' ";
		break;
		
		case "duze-cycki" :
		  return "rozmiar_cycków LIKE 'duże' ";
		break;
		
		case "duza-dupa" :
		  return "rozmiar_dupci LIKE 'duża' ";
		break;
		
		case "dziwki" :
		  return "fabuła_kostiumy LIKE 'dziwki' ";
		break;
		
		case "gangbang" :
		  return "liczebność1 LIKE 'GangBang' ";
		break;
		
		case "seks-grupowy" :
		  return "liczebność1 LIKE 'Grupowy' OR liczebność2 LIKE 'Grupowy' ";
		break;
		
		case "gwiazdy-porno" :
		  return "gwiazdy LIKE '%' ";
		break;
		
		case "japonki" :
		  return "narodowość LIKE 'japonki' ";
		break;
		
		case "kobieta-solo" :
		  return "liczebność1 LIKE 'masturbacja' ";
		break;
		
		case "kompilacje-wytryskow" :
		  return "kompilacja_wytrysków = 1 ";
		break;
		
		case "kobieca-dominacja" :
		  return "kobieca_dominacja = 1 ";
		break;
		
		case "latynoski" :
		  return "rasa LIKE 'latynoski' ";
		break;
		
		case "lesbijki" :
		  return "liczebność1 LIKE 'lesbijki' ";
		break;
		
		case "robienie-loda" :
		  return "lodzik > 89 ";
		break;
		
		case "lateks" :
		  return "latex = 1 ";
		break;
		
		case "lazienka" :
		  return "lokalizacja LIKE 'łazienka' ";
		break;
		
		case "lono-natury" :
		  return "lokalizacja LIKE 'łono natury' ";
		break;
		
		case "seks-w-miejscach-publicznych" :
		  return "lokalizacja LIKE 'miejsca publiczne' ";
		break;
		
		case "milf" :
		  return "wiek LIKE 'dojrzałe' ";
		break;
		
		case "murzynki" :
		  return "rasa LIKE 'murzynki' ";
		break;
		
		case "male-cycki" :
		  return "rozmiar_cycków LIKE 'małe' ";
		break;
		
		case "mala-dupa" :
		  return "rozmiar_dupci LIKE 'mała' ";
		break;
		
		case "minetka":
		 return "minetka > 89 ";
		break;
		
		case "nauczycielki":
		 return "fabuła_kostiumy LIKE 'nauczycielki' ";
		break;
		
		case "nastolatki":
		 return "wiek LIKE 'nastolatki' ";
		break;
		
		case "na-hiszpana":
		  return "w_cyce > 89 ";
		break;
		
		case "niemki":
		 return "narodowość LIKE 'Niemki' ";
		break;
		
		case "niewolnice":
		 return "fabuła_kostiumy LIKE 'niewolnice' ";
		break;
		
		case "okularnice":
		  return "okularki = 1 ";
		break;
		
		case "owlosione-cipki":
		 return "cipka LIKE 'niewygolona' ";
		break;
		
		case "porno-po-polsku":
		 return "lektorpl = 1 ";
		break;
		
		case "POV":
		 return "ujęcie LIKE 'POV' ";
		break;
		
		case "pielegniarki":
		 return "fabuła_kostiumy LIKE 'pielęgniarki' ";
		break;
		
		case "podwojna-penetracja":
		 return "wtyczka > 89 ";
		break;
		
		case "ponczochy":
		 return "pończoszki = 1 ";
		break;
		
		case "plaza":
		 return "lokalizacja LIKE 'plaża' ";
		break;
		
		case "policjantki":
		 return "fabuła_kostiumy LIKE 'policjantki' ";
		break;
		
		case "polykanie-spermy":
		 return "wytrysk LIKE 'do dzioba z połykiem' ";
		break;
		
		case "rajstopki":
		 return "rajstopki = 1 ";
		break;
		
		case "rosjanki":
		 return "narodowość LIKE 'rosjanki' ";
		break;
		
		case "rude":
		 return "kolor_włosów LIKE 'rude' ";
		break;
		
		case "szpile":
		 return "szpile = 1 ";
		break;
		
		case "szkola":
		 return "lokalizacja LIKE 'szkoła' ";
		break;
		
		case "sado-maso":
		 return "sado_maso = 1 ";
		break;
		
		case "stopy":
		 return "stópki > 89 ";
		break;
		
		case "samochod":
		 return "lokalizacja LIKE 'samochód' ";
		break;
		
		case "szefowe":
		 return "fabuła_kostiumy LIKE 'szefowe' ";
		break;
		
		case "sekretarki":
		 return "fabuła_kostiumy LIKE 'sekretarki' ";
		break;
		
		case "silownia":
		 return "lokalizacja LIKE 'siłownia' ";
		break;
		
		case "ukryta-kamera":
		 return "kamera_szpiegowska = 1 ";
		break;
		
		case "uczennice":
		 return "fabuła_kostiumy LIKE 'uczennice' ";
		break;
		
		case "walenie-konia":
		 return "trzepanie > 89";
		break;
		
		case "wielki-kutas":
		 return "wielki_kutas = 1 ";
		break;
		
		case "winda":
		 return "lokalizacja LIKE 'winda' ";
		break;
		
		case "wytrysk-na-twarz":
		 return "wytrysk LIKE 'na twarz/do dzioba' ";
		break;
		
		case "wytrysk-na-cycki":
		 return "wytrysk LIKE 'na cycki' ";
		break;
		
		case "wytrysk-w-cipke":
		 return "wytrysk LIKE 'w cipkę' ";
		break;
		
		case "wytrysk-na-cipke":
		 return "wytrysk LIKE 'na cipkę' ";
		break;
		
		case "wytrysk-w-dupe":
		 return "wytrysk LIKE 'w dupcię' ";
		break;
		
		case "wytrysk-na-dupe":
		 return "wytrysk LIKE 'na dupcię' ";
		break;
		
		case "wytrysk-na-stopy":
		 return "wytrysk LIKE 'na stopy' ";
		break;
		
		case "zonki":
		 return "fabuła_kostiumy LIKE 'żonki' ";
		break;
		
		case "zakonnice":
		 return "fabuła_kostiumy LIKE 'zakonnice' ";
		break;
		
		default:
		  die("nieprawidłowy adres url");
		break;
	  }	
         	  
	}
	
	private function modifyQuery(&$coreQuery)
	{
		  
		  $number = $this->pageNumber - 1;
		  
          if($number === 0)
		  {
			return "SELECT * FROM Pornusy WHERE ".$coreQuery." ORDER BY klucz DESC LIMIT 50";  
		  }
		  else
		  {
		    $offset = $number * 50;
			return "SELECT * FROM Pornusy WHERE ".$coreQuery." ORDER BY klucz DESC LIMIT 50 OFFSET $offset"; 
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
	  
	  return $pageControls;	
	}

  function getMoviesData()
  {
          require "php/extra/DataBaseConnect.php";
		  
		  $coreQuery = $this->createCoreQuery();
		  $query = "SELECT COUNT(*) as total FROM Pornusy WHERE ".$coreQuery;
		  $result = mysqli_query($dataBase,$query);
		  $row = mysqli_fetch_assoc($result);
		  $moviesNumber = Intval($row['total']);
		  
		  $query = $this->ModifyQuery($coreQuery);
		  $result = mysqli_query($dataBase,$query);
		  
		  $movies = array();
		  
		  while($row = mysqli_fetch_assoc($result))
		  {
			array_push($movies, new Movie($row['opis'], $row['gwiazdy'],$row['wyswietlenia'], $row['sekundy'],$row['minuty'],$row['godziny'], $row['lektorpl'],$row['klucz']));
		  }
		  
		  mysqli_close($dataBase);
		  $controls = $this->calculatePageControls($moviesNumber);
		  return new PagePackage($movies,$controls);
 }
}
?>