$(function()
{
function createURL(number)
{
	function clearURL(URL)
	{
		const hashPosition = URL.indexOf("#");
		
		if(hashPosition < 0)
		{
		  return URL;	
		}
		
		return URL.slice(0, hashPosition)
	}
	
	var currentURL = clearURL(window.location.href);
	var strPosition = currentURL.indexOf("/strona/");
	
	if(strPosition != -1)
	{
		return currentURL.substring(0,strPosition) + "/strona/" + number + "/";
	}
	else
	{
		return currentURL + "strona/" + number + "/";
	}
}

$("#previous-page").click(function()
	 {
	   let NumberLeft = Number($("#PageControl-0").text());
	   
	   if(NumberLeft === 1)
	   {
		 return;  
	   }
	   else
	   {
		  let FirstNumber = (NumberLeft - 5 > 0) ? NumberLeft - 5 : 1;
		  let ID;
		  let ActivePage = Number($("#bottom-controls").attr("data-active-page"));
		  $('.page-selection').removeClass("active");
          
          for(let I = 0; I < 5; ++I)
          {
			ID = "#PageControl-" + I;
            $(ID).text(FirstNumber);
			$(ID).attr("href",createURL(FirstNumber)); 
			
			   if(ActivePage === FirstNumber)
			   {
				$(ID).addClass("active");
			   }
			   
			
			++FirstNumber;
		  }	  
	   }

	 });
	 
	$("#next-page").click(function()
    {
      
	  let LastPage = Number($("#bottom-controls").attr("data-last-page"));
	  let NumberLeft = Number($("#PageControl-0").text())
	
      if(NumberLeft + 5 <= LastPage)
      {
        $('.page-selection').removeClass("active");
		let ActivePage = Number($("#bottom-controls").attr("data-active-page"));
		let ID;
		NumberLeft = (NumberLeft + 10 <= LastPage) ? NumberLeft + 5 : LastPage - 4;
		
		  for(let I = 0; I < 5; ++I)
		  {
		     ID = "#PageControl-" + I;
             $(ID).text(NumberLeft);
		     $(ID).attr("href",createURL(NumberLeft)); 
			
			     if(ActivePage === NumberLeft)
			     {
				  $(ID).addClass("active");
			     }
			   
			
			  ++NumberLeft;		 
		 }
		
	  }
      else
      {
        return;
	  }  
	  
	});	
	
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
});
