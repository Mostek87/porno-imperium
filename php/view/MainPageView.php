<?php
 class MainPageView extends View
 {
	 private $dataPackage;
	 
	function __construct($model)
	{
		$this->model = $model;
	}
	
	function render()
	{
	  if(file_exists("php/template/MainPage.php"))
	  {
		$this->dataPackage = $this->model->getMoviesData();
		require "php/template/MainPage.php"; 
	  }
	  else
	  {
		 die("błąd - brak pliku strony głównej"); 
	  }
	}
	
	private function createBackForwardControls()              
	{
	  $pageControls = &$this->dataPackage->pageControls;
	  $leftControlNumber = &$pageControls->pageControlIndex1;
	  $maxPageIndex = &$pageControls->maxPageIndex;
	  $activePageNumber = &$this->model->currentPage;
	  
	  $leftAnchor = ($pageControls->previousPageNumber != null) ? 'href="/strona/'.$pageControls->previousPageNumber.'/"' : "";
	  $rightAnchor = ($pageControls->nextPageNumber != null) ? 'href="/strona/'.$pageControls->nextPageNumber.'/"' : "";
	  
    
	     echo '<li class="controls-element controls-element-bottom">
          <a '.$leftAnchor.' class="page-selection page-selection-second-layer">wstecz</a>
          </li>';
   
        echo '<li class="controls-element controls-element-bottom">
          <a '.$rightAnchor.' class="page-selection page-selection-second-layer">dalej</a>
        </li>';
		
	}
	
	 function createPageNumbers()  //wyświetlanie kontrolek sterujących podstronami
	{
	 $pageControls = &$this->dataPackage->pageControls;
	 $LeftNumber = &$pageControls->pageControlIndex1;
     $ActiveControl = &$pageControls->activePagePosition;
	 
		for($I = 0; $I < 5; ++$I)
		{
			$Class = ($I + 1 == $ActiveControl) ? "active" : "";
			$PageNumber = $I + $LeftNumber;
			
			echo '<li class="controls-element">
                   <a href="/strona/'.$PageNumber.'/" id="PageControl-'.$I.'" class="page-selection page-selection-first-layer '.$Class.'">'.$PageNumber.'</a>
                 </li>';
		}
	}
	
	private function parseTittle($description)
	{
	  $illegalCharacters = array(" ","!","?",".");
      $legalCharacters = array("-","","","");

      return strtolower(str_replace($illegalCharacters,$legalCharacters,$description));	  
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
	
	function showMovies()  //wyświetlanie filmów
	{
		$currentID = &$this->dataPackage->pageControls->topIndex;
		
		foreach($this->dataPackage->moviesData as $movie)
		{
			$time = $this->createTimeLabel($movie);
			$description = &$movie->tittle;
			$views = &$movie->views;
			$stars = &$movie->stars;
			$polishLanguage = ($movie->polishTranslation == 1) ? '<div title="film w języku polskim" class="polish-flag"></div>' : "";
			$descriptionInURL = $this->parseTittle($description);
			$href = 'href=/film/'.$descriptionInURL.'/'.$currentID.'/';
			
			if($stars != null)
			{
			  $stars = 'data-stars="'.$stars.'"';	
			}
			else
			{
			  $stars = "";	
			}
			
		   echo '<li class="movie-complete">
		       <div data-id="'.$currentID.'" class="image-and-duration"><a '.$href.' class="movie-link"><img id="movie-image-'.$currentID.'" class="movie-small-image"  src="/images/movie/main/'.$currentID.'.jpg" /><img id="progressbar-'.$currentID.'" class="movie-progress-bar" src="/images/decoration/video-progress-bar.gif" />'.$polishLanguage.'<time class="duration">'.$time.'</time></div>
			   <div class="movie-description">'.$description.'</div></a>
			      <div class="additional-options">
					 <span class="views">'.$views.' odsłon</span>
					 <img alt="podgląd filmu" title="kiliknij aby podejrzeć film" class="magnifier-icon" '.$stars.' data-id="'.$currentID.'" src="/images/controls/magnifier.png"/>
			      </div>
	      </li>';	
		  
		  --$currentID;
		}
	}
 }

?>