<?php
  class Pornstar
  {
	public $nickName;
	public $birthData;
    public $trueName;
    public $nationality;
    public $activeYears;
    public $officialWebsite;
    public $descriptionBeginning;
    public $descriptionEnd;
    public $averageRate;
	public $tittsType;
	public $commentsNumber;
	public $rated;

    function __construct($nickName, $birthData, $trueName, $nationality, $activeYears, $officialWebsite, $descriptionBeginning, $descriptionEnd, $votesNumber, $votesSummary, $tittsType, $commentsNumber, $rated)
	{
      $this->nickName = $nickName;
	  $this->birthData = $birthData;
	  $this->trueName = $trueName;
	  $this->nationality = $nationality;
	  $this->activeYears = $activeYears;
	  $this->officialWebsite = $officialWebsite;
	  $this->descriptionBeginning = $descriptionBeginning;
	  $this->descriptionEnd = $descriptionEnd;
	  $this->commentsNumber = $commentsNumber;
	  $this->tittsType = $tittsType;
	  $this->rated = $rated;
	  $this->averageRate = ($votesNumber > 0) ? round($votesSummary / $votesNumber,1) : "brak ocen";
	  
	}	
  }
?>