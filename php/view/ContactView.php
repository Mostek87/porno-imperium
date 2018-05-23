<?php

class ContactView
{
	function __construct($model)
	{
		$this->model = $model;
	}
	
	function render()
	{
		if(file_exists("php/template/Contact.php"))
		{
		  require("php/template/Contact.php");
		}
		else
		{
			die("Błąd, brak wymaganego pliku");
		}
	}
}

?>