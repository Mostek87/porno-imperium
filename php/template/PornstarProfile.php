<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="UTF-8"/>
	<title>Profil gwiazdy : <?php echo $pornstarData->nickName; ?></title>
	<meta name="description" content="Filmy, informacje o gwieździe porno : <?php echo $pornstarData->nickName; ?> ">
	<meta name="keywords" content="gwiazda, porno, profil, <?php echo $pornstarData->nickName; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Cybertron">
	<link rel="stylesheet" href="/css/pornstar-profile.css">
	<link href='https://fonts.googleapis.com/css?family=Exo+2:400,400italic|Monda' rel='stylesheet' type='text/css'>	
    <link href='http://fonts.googleapis.com/css?family=Baloo+Da|Catamaran|Play|Hind|Lalezar&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="/css/star-rating-svg.css">
  </head>
  
  <body>
  	 
<nav class="main_nav">
	<ul id="menu" class="action_list_main">
	
	     <li class="logo-item">
		     <a class="navigation-link"  href="/"><img alt="powrót do strony głównej" class="empire-logo" src="/images/decoration/logo.png" /><img class="empire-logo-small" src="/images/decoration/logo-small.jpg" /></a>
	     </li>
	  
	    <li class="action_option_main">
	      <a class="navigation-link" href="/#najnowsze-filmy-porno">najnowsze</a>
	    </li>
	
	   <div class="vertical-separator"></div>
	
	   <li id="show-categories" class="action_option_main"><button class="navbar-button action_option_main">kategorie</button></li>
	   
		   <div class="vertical-separator"></div>
		   
	   <li class="action_option_main"><a class="navigation-link" href="/wyszukiwanie/">szukaj</a></li>
	   
		   <div class="vertical-separator"></div>
		   
	   <li class="action_option_main"><a class="navigation-link" href="/gwiazdy/wszystkie/">gwiazdy</a></li>
	   
    </ul>
</nav>
	 
