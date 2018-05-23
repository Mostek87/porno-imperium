


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
