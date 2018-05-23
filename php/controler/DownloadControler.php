<?php

class DownloadControler extends Controler
{

  function initiate($parameter)
  {
	  $parametersNumber = count($parameter);
	  
     if(is_array($parameter) && $parametersNumber === 2 && is_numeric($parameter[0]))
     {
        $this->model->id = $parameter[0];
		$this->model->tittle = $parameter[1];
	 } 
	 else
	 {
		die("nieprawidłowy adres url"); 
	 }
  }

  function __construct($model)
  {
    $this->model = $model;
  } 
  
}

?>