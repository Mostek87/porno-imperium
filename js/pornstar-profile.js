
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
   
 function insertButton()
 {
   $("#users-opinions").append('<button type="button" id="show-more-comments" class="more-comments-button">pokaż więcej</button>');
   $("#show-more-comments").click(nextComments);
 } 
   
  function nextComments()
  {
    showLoadingCanvas(false);
	const commentsOffset = $("#users-opinions").attr("data-comments-offset");
    const pornstar = $("#pornstar-id").text();
	
    $.ajax({
		  url : "/php/ajax/get-pornstar-comments.php",
		  method : "POST",
		  data : { 
			pornstarName : pornstar,
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
   
   
	function getFirstComments()
   {
		  const pornstar = $("#pornstar-id").text();
	  
		  $.ajax({
		  url : "/php/ajax/get-pornstar-comments.php",
		  method : "POST",
		  data : { 
			pornstarName : pornstar,
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
		  avatarFileName = (parseInt(comments[i][3]) === 1) ? "anonymous" : nick ;
		  
		  commentCode = '<div class="single-comment"><div class="comment-header"><img class="user-avatar-small" src="/images/users/'+ avatarFileName +'.jpg" /> '+ nick+ ' '+ date +' </div><div class="comment-body">' + comment + '</div></div>';
		  insertionMethod(); 
		}
													
	}
  
    function activateCommentsButton()
	{
      $("#post-a-comment").css("display","none");
      $("#square").css("right","50px");
      $("#leave-comment").css("background","#02052B");
      $("#show-comments").css("background","#660000");
      $("#users-opinions").css("display","block");		 
	}
  
   function showFirstComments()
   {
	    
	   activateCommentsButton();
	   const actions = $("#users-opinions").attr("data-comments-offset");
         
	   if(actions == 0 )
	   {
		  showLoadingCanvas(true);
	     getFirstComments();
	   }
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
   
   
   function showNewComment()
   {
		 activateCommentsButton();
		 $("#users-opinions").empty();
		 const moreButton = document.getElementById("show-more-comments");
		 
			 if(moreButton)
			 {
			   moreButton.remove()
			 }	 
		
		 setTimeout(getFirstComments,800);
   }
   
   function showCommentForm()
   {
	   $("#users-opinions").css("display","none"); 
	   $("#post-a-comment").css("display","block");
	   $("#show-comments").css("background","#02052B");
	   $("#leave-comment").css("background","#660000");
	   $("#square").css("right","190px");  
   }
   
   function insertComment()
   {
	                 
	                const userOpinion = $("#user-opinion").val().trim(); 
                    const nick = $("#nick").val().trim();
				   
				   hideCaptcha();	
				   showLoadingCanvas(true);
				   const pornstarName =  $("#pornstar-id").text();
				   const annonymousUser = $("#users-opinions").attr("data-anonymous-user");
				   
						$.ajax({
					  url : "/php/ajax/insert-pornstar-comment.php",
					  method : "POST",
					  data : { 
						opinion : userOpinion,
						nickname : nick,
					    pornstar : pornstarName,
						annonymous : annonymousUser
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
					
					grecaptcha.reset();
      	   
   }
   
   function initiateInsertion()
   {
	   const userOpinionLength = $("#user-opinion").val().trim().length; 
       const nickLength = $("#nick").val().trim().length;
	   
	   if(nickLength < 21 && nickLength != 0 && userOpinionLength < 1001)
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
  $("#leave-comment").click(showCommentForm);
  $("#post-comment").click(initiateInsertion);
  
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

	