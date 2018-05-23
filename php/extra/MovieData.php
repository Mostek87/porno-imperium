<?php

class MovieData
{
  public $votesNumber;
  public $averageRate;
  public $votesSummary;
  public $tittle;
  public $added;
  public $similarMovies;
  public $views;
  public $cumshotsNumber;
  public $pornstars;
  public $singleUserRate;
  public $spermatozoidInfo;
  public $commentsNumber;

 function __construct($votesNumber, $votesSummary, $tittle, $similarMovies, $added, $views, $cumshotsNumber, $pornstars, $singleUserRate, $spermatozoidInfo, $commentsNumber)
 {
   $this->votesNumber = $votesNumber;
   $this->averageRate = ($votesNumber > 0) ? round($votesSummary / $votesNumber,1) : 0;
   $this->tittle = $tittle;
   $this->similarMovies = $similarMovies;
   $this->added = $added;
   $this->views = $views;
   $this->cumshotsNumber = $cumshotsNumber;
   $this->pornstars = $pornstars;
   $this->singleUserRate = $singleUserRate;
   $this->spermatozoidInfo = $spermatozoidInfo;
   $this->commentsNumber = $commentsNumber;
 }
 
}

?>