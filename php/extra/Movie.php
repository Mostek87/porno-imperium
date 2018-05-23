<?php

class Movie
 {
	public $tittle;
	public $stars;
	public $views;
	public $seconds;
	public $minutes;
	public $hours;
	public $id;
   
    function __construct($tittle,$stars,$views,$seconds, $minutes, $hours, $polishTranslation, $id=null)
    {
      $this->tittle = $tittle;
	  $this->stars = $stars;
	  $this->views = $views;
	  $this->seconds = $seconds;
	  $this->minutes = $minutes;
	  $this->hours = $hours;
	  $this->polishTranslation = $polishTranslation;
	  $this->id = $id;
	}	
 }
 
 ?>