$(document).ready(function()
{
     function CoverPageWithCanvas()
     {
		 let DocumentHeight = $(document).height() + "px";
         $("#cover-canvas").css({"display":"block", "height": DocumentHeight});
     }

	 
	 $(".magnifier-icon").click(function(event)
	 {
	   
	   CoverPageWithCanvas();
	   let Sender = event.target;
	   let LeftOffset = (($("body").width() - 404) / 2) + "px";
	   let VideoID = Sender.getAttribute("data-id");
	   let Pornstars = Sender.getAttribute("data-stars");
	   
	   if(typeof Pornstars === "string")
	   {
		  if(Pornstars.indexOf(',') != -1)
		  {
			  let PornstarsArray = Pornstars.split(",");
		 
		      for(let index of PornstarsArray)
		     {
			 
			    $("#pornstar-"+index).text(PornstarsArray[index]);
		     }
		  }
		  else
		  {
			$("#pornstar-0").text(Pornstars); 
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
	 
	 $(".pornstar-name").mouseover(function(event)
	 {
		let Pornstar = event.target.textContent;
		$("#pornstar-name").text(Pornstar);
		let FileName = Pornstar.replace(" ","_");
		let FilePath = "/images/pornstars/magnifier/" + FileName + ".jpg";
		$("#pornstar-image").attr("src",FilePath);
		let Bottom = event.clientY - 35 + "px";
		let Left = event.clientX - 65 +"px";
		$("#pornstar-container").css({"display" : "block", "bottom" : Bottom, "left" : Left});
	 });
	 
	 $(".pornstar-name").mouseleave(function()
	 {
		 $("#pornstar-container").css("display","none");
	 });
	 
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
	 
	 
	 
	 $("#show-categories").click(function(event)
	 {
		  var activateButton = event.target;
		  var state = activateButton.textContent;
		  var dimensions = calculateCategoriesContainerDimensions();
		  var topPosition = 44 + pageYOffset + "px";
		 
		   if(state === "kategorie")
		   {
			  $("#categories-container").css({"display" : "block", "top" : topPosition, "width" : dimensions.width, "left" : dimensions.left});
			  $("#categories-container").animate({height: dimensions.height},1000);
			  activateButton.textContent = "ukryj kat.";
		   }
		   else
		   {
			  $("#categories-container").animate({height:0},1000,function(){$("#categories-container").css("display","none");});
			  activateButton.textContent = "kategorie"; 
		   }
	 });
	 
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
			$(ID).attr("href","/strona/" + FirstNumber + "/"); 
			
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
	
      if(NumberLeft + 5 < LastPage)
      {
        $('.page-selection').removeClass("active");
		let ActivePage = Number($("#bottom-controls").attr("data-active-page"));
		let ID;
		NumberLeft = (NumberLeft + 10 <= LastPage) ? NumberLeft + 5 : LastPage - 4;
		
		  for(let I = 0; I < 5; ++I)
		  {
		     ID = "#PageControl-" + I;
             $(ID).text(NumberLeft);
		     $(ID).attr("href","/strona/" + NumberLeft + "/"); 
			
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
		alert("japa");
	  }  
	  
	});	
	
	  function ShowLoginBox()
	 {
		const WindowWidth = $("body").width();
		const ContainerWidth = (WindowWidth > 400) ? 350 : 270;
		const LeftOffset = (WindowWidth - ContainerWidth) / 2;
        const TopOffset = (window.innerHeight - 230) / 2 ; 
		$("#login-panel").css({"top" : TopOffset, "left" : LeftOffset, "width" : ContainerWidth, "display" : "block"});
	 }
	
	$("#login-panel-activate").click(function()
	{
       CoverPageWithCanvas();
       ShowLoginBox();
       $("#login-panel").fadeTo(1600,1);	   
	})
	
	$("#close-dialog").click(function()
	{
	  $("#login-panel").css({"display" : "none", "opacity" : 0});
      $("#cover-canvas").css("display","none");	  
	});
	 
	 
     


});