<main>

 <div class="pornstar-container">
 <div class="pornstar-image <?php echo $this->model->pornstar; ?>-big-profile"></div>
 
 <div class="pornstar-information-container">
   <h1 id="pornstar-id" class="pornstar-nickname"><?php echo $pornstarData->nickName; ?></h1>
     <div class="pornstar-informations">
	 
       <div class="pornstar-image-small <?php echo $this->model->pornstar; ?>-profile-photo">
	    
	   </div>
	   
	   <div class="pornstar-personal-information">
	   <h2 class="pornstar-section-header">Informacje</h2>
	     <div class="pornstar-information-detailed">
		   <span class="pornstar-information-type">Prawdziwe imię i nazwisko : </span> <span class="pornstar-information-value"><?php echo $pornstarData->trueName; ?></span>
		 </div>
		 
		 <div class="pornstar-information-detailed">
		   <span class="pornstar-information-type">Data i miejsce urodzenia : </span> <span class="pornstar-information-value"><?php echo $pornstarData->birthData; ?></span>
		 </div>
		 
		 <div class="pornstar-information-detailed">
		   <span class="pornstar-information-type">Narodowość : </span> <span class="pornstar-information-value"><?php echo $pornstarData->nationality; ?></span> 
		 </div>
		 
		 <div class="pornstar-information-detailed">
		   <span class="pornstar-information-type">Lata aktywności : </span> <span class="pornstar-information-value"><?php echo $pornstarData->activeYears; ?></span>
		 </div>
		 
		 <?php $this->getPornstarWebsiteInfo($pornstarData); ?>
		 
		 <div class="pornstar-information-detailed">
		   <span class="pornstar-information-type">Typ balonów : </span> <span class="pornstar-information-value"><?php echo $pornstarData->tittsType; ?></span>
		 </div>
		 
		 
		 <div class="pornstar-information-detailed">
		 
		   <p class="description-paragraph pornstar-information-value"><span class="pornstar-information-type">Ciekawostki, historyjki : </span><?php echo $pornstarData->descriptionBeginning; ?></p>
	   
	   <p class="description-paragraph pornstar-information-value">
	   <?php echo $pornstarData->descriptionEnd; ?>
	   </p>

		 </div>
	   
	   </div>
	   
	   <div class="pornstar-controls">
	   <div class="rating-container rating-container-left">
		  <span id="users-average-rate-text" class="rating-text">Średnia ocen : </span> <div data-rate="<?php echo $pornstarData->averageRate; ?>" class="rating-stars" id="rating-stars-readonly"></div> <span id="users-average-rate-value" class="rating-text <?php echo $this->getColorClass($pornstarData->averageRate); ?>"><?php echo $pornstarData->averageRate; ?></span>
	   </div>
	   
	   <div class="rating-container">
		  <span id="user-review-text" class="rating-text"><?php echo $reviewText; ?></span> <div data-rated="<?php echo $pornstarData->rated; ?>" class="rating-stars" id="user-rating"></div> <span id="current-rate" class="rating-text current-user-rating"></span>
	   </div>
     </div>
	 
	 <h2 class="header">Filmy</h2>
	 
	 <ul class="movies-container">
	   <?php $this->showPornstarMovies();?>
     </ul>
	 
	 <div class="comments-tab">
	   <button type="button" id="leave-comment" class="comment-option comment-option-active">Zostaw komentarz</button>
	   <button type="button" id="show-comments" class="comment-option comment-option-inactive">Opinie widzów(<?php echo $pornstarData->commentsNumber; ?>)</button>
	   <div id="square" class="square-decoration"></div>
	 </div>
	 
 <div id="user-action" class="user-action-background">	 
	 <form id="post-a-comment" class="comment-controls">
	 <img src="/images/users/anonymous.jpg" class="user-avatar" alt="" />
	   <div class="controls-group">
	      <label class="label-user-opinion" for="user-opinion">Treść komentarza</label>
	      <textarea id="user-opinion" maxlength="1000" class="user-message" required></textarea>
		  <div class="form-bottom-controls">
	        <label class="nick-label">Twój nick :<input maxlength="20" id="nick" name="user-nick" class="user-nick" type="text" required /></label>
	        <button type="button" id="post-comment" class="submit-comment">Skomentuj</button>
		  </div>
		  
	   </div>
	 </form>
	 <div id="dark-canvas" class="cover-comments-canvas"></div>
	 <img class="ajax-loading-icon" id="ajax-loader" src="/images/decoration/ajax-loader.gif"/>
	 
	 <div id="users-opinions" data-number-of-comments="<?php echo $pornstarData->commentsNumber?>" data-comments-offset="0" data-anonymous-user="1" data-more-comments-available="1" class="comments-container"></div>
	
   </div>
 </div>
 
    
</main>


	 
<footer class="porn-empire-footer">

    <div class="footer-contact-data">
	      <a class="footer-link" href="mailto:cybertron2030@gmail.com">Kontakt przez e-mail</a>
	</div>
	
	<div class="footer-contact-data">
	  <a class="footer-link" href="/formularz-kontaktowy/">Formularz kontaktowy</a>
	</div>
	
	<div class="cybertron-copyrights">
	 &copy; 2018 Cybertron
	</div>
	
