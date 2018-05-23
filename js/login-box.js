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