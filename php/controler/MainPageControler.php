<?php

class MainPageControler extends Controler 
{
	function __construct($model)
	{
	  $this->model = $model;	
	}
	
	function initiate($parameters)
	{
	  $pageNumber = (empty($parameters)) ? 1 : $parameters[0];
      $this->model->currentPage = Intval($pageNumber);	  
	}
}

?>