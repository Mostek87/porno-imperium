<?php

class PornstarsControler
{
  	
  function __construct($model)
  {
    $this->model = $model;
  } 
  
  function initiate($parameters)
  {
	 if(array_key_exists(0,$parameters))
	 {
		$this->model->pornstar = $parameters[0];
        $this->model->parsedPornstarName = ucwords(str_replace("-"," ", $parameters[0]));		
	 }
	 else
	 {
		die('nieprawidłowy adres URL'); 
	 }
  }
}

?>