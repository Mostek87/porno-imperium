$(function()
{
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
	 
	 function togleCategoriesMenu(event)
	 {
		
		var activateButton = event.target;
		var state = activateButton.textContent;
		var dimensions = calculateCategoriesContainerDimensions();
		
		   if(state === "kategorie" && togleCategoriesMenu.inProgress == false)
		   {
			  togleCategoriesMenu.inProgress = true;
			  $("#categories-container").css({"display" : "block", "top" : "44px", "width" : dimensions.width, "left" : dimensions.left});
			  $("#categories-container").animate({height: dimensions.height},1000, 
			  function()
			  {
				  togleCategoriesMenu.inProgress = false; 
				  activateButton.textContent = "ukryj kat.";});
		   }
		   else if(togleCategoriesMenu.inProgress == false)
		   {
			  togleCategoriesMenu.inProgress = true; 
			  $("#categories-container").animate({height:0},1000,
			  function(){
				  $("#categories-container").css("display","none"); 
				  togleCategoriesMenu.inProgress = false;
				  activateButton.textContent = "kategorie";
				  });
			  
		   } 
	 }
	 
	 $("#show-categories").click(togleCategoriesMenu);
	 
	 $(window).resize(function(){
	  
	  var categoriesButtonLabel = document.getElementById("show-categories").textContent;
	  
	      if(categoriesButtonLabel === "ukryj kat.")
		  {
			var dimensions = calculateCategoriesContainerDimensions();
           	$("#categories-container").css({"width" : dimensions.width, "left" : dimensions.left, "height" : dimensions.height});		
		  }
	 
	 });	

	
});