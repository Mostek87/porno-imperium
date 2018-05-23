<?php

class CategoriesView
{
  private $data;
  public $pageHeader;
  public $cssClassName;
  
  function render()
 {
	  
    if($this->model->categoryName === "wszystkie")
	{
		if(file_exists("php/template/AllCategories.php"))
		{
		  require "php/template/AllCategories.php";
		}
	}
	else
	{
	  $this->data = $this->model->getMoviesData();
	  $this->pageHeader =  $this->parseCategory();
	  $this->cssClassName = $this->getCSSClassName();

         if(file_exists("php/template/SelectedCategory.php"))
		{
		  require "php/template/SelectedCategory.php";
		}	  
	}
	
 }
  
  private function parseCategory()  
	{
		switch($this->model->categoryName)
		{
			case "amatorskie-porno" :
			  return "Amatorskie";
			break;
			
			case "biale" :
			   return "Białe";
			break;
			
			case "duze-cycki" :
			 return "Duże cycki";
			break;
			
			case "duza-dupa" :
			  return "Duża dupa";
			break;
			
			case "gwiazdy-porno" :
			  return "Gwiazdy porno";
			break;
			
			case "seks-grupowy" :
			  return "Seks grupowy";
			break;
			
			case "kobieta-solo" :
			  return "Kobieta solo";
			break;
			
			case "kompilacje-wytryskow" :
			  return "Kompilacje wytrysków";
			break;
			
			case "kobieca-dominacja" :
			  return "Kobieca dominacja";
			break;
			
			case "robienie-loda" :
			  return "Lodzik";
			break;
			
			case "lazienka" :
			  return "Łazienka";
			break;
			
			case "lono-natury" :
			  return "Łono natury";
			break;
			
			case "seks-w-miejscach-publicznych":
			  return 'Miejsca publiczne';
			break;
			
			case "milf":
			  return "MILF'etki";
			break;
			
			case "male-cycki":
			  return "Małe cycki";
			break;
			
			case 'mala-dupa':
			  return "Mała dupa";
			break;
			
			case 'na-hiszpana':
			  return "Na hiszpana";
			break;
			
			case 'mala-dupa':
			  return "Mała dupa";
			break;
			
			case 'owlosione-cipki':
			  return "Owłosione cipki";
			break;
			
			case 'porno-po-polsku':
			  return "Porno po polsku";
			break;
			
			case 'polykanie-spermy':
			  return "Połykanie spermy";
			break;
			
			case 'pielegniarki':
			  return "Pielęgniarki";
			break;
			
			case 'podwojna-penetracja':
			  return "Podwójna penetracja";
			break;
			
			case 'ponczochy':
			  return "Pończochy";
			break;
			
			case 'plaza':
			  return "Plaża";
			break;
			
			case 'szkola':
			  return "Szkoła";
			break;
			
			case 'sado-maso':
			  return "Sado maso";
			break;
			
			case 'samochod':
			  return "Samochód";
			break;
			
			case 'silownia':
			  return "Siłownia";
			break;
			
			case 'wielki-kutas':
			  return "Wielki kutas";
			break;
			
			case 'walenie-konia':
			  return "walenie konia";
			break;
			
			case 'wytrysk-na-twarz':
			  return "Wytrysk na twarz";
			break;
			
			case 'wytrysk-na-cycki':
			  return "Wytrysk na cycki";
			break;
			
			case 'wytrysk-w-cipke':
			  return "Wytrysk w cipke";
			break;
			
			case 'wytrysk-na-cipke':
			  return "Wytrysk na cipke";
			break;
			
			case 'wytrysk-w-dupe':
			  return "Wytrysk w dupe";
			break;
			
			case 'wytrysk-na-dupe':
			  return "Wytrysk na dupe";
			break;
			
			case 'wytrysk-na-dupe':
			  return "Wytrysk na dupe";
			break;
			
			case 'wytrysk-na-stopy':
			  return "Wytrysk na stopy";
			break;
			
			case 'zonki':
			  return "Żonki";
			break;
			
			case 'ukryta-kamera':
			  return "ukryta kamera";
			break;
			
			default:
			 return ucfirst($this->model->categoryName);
			break;
		}
	}
	
