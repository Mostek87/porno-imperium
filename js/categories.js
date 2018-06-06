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
	