<?php

class SearchControler extends Controler
{
	
  function __construct($model)
  {
    $this->model = $model;
  } 
  
  function initiate($parameters)
  {
	  
	 if($parameters === null)
	 {
		$this->model->action = "Panel";		
	 }
	 else if($parameters[0] === "wyniki")
	 { 
	   $this->model->action = "Results";
	   $arrayLength = count($parameters);
	   session_start();
	   
	   switch($arrayLength)
	   {
		 case 3:
			  if(is_numeric($parameters[2]))
			  {
				$this->model->pageNumber = Intval($parameters[2]);
			  }
			  else
			  {
				die("nieprawidłowy numer strony");
			  }	  
         break;

         case 1:
           $this->model->pageNumber = 1;
		   
           if(isset($_SESSION['query']))
		   {
			 unset($_SESSION['query']);  
		   }

           if(isset($_SESSION['descriptions']))
		   {
			 unset($_SESSION['descriptions']);  
		   }  		   
         break;

         default:
          die("nieprawidłowy adres url"); 
         break;		 
	   }
	      
  }
  else
 {
	die("nieprawidłowy adres url"); 
 }
  
}

}

?>