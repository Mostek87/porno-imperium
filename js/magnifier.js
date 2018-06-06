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