</footer>


 <div id="categories-container" class="most-popular-categories">
	 <div class="categories-info">
	   <a class="categories-all" href="/kategorie/wszystkie/">pokaż wszystkie</a>
	 </div>
	 <div class="horizontal-separator"></div>
	 <div class="categories-info">najpopularniejsze</div>
	 <div class="horizontal-separator"></div>
	  
	<ul class="categories-list">
	  
	    <li class="category-list-element">
	      <a href="/kategorie/anal/" class="category-image-all anal">
	        <div class="category-description">anal</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/amatorskie-porno/" class="category-image-all amateur">
	        <div class="category-description">amatorskie</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/azjatki/" class="category-image-all asian">
	        <div class="category-description">azjatki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/blondynki/" class="category-image-all blondes">
	        <div class="category-description">blondynki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/brunetki/" class="category-image-all brunettes">
	        <div class="category-description">brunetki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/bukkake/" class="category-image-all bukkake">
	        <div class="category-description">bukkake</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/czeszki/" class="category-image-all czech">
	        <div class="category-description">czeszki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/duze-cycki/" class="category-image-all big-titts">
	        <div class="category-description">duże cycki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/gangbang/" class="category-image-all gangbang">
	        <div class="category-description">gangbang</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/seks-grupowy/" class="category-image-all group">
	        <div class="category-description">grupowy</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/japonki/" class="category-image-all japanese">
	        <div class="category-description">japonki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/kobieta-solo/" class="category-image-all solo-woman">
	        <div class="category-description">kobieta solo</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/kompilacje-wytryskow/" class="category-image-all cumshot-compilation">
	        <div class="category-description">kompilacje wytrysków</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/latynoski/" class="category-image-all latin">
	        <div class="category-description">latynoski</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/lesbijki/" class="category-image-all lesbians">
	        <div class="category-description">lesbijki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/robienie-loda/" class="category-image-all blowjob">
	        <div class="category-description">lodzik</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/seks-w-miejscach-publicznych/" class="category-image-all public">
	        <div class="category-description">miejsca publiczne</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/milf/" class="category-image-all milf">
	        <div class="category-description">MILF'etki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/murzynki/" class="category-image-all ebony">
	        <div class="category-description">murzynki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/nauczycielki/" class="category-image-all teacher">
	        <div class="category-description">nauczycielki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/nastolatki/" class="category-image-all teens">
	        <div class="category-description">nastolatki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/na-hiszpana/" class="category-image-all tittfuck">
	        <div class="category-description">na hiszpana</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/okularnice/" class="category-image-all glasses">
	        <div class="category-description">okularnice</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/porno-po-polsku/" class="category-image-all polish">
	        <div class="category-description">porno po polsku</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/POV/" class="category-image-all POV">
	        <div class="category-description">POV</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/polykanie-spermy/" class="category-image-all cum-swallow">
	        <div class="category-description">połykanie spermy</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/pielegniarki/" class="category-image-all nurse">
	        <div class="category-description">pielęgniarki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/rajstopki/" class="category-image-all pantyhose">
	        <div class="category-description">rajstopki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/rosjanki/" class="category-image-all russian">
	        <div class="category-description">rosjanki</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/rude/" class="category-image-all redhead">
	        <div class="category-description">rude</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/ukryta-kamera/" class="category-image-all spycam">
	        <div class="category-description">ukryta kamera</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/walenie-konia/" class="category-image-all handjob">
	        <div class="category-description">walenie konia</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/wielki-kutas/" class="category-image-all big-cock">
	        <div class="category-description">wielki kutas</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/wytrysk-na-twarz/" class="category-image-all cum-on-face">
	        <div class="category-description">wytrysk na twarz</div>
	      </a>
	    </li>
		
		<li class="category-list-element">
	      <a href="/kategorie/wytrysk-w-cipke/" class="category-image-all creampie">
	        <div class="category-description">wytrysk w cipke</div>
	      </a>
	    </li>
		
	</ul>		 
  </div>
  
  <div id="video-preview" class="movie-magnifier-container">
    <img id="frame" class="current-frame" src="" alt="klatka z wybranego filmu" />
	<div id="pornstars" class="pornstar-list"> 
	  <img class="star-icon" src="/images/decoration/star.png" />Gwiazdy : <a id="pornstar-0" class="pornstar-name"></a><a id="pornstar-1" class="pornstar-name"></a><a id="pornstar-2" class="pornstar-name"></a>
	</div>
	  <div class="magnifier-progressbar-container">
	     <input id="progressbar" type="range"  class="progressbar-video" min="1" value="1" max="100" step="1"/>
		 <img src="/images/controls/close.png" class="close-movie-magnifier" alt="zamknij podgląd filmu" title="zamknij okno podglądu"/>
	  </div>
  </div>


