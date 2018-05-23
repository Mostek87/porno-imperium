<?php

 class WatchView extends View
 {
	 
   private $data;
   
   function render()
   {
	  if(file_exists("php/template/Theater.php"))
	  {  
	     $this->data = $this->model->getMovieData();
		 require("php/template/Theater.php");
	  }
	  else
	  {
		die("brak pliku wymaganego do odtworzenia filmu");  
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
   
   private function showPornstars(&$pornstars)
   {
	  if($pornstars == "")
	  {
		return;  
	  }
	  
	  $pluralSingular = (strpos($pornstars,",") > 0) ? "Gwiazdy : " : "Gwiazda : ";
	  
        $pornstarsArray = explode(",", $pornstars);
		echo '<li class="movie-information"><img class="information-decoration-icon" src="/images/decoration/stars.svg"/>'.$pluralSingular;
		
		foreach($pornstarsArray as $pornstar)
		{
		  $URLPart = strtolower(str_replace(" ", "-",$pornstar));
		  echo '<a href="/gwiazdy/'.$URLPart.'/" class="movie-parameter link-to-pornstar-profile">'.$pornstar.'</a> ';	
		}
		
		echo '</li>';
	   
   }
   
   private function showSimilarMovies()
   {
	  $movies = &$this->data->similarMovies;
	  
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
	
	private function getRateDescription()
	{
	    if($this->data->singleUserRate === -1)
		{
			echo "Oceń ten film ";
		}
		else
		{
		  echo "Twoja ocena ";	
		}
        			
	}
	
	
	 function __construct($model)
   {
	 $this->model = $model;  
   }
	
   }
   
  
 
 
?>