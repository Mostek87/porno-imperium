<?php

class DownloadView extends View
{
	 function __construct($model)
     {
       $this->model = $model;
     } 
	
	function render()
	{
	  $this->model->download();	
	}
}

?>