<div id="cover-canvas" class="dark-canvas"></div>
<div id="magnifier-square" class="pornstar-image-decoration-square"></div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
  <script src="/js/jquery.star-rating-svg.js"></script>
  <script>
  
	function getColor(rate)
	{
	  
	  if(rate <= 6.5)
	  {
		 return "#852D08"; 
	  }
	  
	  if(rate > 6.5 && rate <= 8.5)
	  {
		 return "silver"; 
	  }
	  
	  if(rate > 8.5 )
	  {
		 return "gold"; 
	  }
	}
	
	
  
  function showRatingNumber(currentRating)
  {
	  
	  let color = getColor(currentRating);
	  
	 $("#current-rate").text(currentRating);
	 $("#current-rate").css("color",color);
  }
  
  function hideRating()
  {
	 $("#current-rate").text("");  
  }
  
  function reviewPornstar(currentRating)
  {
	  function ratingAvailable()
	  {
		const cookie = document.cookie;
        
          if(cookie.length === 0)
          {
            return true;
		  }
         
          if(cookie.indexOf("rated") != -1)
		  {
            return false;
		  }	 
          else
          {
            return true;
		  }	  
		  
	  }
	  
	  if(ratingAvailable())
	  {
		            const pornstarName = $("#pornstar-id").text();
					
					$.ajax({
					  url : "/php/ajax/pornstar-rate.php",
					  method : "POST",
					  data : { 
						vote : currentRating,
					    pornstar : pornstarName
						}				
									
					}).done(function(data)
					{
						
						if(data.indexOf("success") != -1)
						{
							 document.cookie = "rated=" + currentRating + "; expires=01 Jan 2025 00:00:00 UTC";
							 $("#user-review-text").text("Twoja ocena : ");
							 let newValue = parseFloat(data.split("|")[1]);
							 $("#users-average-rate-value").text(newValue);
							 $("#users-average-rate-value").css("color",getColor(newValue));
						}
						else
						{
						  $("#user-review-text").text("Błąd przy głosowaniu");	
						}
							
						   
						   						
					}).fail(function()
					{
					  alert("Wystąpił bliżej niezidentyfikowany błąd. Spróbuj za jakiś czas");
					});
		 
		  
	  }
	  else
	  {
		 alert("Nie możesz dwa razy oceniać tej samej suczki"); 
	  }
	    
  }
  
   
   function initiateUsersRating()
   {
	 let rate = $("#rating-stars-readonly").attr("data-rate");
	 rate = (rate === "brak ocen") ? 0 : rate;
	 
	 $("#rating-stars-readonly").starRating({
	 totalStars : 10,
     starSize : 20,
     readOnly : true,
     initialRating : rate,	 
   });
	 	 
   }
   
   function initiateUserRate()
   {
	  let rate = parseFloat($("#user-rating").attr("data-rated"));
	  const editable = (rate === -1) ? false : true; //baw się
      rate = (rate === -1) ? 0 : rate;
	  
	  if(editable)
	  {
		showRatingNumber(rate); 
	  }
	  
	  $("#user-rating").starRating({
	 totalStars : 10,
     starSize : 20, 
	 initialRating : rate,
	 hoverColor : "gold",
     activeColor : "gold",
	 ratedColor : "gold",
	 readOnly : editable,
     onHover : showRatingNumber,
     onLeave : hideRating,
     callback : reviewPornstar	 
   });
      	  
   }
   
   initiateUsersRating();
   initiateUserRate();
   
  </script>
  
  <script src="/js/pornstar-profile.js"></script>
  <script src="/js/cover-page-with-canvas.js"></script>
   <script src="/js/categories.js"></script>
  <script src="/js/resize.js"></script>
  <script src="/js/magnifier.js"></script>
  <script src="/js/image-swap.js"></script>
  
  </body>
 
  