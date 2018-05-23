<?php

class WatchControler extends Controler
{
  function __construct($model)
  {
    $this->model = $model;
  }

  function initiate($parameters)
  {
     if(is_array($parameters))
	 {
        $arrLength = count($parameters);
		
		if(($arrLength === 2) && (is_numeric($parameters[1])))
		{
		  $this->model->movieID = $parameters[1];
		}
		else
		{
		  die("nieprawidłowy adres url");	
		}
	 }
     else
	 {
       die("nieprawidłowy adres url");
	 } 
  }  
}

?>