	private function getCSSClassName()  //wyświetla odpowiednią klasę css w dla wybranej kategorii
	{
		$arr = array( 
		'anal' => 'anal-header',
		'amatorskie-porno' => 'amateur-header',
		'azjatki' => 'asian-header',
		'amerykanki' => 'american-header',
		'blondynki' => 'blonde-header',
		'brunetki' => 'brunette-header',
		'bukkake' => 'bukkake-header',
		'biale' => 'white-header',
		'blowbang' => 'blowbang-header',
		'bicze' => 'whips-header',
		'biuro' => 'office-header',
		'czeszki' => 'czech-header',
		'chude' => 'skinny-header',
		'duze-cycki' => 'big-titts-header',
		'duza-dupa' => 'big-ass-header',
		'dziwki' => 'hooker-header',
		'gangbang' => 'gangbang-header',
		'seks-grupowy' => 'group-header',
		'gwiazdy-porno' => 'pornstars-header',
		'japonki' => 'japanese-header',
		'kobieta-solo' => 'solo-header',
		'kompilacje-wytryskow' => 'cumshot-compilation-header',
		'kobieca-dominacja' => 'femdom-header',
		'latynoski' => 'latin-header',
		'lesbijki' => 'lesbians-header',
		'robienie-loda' => 'blowjob-header',
		'lateks' => 'latex-header',
		'lazienka' => 'bathroom-header',
		'lono-natury' => 'nature-header',
		'seks-w-miejscach-publicznych' => 'public-header',
		'milf' => 'milf-header',
		'murzynki' => 'ebony-header',
		'male-cycki' => 'small-titts-header',
		'mala-dupa' => 'small-ass-header',
		'minetka' => 'pussy-licking-header',
		'nauczycielki' => 'teacher-header',
		'nastolatki' => 'teen-header',
		'na-hiszpana' => 'tittfuck-header',
		'niemki' => 'german-header',
		'niewolnice' => 'slaves-header',
		'okularnice' => 'glasses-header',
		'owlosione-cipki' => 'hairy-pussy-header',
		'porno-po-polsku' => 'polish-header',
		'POV' => 'POV-header',
		'polykanie-spermy' => 'cum-swallowing-header',
		'pielegniarki' => 'nurse-header',
		'podwojna-penetracja' => 'double-penetration-header',
		'ponczochy' => 'stockings-header',
		'plaza' => 'beach-header',
		'policjantki' => 'police-header',
		'rajstopki' => 'pantyhose-header',
		'rosjanki' => 'russian-header',
		'rude' => 'redhead-header',
		'szpile' => 'high-heels-header',
		'szkola' => 'school-header',
		'sado-maso' => 'pain-header',
		'stopy' => 'feet-header',
		'samochod' => 'car-header',
		'szefowe' => 'boss-header',
		'sekretarki' => 'secretary-header',
		'silownia' => 'gym-header',
		'ukryta-kamera' => 'spycam-header',
		'uczennice' => 'pupil-header',
		'wielki-kutas' => 'huge-cock-header',
		'winda' => 'elevator-header',
		'walenie-konia' => 'handjob-header',
		'wytrysk-na-twarz' => 'cum-on-face-header',
		'wytrysk-na-cycki' => 'cum-on-titts-header',
		'wytrysk-w-cipke' => 'creampie-header',
		'wytrysk-na-cipke' => 'cum-on-pussy-header',
		'wytrysk-w-dupe' => 'cum-in-ass-header',
		'wytrysk-na-dupe' => 'cum-on-ass-header',
		'wytrysk-na-stopy' => 'cum-on-feet-header',
		'zonki' => 'wife-header',
		'zakonnice' => 'nun-header'
		                   );
		return $arr[$this->model->categoryName];
	}
	
	private function createTimeLabel($movie)
	{
	  $seconds = &$movie->seconds;
	  $hours = &$movie->hours;
      $minutes = &$movie->minutes;
	  
	  $seconds = $seconds < 10 ? "0$seconds" : $seconds;
	  $hours = $hours != null ? "0$hours:" : "";
	  
      if($minutes == null)
	  {
         $minutes = "00:";	
	  }
      else
      {
        $minutes = ($minutes < 10) ? "0$minutes:" : "$minutes:";
	  }  
	  
	  return $hours.$minutes.$seconds;
	}
	
	private function parseTittle($description)
	{
	  $illegalCharacters = array(" ","!","?",".");
      $legalCharacters = array("-","","","");

      return strtolower(str_replace($illegalCharacters,$legalCharacters,$description));	  
	}	
	
