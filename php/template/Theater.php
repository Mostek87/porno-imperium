<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="UTF-8"/>
	<title><?php echo $this->data->tittle; ?></title>
	<meta name="description" content="Wyniki wyszukiwania filmów porno wedle precyzyjnych kryteriów">
	<meta name="keywords" content="porno, imperium, wyniki, wyszukiwania>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Cybertron">
	<link rel="stylesheet" href="/css/theater.css">
    <link href="/player/video-js.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/css/star-rating-svg.css">
    <script src="/player/video.js"></script>
  <script>
    videojs.options.flash.swf = "video-js.swf";
  </script>
	<link href='https://fonts.googleapis.com/css?family=Exo+2:400,400italic|Monda' rel='stylesheet' type='text/css'>	
    <link href='http://fonts.googleapis.com/css?family=Baloo+Da|Play|Catamaran|Hind|Lalezar&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  </head>
  
  <body>
  	 
  
<nav class="main_nav">
	<ul id="menu" class="action_list_main">
	
	     <li class="logo-item">
		     <a class="navigation-link" alt="strona główna" href="/"><img class="empire-logo" src="/images/decoration/logo.png" /><img class="empire-logo-small" src="/images/decoration/logo-small.jpg" /></a>
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
 <main class="movie-complete-package">	
 
 <div class="movie-with-controls">
 <div class="movie-container">
 <video autoplay  class="video-js vjs-default-skin video-player" controls preload="none" data-setup="{}">
    <source src="/movies/<?php echo $this->model->movieID; ?>.mp4" type='video/mp4' />
    <p class="vjs-no-js">Aby oglądać film przeglądarka musi mieć włączoną obsługę JavaScriptu</p>
  </video>
  </div>
  
  <div class="movie-controls-and-information">
  <div data-id="<?php echo $this->model->movieID; ?>" id="title" class="movie-title"><?php echo $this->data->tittle; ?></div>
     <ul class="information">
	   <li class="movie-information"><img class="information-decoration-icon" src="/images/decoration/eye.svg"/>wyświetleń : <span class="movie-parameter"><?php echo $this->data->views; ?></span></li>
	   <li class="movie-information"><img class="information-decoration-icon" src="/images/decoration/calendar.svg"/>data dodania : <time datatime="<?php echo $this->data->added; ?>" class="movie-parameter"><?php echo $this->data->added; ?></time></li>
	   <li class="movie-information"><img class="information-decoration-icon" src="/images/decoration/review.svg"/>liczba ocen : <span id="votes-number" class="movie-parameter"><?php echo $this->data->votesNumber; ?></span></li>
	   <li class="movie-information"><img class="information-decoration-icon" src="/images/decoration/review.svg"/>średnia ocen : <span id="average-rate" class="movie-parameter"><?php echo $this->data->averageRate; ?></span></li>
	   <li class="movie-information" title="plemniki są przyznawane przez użytkowników gdy widz tryśnie przy danym filmie "><img class="information-decoration-icon" src="/images/decoration/fertilization.svg"/>plemników : <span id="cumshots-number" class="movie-parameter"><?php echo $this->data->cumshotsNumber; ?></span></li>
	  <?php $this->showPornstars($this->data->pornstars); ?>
	   <li class="movie-information"><a target="_blank" href="/pobierz/<?php echo $this->model->movieID; ?>/<?php echo $this->data->tittle; ?>/"><img title="pobieranie filmu" alt="pobieranie filmu" src="/images/controls/download.png" /></a></li>
	 </ul>
  <div class="movie-controls">
  
    <div class="stars-container container">
	   <div id="user-rate-description" class="control-description"><?php $this->getRateDescription() ?></div>
	   <div data-single-user-rate="<?php echo $this->data->singleUserRate; ?>" class="rating-stars" id="user-rating"></div>
	   <div class="user-grade" id="user-rate"></div>
	</div>
	
	<div class="spermatozoid-control container">
	   <div id="spermatozoid-description" class="control-description"><?php echo $this->data->spermatozoidInfo->description; ?></div><img id="spermatozoid" class="spermatozoid-icon <?php echo $this->data->spermatozoidInfo->cssClassName; ?>" src="/images/decoration/spermatozoid.jpg" />
	</div>
	
	<div class="buttons-container container">
	<div id="triangle" class="square-decoration"></div>
	  <button type="button" id="leave-comment" class="comments-control-button leave-comment-button">Zostaw komentarz</button>
	  <button type="button" id="show-comments" class="comments-control-button show-users-comments-button">Opinie widzów(<?php echo $this->data->commentsNumber; ?>)</button>
   </div>
	
  </div>
  
  <div id="user-action" class="comment-form">
  
   <form id="post-a-comment" class="comment-controls">
	 <img src="/images/users/anonymous.jpg" class="user-avatar" alt="artek" />
	   <div class="controls-group">
	      <label class="label-user-opinion" for="user-opinion">Treść komentarza</label>
	      <textarea id="user-opinion" maxlength="1000" class="user-message" required></textarea>
		  <div class="form-bottom-controls">
	        <label class="nick-label">Twój nick :<input maxlength="20" id="nick" name="user-nick" class="user-nick" type="text" required /></label>
	        <button type="button" id="post-comment" class="submit-comment">Skomentuj</button>
		  </div>
		  
	   </div>
	   
	 </form>
	 
	  <div id="users-opinions" data-number-of-comments="<?php echo $this->data->commentsNumber; ?>" data-comments-offset="0" data-anonymous-user="1" data-more-comments-available="1" class="comments-container"></div>
     <div id="dark-canvas" class="cover-comments-canvas"></div>
	 <img class="ajax-loading-icon" id="ajax-loader" src="/images/decoration/ajax-loader.gif"/>
  </div>
  
  </div>
  </div>
  
  <div class="similar-movies-and-advertisement">
  <div class="similar-movies-info">Podobne filmy</div>
  
   <ul class="similar-movies-list">
   <?php $this->showSimilarMovies(); ?>
   </ul>
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
	        <div class="category-description">czech</div>
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
  
