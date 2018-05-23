<?php

class CategoriesControler extends Controler
{
  function __construct($model)
  {
    $this->model = $model;
  } 

  function initiate($parameters)
  {
    $categoryName = $parameters[0];
	$pageNumber = (array_key_exists(2,$parameters)) ? $parameters[2] : 1;
	$this->model->categoryName = $categoryName;
	$this->model->pageNumber = Intval($pageNumber);
	 
  }  
}

?>