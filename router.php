<?php

 function autoloadClass($className) 
{
  if(file_exists("php/model/$className.php"))
  {
	require "php/model/$className.php";
  }
  else if(file_exists("php/view/$className.php"))
  {
	require "php/view/$className.php";  
  }
  else if(file_exists("php/controler/$className.php"))
  {
	 require "php/controler/$className.php"; 
  }
  else if(file_exists("php/extra/$className.php"))
  {
	 require "php/extra/$className.php";   
  }
}

   spl_autoload_register('autoloadClass');
 
class Router
{
  public $parameters = null;
  public $modelName;
  public $viewName;
  public $controlerName;
  
  private function getClassName(&$action)
  {
	  
	  $classes = array(
      "kategorie"	=> "Categories",
	  "formularz-kontaktowy" => "Contact",
	  "gwiazdy" => "Pornstars",
	  "wyszukiwanie" => "Search",
	  "film" => "Watch",
	  "pobierz" => "Download",
	  "raport-wysylania-wiadomosci" => "SendMessage"
	  );
	  
	  if(array_key_exists($action,$classes))
	  {
		 return $classes[$action];
	  }
	  else
	  {
		 die("nieprawidłowy adres url"); 
	  }
	    
      
	
  }
  
  function __construct()
  {
	    $arr = explode("/",$_SERVER['REQUEST_URI']);      
		$userAction = $arr[1];
		$userAction = ($userAction === "" || $userAction === "strona") ? "MainPage" : $this->getClassName($userAction); 
		
		$arrLength = count($arr);

		$this->modelName = $userAction."Model";
		$this->viewName = $userAction."View";
		$this->controlerName = $userAction."Controler";
		
		if($arrLength > 3)
		{
		    $this->parameters = array(); 
  		
			for($i = 2; $i < $arrLength - 1; ++$i)
            {
              array_push($this->parameters, $arr[$i]);  
			}		
				
		} 
  }
    
}

$router = new Router;
$model = new $router->modelName();
$controler = new $router->controlerName($model);
$controler->initiate($router->parameters);
$view = new $router->viewName($model);
$view->render();


?>