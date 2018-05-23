<?php

class PornstarsView extends View
{
	
  private function getColorClass($rate)
  {
       if(is_numeric($rate))
       {		   
			  if($rate <= 6.5)
			  {
				 return "bronze-rate"; 
			  }
			  
			  if($rate > 6.5 && $rate <= 8.5)
			  {
				 return "silver-rate"; 
			  }
			  
			  if($rate > 8.5 )
			  {
				 return "gold-rate"; 
			  }
	   }
	   
	   return "purple-rate";
  } 
  
  private function getPornstarWebsiteInfo(&$pornstarData)
  {
	$website = &$pornstarData->officialWebsite;
	
    if($website != "brak")
	{
	   echo '<div class="pornstar-information-detailed">
		   <span class="pornstar-information-type">Oficjalna strona : </span> <a target="_blank" href="http://'.$pornstarData->officialWebsite.'" class="pornstar-information-value pornstar-official-website">'.$pornstarData->officialWebsite.'</a>
		 </div>';
	}
	
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

   private function showPornstarMovies()
  {
     $movies = $this->model->getPornstarMovies();
	 
	 foreach($movies as &$movie)
	 {
		$time = $this->createTimeLabel($movie);
	    $description = &$movie->tittle;
		$views = &$movie->views;
		$id = &$movie->id;
		$descriptionInURL = $this->parseTittle($description);
		$href = 'href=/film/'.$descriptionInURL.'/'.$id.'/';
        $polishLanguage = ($movie->polishTranslation == 1) ? '<div title="film w języku polskim" class="polish-flag"></div>' : "";
		
		echo '<li class="movie-complete">
		       <div data-id="'.$id.'" class="image-and-duration"><a '.$href.' class="movie-link"><img id="movie-image-'.$id.'" class="movie-small-image" src="/images/movie/main/'.$id.'.jpg" /><img class="movie-progress-bar" id="progressbar-'.$id.'" src="/images/decoration/video-progress-bar.gif" />'.$polishLanguage.'<time class="duration">'.$time.'</time></div>
			   <div class="movie-description">'.$description.'</div></a>
			      <div class="additional-options">
					 <span class="views">'.$views.' odsłon</span>
					 <img alt="podgląd filmu" title="kiliknij aby podejrzeć film" class="magnifier-icon"  data-id="'.$id.'" src="/images/controls/magnifier.png"/>
			      </div>
	      </li>';	
	 }
  }  

  function render()
  {
	  
    if($this->model->pornstar == "wszystkie")
	{
		  if(file_exists("php/template/PornstarsList.php"))
		  {
			 require("php/template/PornstarsList.php");
		  }
		  else
		  {
			 die("Nie znaleziono pliku");
		  }  
	  
	}
	else
	{
		  if(file_exists("php/template/PornstarProfile.php"))
		  {
			 $pornstarData = $this->model->getPornstarData();
			 $reviewText = ($pornstarData->rated === -1) ? "Oceń tę fokę :" : "Twoja ocena :";
			 require("php/template/PornstarProfile.php");
		  }
		  else
		  {
			 die("Nie znaleziono pliku");
		  }  	
	}
  }

  function __construct($model)
  {
    $this->model = $model;
  }    
}

?>