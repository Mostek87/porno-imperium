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
  
  