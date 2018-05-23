<?php

 class PagePackage
 {
	public $moviesData;
    public $pageControls;

    function __construct($moviesData,$pageControls)
    {
      $this->moviesData = $moviesData;
	  $this->pageControls = $pageControls;
	}	
 }

?>