	private function showMovies() 
	{
	  $movies = &$this->data->moviesData;
	  
	  foreach($movies as $movie)
	  {
		 $timeLabel = $this->createTimeLabel($movie);
         $description = &$movie->tittle;
         $views = &$movie->views;
         $stars = &$movie->stars;
		 $id = &$movie->id;
		 
		 if($stars != null)
		{
		  $stars = 'data-stars="'.$stars.'"';	
		}
		else
		{
		  $stars = "";	
		}
		
		$polishLanguage = ($movie->polishTranslation == 1) ? '<div title="film w języku polskim" class="polish-flag"></div>' : "";
		$descriptionInURL = $this->parseTittle($description);
		$href = 'href=/film/'.$descriptionInURL.'/'.$id.'/';

         echo '<li class="movie-complete">
		       <div data-id="'.$id.'" class="image-and-duration"><a '.$href.' class="movie-link"><img class="movie-small-image" id="movie-image-'.$id.'" src="/images/movie/main/'.$id.'.jpg" /><img id="progressbar-'.$id.'" class="movie-progress-bar" src="/images/decoration/video-progress-bar.gif" />'.$polishLanguage.'<time class="duration">'.$timeLabel.'</time></div>
			   <div class="movie-description">'.$description.'</div></a>
			      <div class="additional-options">
					 <span class="views">'.$views.' odsłon</span>
					 <img alt="podgląd filmu" title="kiliknij aby podejrzeć film" class="magnifier-icon" '.$stars.' data-id="'.$id.'" src="/images/controls/magnifier.png"/>
			      </div>
	      </li>';			 
	  }
	}
	
	function CreateControls()
	{
	  $pagesNumber = &$this->data->pageControls->maxPageNumber;
	  
	    if($pagesNumber == 1)
		{
		  return;	
		}
		else
		{
			$activePage = &$this->model->pageNumber;
			$categoryURL = &$this->model->categoryName;
			
			echo '<ul id="bottom-controls" data-active-page="'.$activePage.'" data-last-page="'.$pagesNumber.'" class="page-toggle-controls">';
			
			    if($pagesNumber > 5)
				{
					
						echo ' <li class="controls-element">
								<button id="previous-page" class="page-selection page-selection-first-layer"><<</button>
							</li>';
							
						$leftNumber = $this->data->pageControls->pageControlNumberLeft;
							
						 for($i = 0; $i < 5; ++$i)
						{
						  
						    $activeCSSClass = ($leftNumber == $activePage) ? 'active' : '';
						  
						    echo '<li class="controls-element">
								  <a href="/kategorie/'.$categoryURL.'/strona/'.$leftNumber.'/" id="PageControl-'.$i.'" class="page-selection page-selection-first-layer '.$activeCSSClass.'">'.$leftNumber.'</a>
							     </li>';
							   
						   ++$leftNumber;
						}
						
						echo '<li class="controls-element">
							  <button id="next-page" class="page-selection page-selection-first-layer">>></button>
							 </li>';

                      $previousPageNumber = &$this->data->pageControls->previousPageNumber;
					  $nextPageNumber = &$this->data->pageControls->nextPageNumber;
					  
					  $leftAnchor = ( $previousPageNumber != null) ? 'href="/kategorie/'.$categoryURL.'/strona/'.$previousPageNumber.'/"' : "";
			          $rightAnchor = ($nextPageNumber != null) ?  'href="/kategorie/'.$categoryURL.'/strona/'.$nextPageNumber.'/"' : "";
					   
			       echo '<li class="controls-element controls-element-bottom">
					  <a '.$leftAnchor.'  class="page-selection page-selection-second-layer">wstecz</a>
				    </li>';
						   
			      echo '<li class="controls-element controls-element-bottom">
					 <a '.$rightAnchor.' class="page-selection page-selection-second-layer">dalej</a>
				  </li>';	 


				}
				else
				{
					
					for($i = 0; $i < $pagesNumber ; ++$i)
					{
					   $caption = $i + 1;
					   $activeCSSClass = ($caption == $activePage) ? 'active' : '';
					   echo '<li class="controls-element">
								  <a href="/kategorie/'.$categoryURL.'/strona/'.$caption.'/" id="PageControl-'.$i.'" class="page-selection page-selection-first-layer '.$activeCSSClass.'">'.$caption.'</a>
							     </li>';
					}
				}
				
			echo '</ul>';
		}
	}

  function __construct($model)
  {
   $this->model = $model;
  }  
}

?>