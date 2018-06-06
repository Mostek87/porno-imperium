  
	 function CoverPageWithCanvas()
     {
		 let DocumentHeight = $(document).height() + "px";
         $("#cover-canvas").css({"display":"block", "height": DocumentHeight});
     }
	 
	       function calculateCategoriesContainerDimensions()
	 {
		 var containerWidthNoCorrection = 0.9 * window.innerWidth;
		 var properContainerWidth = containerWidthNoCorrection - (containerWidthNoCorrection % 108);
		 var leftOffset = (window.innerWidth - properContainerWidth) / 2 + "px";
		 var containerHeight = Math.ceil(34 / (properContainerWidth /110)) * 110 + 72 + "px"
		 properContainerWidth += "px";
		
		
		return{
			width : properContainerWidth,
			left : leftOffset,
			height : containerHeight
		};
	 }
	 
	 togleCategories.inProgress = false;
	 
    function togleCategories(event)
	{
       var activateButton = event.target;
		  var state = activateButton.textContent;
		  var dimensions = calculateCategoriesContainerDimensions();
		  var topPosition = 44 + pageYOffset + "px";
		 
		 if(togleCategories.inProgress == false) 
		 {
			 togleCategories.inProgress = true;
			 
			if(state === "kategorie")
		    {
			   $("#categories-container").css({"display" : "block", "top" : topPosition, "width" : dimensions.width, "left" : dimensions.left});
			   $("#categories-container").animate({height: dimensions.height},1000,function()
			   {
				togleCategories.inProgress = false;
				activateButton.textContent = "ukryj kat.";	   
			   });
			   
		    }
		    else
		    {
			   $("#categories-container").animate({height:0},1000,function(){
				   $("#categories-container").css("display","none");
				   activateButton.textContent = "kategorie";
				   togleCategories.inProgress = false;
				   });
			    
		    } 
		 }
		    
	}	
	

	$("#show-categories").click(togleCategories);
	
	$(window).resize(function(){
	  
	  var categoriesButtonLabel = document.getElementById("show-categories").textContent;
	  
	      if(categoriesButtonLabel === "ukryj kat.")
		  {
			var dimensions = calculateCategoriesContainerDimensions();
           	$("#categories-container").css({"width" : dimensions.width, "left" : dimensions.left, "height" : dimensions.height});
            return;			
		  }
		 
		  if($("#login-panel").css("display") == "block")
		  {
			ShowLoginBox();
			return;
		  }
		  
		  if($("#video-preview").css("display") == "block")
		  {
			 const LeftOffset = ($("body").width() - 404) / 2;
			 $("#video-preview").css("left",LeftOffset);
		  }
	 
	 });
	 
	     $(".magnifier-icon").click(function(event)
	 {
		 
	   CoverPageWithCanvas();
	   let Sender = event.target;
	   let LeftOffset = (($("body").width() - 404) / 2) + "px";
	   let VideoID = Sender.getAttribute("data-id");
	   let Pornstars = Sender.getAttribute("data-stars");
	   let pornstarURL;
	   let i;
	   
	   for(let i = 0; i < 3; ++i)
	   {
		  $("#pornstar-" + i).text(""); 
	   }
	    
	   if(typeof Pornstars === "string")
	   {
		   
		  if(Pornstars.indexOf(',') != -1)
		  {
			  let PornstarsArray = Pornstars.split(",");
		      let arrLength = PornstarsArray.length;
			  
			  for(i = 0; i < arrLength ; ++i)
			  {
				$("#pornstar-" + i).text(PornstarsArray[i]);
				pornstarURL = "/gwiazdy/" + PornstarsArray[i].toLowerCase().replace(/ /g,"-") + "/";
                $("#pornstar-" + i).attr("href", pornstarURL); 				
			  }
		  }
		  else
		  {
			$("#pornstar-0").text(Pornstars); 
			pornstarURL = "/gwiazdy/" + Pornstars.toLowerCase().replace(/ /g,"-") + "/";
            $("#pornstar-0").attr("href", pornstarURL); 
		  }
		 
		
		 
		 $("#pornstars").css("display","block");
	   }
	   else
	   {
		 $("#pornstars").css("display","none"); 
         $(".pornstar-name").text("");		 
	   }
	   
	   document.getElementById("frame").src = "/images/movie/magnifier/" + VideoID + "/" + VideoID + " " + "001" + ".jpg";
	   $("#progressbar").attr("data-id",VideoID);
	   $("#progressbar").val(1);
	   $("#video-preview").css({"left" : LeftOffset, "display" : "block" });
	   
       	   
	 });
	 
	 $(".close-movie-magnifier").click(function()
	 {
        
		$("#cover-canvas").css("display","none"); 
        $("#video-preview").css("display","none");
         cleanMagnifierTools();		
	 });
	 
	 
	 
	 document.getElementById("progressbar").addEventListener("input",function(event)
	 {
		     function CreateVaildFileName(number)
		     {
				 number = Number(number);
				 
                if(number < 10)
			    {
				  return "00" + number + ".jpg";  
			    }
			    else if( (number > 9)&&(number < 100))
			    {
				  return "0" + number + ".jpg";
			    }
				
				return number + ".jpg";
		   }
           let Progressbar = event.target;		   
           let MovieID = Progressbar.getAttribute("data-id");		   
		   let CurrentFrame = Progressbar.value;
		   let FilePath = "/images/movie/magnifier/" + MovieID + "/" + MovieID + " " + CreateVaildFileName(CurrentFrame);
		  document.getElementById("frame").src = FilePath;
	 });
	 
	 function cleanMagnifierTools()
	 {
		 $("#pornstar-container").css("display","none");
		 $("#magnifier-square").css("display","none");
	 }
	 
	 $(".pornstar-name").mouseenter(function(event)
	 {
		const Pornstar = event.target.textContent;
		$("#pornstar-name").text(Pornstar);
		const FileName = Pornstar.replace(/ /g,"_");
		const FilePath = "/images/pornstars/magnifier/" + FileName + ".jpg";
		$("#pornstar-image").attr("src",FilePath);
		const position = event.target.getBoundingClientRect();
       console.log(position.bottom);
		const containerTop = position.bottom - 295   + "px";
		const containerLeft = position.left - 35  + "px";
		const squareLeft = position.left + 30  + "px";
		const squareTop = position.bottom - 67 + "px";
		
		
		$("#pornstar-container").css({"display" : "block", "top" : containerTop, "left" : containerLeft});
		$("#magnifier-square").css({"display" : "block", "top" : squareTop, "left" : squareLeft});
	 });
	 
	 $(".pornstar-name").mouseleave(cleanMagnifierTools);
	 
	 


