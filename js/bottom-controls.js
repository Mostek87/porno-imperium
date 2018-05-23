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