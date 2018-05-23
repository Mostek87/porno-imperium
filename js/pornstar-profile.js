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
			   }
			   else
			   {
				  alert("Należy podać nick nie dłuższy niż 20 znaków oraz komentarz nie dłuższy niż 1000 znaków");
			   }
      	   
   }
   
  $("#show-comments").click(showFirstComments);  
  $("#leave-comment").click(showCommentForm);
  $("#post-comment").click(insertComment);