$(".image-and-duration").mouseenter(function()
{
   let id = $(this).attr("data-id");
   $("#progressbar-" + id).css("display","block");
 
   let gif = new Image();
   gif.onload = function()
   {
	   $("#progressbar-" + id).css("display","none");
   };
   
   gif.src = "/images/movie/gif/" + id + ".gif";
   document.getElementById("movie-image-" + id).setAttribute("src", gif.src);  
});

$(".image-and-duration").mouseleave(function(event)
{
  
   let id = $(this).attr("data-id");
   $("#progressbar-" + id).css("display","none");
   document.getElementById("movie-image-" + id).setAttribute("src", "/images/movie/main/" + id + ".jpg");
});

 
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
	
	function setCumshotCookie()
	{
	  const dateNow = new Date();
	  const expireDate = new Date(dateNow.getTime() + 3600000);
	  
	  document.cookie = "cumshot=true; expires=" + expireDate + ";";
      	  
	}
	
	function showRatingNumber(currentRating)
  {
	  let color = getColor(currentRating);
	  
	 $("#user-rate").text(currentRating);
	 $("#user-rate").css("color",color);
  }
  
  function hideRating()
  {
	  $("#user-rate").text("");
  }
  
   function reviewMovie(currentRating)
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
		            
					const movieID = $("#title").attr("data-id");
					
					$.ajax({
					  url : "/php/ajax/movie-rate.php",
					  method : "POST",
					  data : { 
						vote : currentRating,
					    movieID : movieID
						}				
									
					}).done(function(data)
					{
						
						if(data.indexOf("success") != -1)
						{
							 document.cookie = "rated=" + currentRating + "; expires=01 Jan 2025 00:00:00 UTC;";
							 $("#user-rate-description").text("Twoja ocena ");
							 const newValues = data.split("|");
							 const newAverageRate = parseFloat(newValues[1]);
							 const newVotesNumber = newValues[2];
							 $("#average-rate").text(newAverageRate);
							 $("#votes-number").text(newVotesNumber);
							
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
		 alert("Nie możesz dwa razy oceniać tego samego filmu"); 
	  }
	    
  }
  
   
   function initiateUserRate()
   {
	   function showRatingNumber(currentRating)
      {
	     let color = getColor(currentRating);
	    $("#user-rate").text(currentRating);
	    $("#user-rate").css("color",color);
      }
	   
	  let rate = parseFloat($("#user-rating").attr("data-single-user-rate"));
	  const editable = (rate === -1) ? false : true; 
	  rate = (rate === -1) ? 0 : rate;
	  
	  if(editable)
	  {
		 showRatingNumber(rate);
	  }
	  
	  $("#user-rating").starRating({
		 totalStars : 10,
		 starSize : 22, 
		 initialRating : rate,
		 hoverColor : "gold",
		 activeColor : "gold",
		 ratedColor : "gold",
		 readOnly : editable,
		 onHover : showRatingNumber,
		 onLeave : hideRating,
		 callback : reviewMovie 
     });
   
   }
   
   initiateUserRate();
   
   function giveSpermatozoid()
  {
	  function ratingAvailable()
	  {
		const cookie = document.cookie;
        
          if(cookie.length === 0)
          {
            return true;
		  }
         
          if(cookie.indexOf("cumshot") != -1)
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
		            
					const movieID = $("#title").attr("data-id");
					
					$.ajax({
					  url : "/php/ajax/give-spermatozoid.php",
					  method : "POST",
					  data : { 
					    movieID : movieID
						}				
									
					}).done(function(data)
					{
						
						if(data.indexOf("success") != -1)
						{
							setCumshotCookie();
							 $("#spermatozoid-description").text("Niedawno prysnąłeś ");
							 const cumshotsNumber = data.split("|")[1];
							 $("#cumshots-number").text(cumshotsNumber);
							 document.getElementById("spermatozoid").style.filter = "brightness(140%)";
						}
						else
						{
						  alert(data);	
						}
							
						   
						   						
					}).fail(function()
					{
					  alert("Wystąpił bliżej niezidentyfikowany błąd. Spróbuj za jakiś czas");
					});
		 
		  
	  }
	  else
	  {
		 alert("Możesz dać jednego plemnika na godzinę na jeden film"); 
	  }
	    
  }
  
  $("#spermatozoid").click(giveSpermatozoid); 
  
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
	   
                   const userOpinion = $("#user-opinion").val().trim(); 
                   const nick = $("#nick").val().trim();	
	               hideCaptcha();
				   showLoadingCanvas(true);
				   grecaptcha.reset();
				   
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

    function initiateInsertion()
   {
	   const userOpinionLength = $("#user-opinion").val().trim().length; 
       const nickLength = $("#nick").val().trim().length;
	   
	   
     
	   if(nickLength < 21 && userOpinionLength < 1001)
	   {  
		 $("#anti-spam-tool").css("display","block");
	   }
	   else
	   {
		 alert("Należy podać nick nie dłuższy niż 20 znaków oraz komentarz nie dłuższy niż 1000 znaków"); 
	   }
	      
   }
   
   function hideCaptcha()
   {
	 $("#anti-spam-tool").css("display","none");   
   }  

  $("#show-comments").click(showFirstComments);
  $("#post-comment").click(initiateInsertion);
	
  