<div id="magnifier-square" class="pornstar-image-decoration-square"></div>
  <div id="pornstar-container" class="pornstar-preview-container">
      <div id="pornstar-name" class="pornstar-name-header">
	  
      </div>
	  <img id="pornstar-image" class="pornstar-photo" src="" />
   </div>
   <div id="cover-canvas" class="dark-canvas"></div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
  <script src="/js/jquery.star-rating-svg.js"></script>
  <script src="/player/mediaelement-and-player.min.js"></script>
  <script src="/js/cover-page-with-canvas.js"></script>
   <script src="/js/categories.js"></script>
  <script src="/js/resize.js"></script>
  <script src="/js/magnifier.js"></script>
  <script src="/js/image-swap.js"></script>
  <script src="/js/theater.js"></script>
  <script>
  
    function insertComments(comments, buttonMethod = false)
	{
		function insertFirst()
		{
			$("#users-opinions").append(commentCode);
		}
		
		function insertBeforeButton()
		{
			$(commentCode).insertBefore("#show-more-comments");
		}
		
		let nick, date, comment, commentCode, fileName;
		const arrayLength = comments.length;
		insertionMethod = (buttonMethod) ?  insertBeforeButton : insertFirst;
		
		for(let i = 1; i < arrayLength ; ++i)
		{
		  nick = comments[i][0];
		  date = comments[i][1];
		  date = '<time datetime="' + date + '" class="comment-date">' + date + "</time>";
		  comment = comments[i][2];
		  
		  commentCode = '<div class="single-comment"><div class="comment-header"><img class="user-avatar-small" src="/images/users/anonymous.jpg" /> '+ nick+ ' '+ date +' </div><div class="comment-body">' + comment + '</div></div>';
		  insertionMethod(); 
		}
		
      showRightTab();  
	}
  
    function getFirstComments()
   {
		  const movieID = $("#title").attr("data-id");
	 
		  $.ajax({
		  url : "/php/ajax/get-movie-comments.php",
		  method : "POST",
		  data : { 
			movieID : movieID,
			offset : 0			
						}  
		}).done(function(data)
		{
			
			 hideLoadingCanvas();
			 const comments = JSON.parse(data);
			 const moreCommentsAvailable = comments[0];
 
		   insertComments(comments);
		   
		    if(moreCommentsAvailable)
			 {
				insertButton()
			 } 
			 else
			 {
				$("#users-opinions").attr("data-more-comments-available","0"); 
			 }
			
			const offset = parseInt($("#users-opinions").attr("data-comments-offset")) + 1;
			$("#users-opinions").attr("data-comments-offset",offset);
			
		}).fail(function()
		{
			alert("Bliżej niezidentyfikowany błąd");
		});

   } 	   
  
    function showNewComment()
   {
		 $("#users-opinions").empty();
		 const moreButton = document.getElementById("show-more-comments");
		 
			 if(moreButton)
			 {
			   moreButton.remove()
			 }	 
		
		 setTimeout(getFirstComments,800);
   }
  
    function showLoadingCanvas(useParent)
   {
	 let height, top;
	 
	 if(useParent)
	 {
        height = $("#user-action").height() + "px";
		top = "50%";
	 } 
	 else
	 {
		height = $("#users-opinions").height() + 50; 
		top = height - ($("#user-action").height() / 2) + "px";
		height += "px";
	 }
	 
	 $("#dark-canvas").css({"display" : "block", "height" : height});
     $("#ajax-loader").css({"display" : "block", "top" : top});
     	 
   }
   
   function hideLoadingCanvas()
   {
	 $("#dark-canvas").css("display", "none");
     $("#ajax-loader").css("display","none");	 
   }
  
   
  
   function insertComment()
   {
	   function dataIsValid()
       {
          const userOpinionLength = userOpinion.length;
		  const nickLength = nick.length;
		  
		  return (nickLength > 0 ) && (userOpinionLength > 0) && (nickLength < 21) && (userOpinionLength < 1001)
	   }
	   
	   

    const userOpinion = $("#user-opinion").val().trim(); 
    const nick = $("#nick").val().trim();	
	

			   if(dataIsValid())
			   {
				   showLoadingCanvas(true);
				   const movieID = $("#title").attr("data-id");
				   
						$.ajax({
					  url : "/php/ajax/insert-movie-comment.php",
					  method : "POST",
					  data : { 
						opinion : userOpinion,
						nickname : nick,
					    movieID : movieID
						}				
									
					}).done(function(data)
					{
						switch(data)
                        {
                           case "success":
						     showNewComment();
							 $("#post-a-comment").trigger('reset');
							 const commentsNumber = parseInt($("#users-opinions").attr("data-number-of-comments")) + 1;
							 $("#users-opinions").attr("data-number-of-comments", commentsNumber); 
							 $("#show-comments").text("Opinie widzów(" + commentsNumber + ")");
						   break;
						   
						   case "error_cannot_insert":
						    alert("Nie udało się dodać komentarza, spróbuj ponownie");
						   break;
						}						
						
					}).fail(function()
					{
					  alert("Wystąpił bliżej niezidentyfikowany błąd. Spróbuj za jakiś czas");
					});
			   }
			   else
			   {
				  alert("Należy podać nick nie dłuższy niż 20 znaków oraz komentarz nie dłuższy niż 1000 znaków");
			   }
      	   
   }
   
   $("#leave-comment").click(function()
  {
     $("#triangle").css("left", "25%");
	 $("#leave-comment").css("background", "#660000");
	 $("#show-comments").css("background", "#02052b");
	 $("#post-a-comment").css("display","block");
	 $("#users-opinions").css("display","none");
  }); 
  
  function showRightTab()
  {
	$("#triangle").css("left", "75%");
	 $("#leave-comment").css("background", "#02052b");
	 $("#show-comments").css("background", "#660000");
	 $("#post-a-comment").css("display","none");  
	 $("#users-opinions").css("display","block");
  }
  
   function insertButton()
 {
   $("#users-opinions").append('<button type="button" id="show-more-comments" class="more-comments-button">pokaż więcej</button>');
   $("#show-more-comments").click(nextComments);
 } 
  
  function showFirstComments()
   {
	    
	   showRightTab();
	   const actions = $("#users-opinions").attr("data-comments-offset");
         
	   if(actions == 0 )
	   {
		  showLoadingCanvas(true);
	     getFirstComments();
	   }
   }
   
    function nextComments()
  {
    showLoadingCanvas(false);
	const commentsOffset = $("#users-opinions").attr("data-comments-offset");
    const movieID = $("#title").attr("data-id");
	
    $.ajax({
		  url : "/php/ajax/get-movie-comments.php",
		  method : "POST",
		  data : { 
			movieID : movieID,
			offset : commentsOffset			
						}  
		}).done(function(data)
		{
			 hideLoadingCanvas();
			 const comments = JSON.parse(data);
			 const moreCommentsAvailable = comments[0];
				 
		   insertComments(comments,true);
		   
		     if(!moreCommentsAvailable)
			 {
				$("#users-opinions").attr("data-more-comments-available","0"); 
				$("#show-more-comments").remove();
			 } 

			
			const offset = parseInt($("#users-opinions").attr("data-comments-offset")) + 1;
			$("#users-opinions").attr("data-comments-offset",offset);
			
		}).fail(function()
		{
             alert("Wystąpił bliżej niezidentyfikowany błąd. Spróbuj za jakiś czas");
		});		
  }  

  $("#show-comments").click(showFirstComments);

 $("#post-comment").click(insertComment);
   
  
  </script>
  </body>
 
  