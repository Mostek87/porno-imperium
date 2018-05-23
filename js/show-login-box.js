$("#login-panel-activate").click(function()
	{
	   const LeftOffset = (window.innerWidth - $("#login-panel").width()) / 2;
       const TopOffset = (window.innerHeight - 230) / 2 + pageYOffset;
       CoverPageWithCanvas();
   
       $("#login-panel").css({"top" : TopOffset, "left" : LeftOffset, "display" : "block"});
       $("#login-panel").fadeTo(1700,1);	   
	})
	
	$("#close-dialog").click(function()
	{
	  $("#login-panel").css({"display" : "none", "opacity" : 0});
      $("#cover-canvas").css("display","none");	  
	});