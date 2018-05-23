<?php

class SearchView extends View
{
  private $data;
  
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
		  if($this->data !== null)
		  {	  
			 $movies = &$this->data->moviesData;
		  
			  foreach($movies as $movie)
			  {
				 $timeLabel = $this->createTimeLabel($movie);
				 $description = &$movie->tittle;
				 $views = &$movie->views;
				 $stars = &$movie->stars;
				 $id = &$movie->id;
				 $polishLanguage = ($movie->polishTranslation == 1) ? '<div title="film w języku polskim" class="polish-flag"></div>' : "";
				 $descriptionInURL = $this->parseTittle($description);
		         $href = 'href=/film/'.$descriptionInURL.'/'.$id.'/';
				 
				 if($stars != null)
				{
				  $stars = 'data-stars="'.$stars.'"';	
				}
				else
				{
				  $stars = "";	
				}

				 echo '<li class="movie-complete">
					   <div data-id="'.$id.'" class="image-and-duration"><a '.$href.' target="_blank" class="movie-link"><img id="movie-image-'.$id.'" class="movie-small-image" src="/images/movie/main/'.$id.'.jpg" /><img id="progressbar-'.$id.'" class="movie-progress-bar" src="/images/decoration/video-progress-bar.gif" />'.$polishLanguage.'<time class="duration">'.$timeLabel.'</time></div>
					   <div class="movie-description">'.$description.'</div></a>
						  <div class="additional-options">
							 <span class="views">'.$views.' odsłon</span>
							 <img alt="podgląd filmu" title="kiliknij aby podejrzeć film" class="magnifier-icon" '.$stars.' data-id="'.$id.'" src="/images/controls/magnifier.png"/>
						  </div>
				  </li>';			 
			  }
		  }
		  
	}
	
	private function createControls()
	{
	  if($this->data !== null)
	  {
		  $pagesNumber = &$this->data->pageControls->maxPageNumber;
		 
			if($pagesNumber == 1)
			{
			  return;	
			}
			else
			{
				$activePage = &$this->model->pageNumber;
				
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
									  <a href="/wyszukiwanie/wyniki/strona/'.$leftNumber.'/" id="PageControl-'.$i.'" class="page-selection page-selection-first-layer '.$activeCSSClass.'">'.$leftNumber.'</a>
									 </li>';
								   
							   ++$leftNumber;
							}
							
							echo '<li class="controls-element">
								  <button id="next-page" class="page-selection page-selection-first-layer">>></button>
								 </li>';

						  $previousPageNumber = &$this->data->pageControls->previousPageNumber;
						  $nextPageNumber = &$this->data->pageControls->nextPageNumber;
						  
						  $leftAnchor = ( $previousPageNumber != null) ? 'href="/wyszukiwanie/wyniki/strona/'.$previousPageNumber.'/"' : "";
						  $rightAnchor = ($nextPageNumber != null) ?  'href="/wyszukiwanie/wyniki/strona/'.$nextPageNumber.'/"' : "";
						   
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
									  <a href="/wyszukiwanie/wyniki/strona/'.$caption.'/" id="PageControl-'.$i.'" class="page-selection page-selection-first-layer '.$activeCSSClass.'">'.$caption.'</a>
									 </li>';
						}
					}
					
				echo '</ul>';
			}
	  }
	}
	
  public function render()
  {
	 $action = &$this->model->action;
	 
     if($action == "Panel")
     {
        require "php/template/Search.php";
	 }
     else if($action == "Results")
	 {
       $this->data = $this->model->searchMovies();
	   require "/php/template/SearchResults.php";
	 } 
  }
  
  private function createReport()
  {
	  
	if($this->data !== null)
	{
	   
	   if(isset($_SESSION['descriptions']))
	   {
		  $descriptions = $_SESSION['descriptions'];
	   }
	   else
	   {
		 $descriptions = &$this->model->descriptions;   
	   }
	   
	   echo 'Wybrane przez Ciebie opcje 
       <ul class="users-parameters-list">';
		
          foreach($descriptions as $description)
         {
           echo "<li>$description</li>";
	     }
		 
       echo "</ul>";
	   
	   $totalMovies = &$this->data->pageControls->totalMovies;
	   
	   if($totalMovies > 0)
	   {
		  echo '<h1 class="search-results-header">Wyniki wyszukiwania</h1>
                 Znaleziono '.$totalMovies.' film(ów) pasujących do Twoich kryteriów'; 
	   }
	   else
	   {
		  echo 'Niestety nie znaleziono filmów pasujących do wybranych kryteriów. Polecamy spróbować ponownie w przyszłości lub zmniejszyć ilość wybranych opcji';  
	   }
	}
	else
	{
	  echo "Należy wybrać co najmniej jedną opcję";
	}
	
	
  }
  
  function __construct($model)
  {
    $this->model = $model;
  }    
}

?>