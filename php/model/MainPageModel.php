<?php

class MainPageModel
{
	public $currentPage;
  
    private function createQuery()  
   {
	  $pageNumber = $this->currentPage - 1;
		
	  if($pageNumber == 0)
	  {
		return "SELECT * FROM Pornusy ORDER BY klucz DESC LIMIT 50";   
	  }
	  else
	  {
		$offset = $pageNumber * 50;
        return "SELECT * FROM Pornusy ORDER BY klucz DESC LIMIT 50 OFFSET $offset";		
	  }
	    
	}
	
	private function getRandomImages()
	{
	    $id1 = rand(1,20);   
        $id2 = rand(1,20);

        while($id1 === $id2)
	   {
	     $id1 = rand(1,20);
         $id2 = rand(1,20);	
	    }
	
	   $this->randomImage1 = "decoration-image-".$id1;
	   $this->randomImage2 = "decoration-image-".$id2;	
	}
	
	private function calculatePageControls(&$total)   
	{
	  $maxPageIndex = ceil($total / 50);
	  $pageNumber = &$this->currentPage;
	  $pageControls = new PageControls();
	  
      if($maxPageIndex - 5 >= $pageNumber)
      {
        $pageControls->pageControlIndex1 = $pageNumber;
		$pageControls->activePagePosition = 1;
	  }
      else
	  {
        $pageControls->pageControlIndex1 = $maxPageIndex - 4;
		$pageControls->activePagePosition = 5 + $pageNumber - $maxPageIndex;
	  }
	  
	  
	  $pageControls->previousPageNumber = ($pageNumber > 1) ? $pageNumber - 1 : null;
	  $pageControls->nextPageNumber = ($pageNumber < $maxPageIndex) ? $pageNumber + 1 : null;
      $pageControls->topIndex = ++$total - ($pageNumber - 1) * 50; 
      $pageControls->maxPageIndex = $maxPageIndex;
	  
	  
	  $id1 = rand(1,20);   //wybieram dwa losowo wybrane zdjęcia
      $id2 = rand(1,20);

        while($id1 === $id2)
	   {
	     $id1 = rand(1,20);
         $id2 = rand(1,20);	
	    }
	
	   $pageControls->randomImage1 = "decoration-image-".$id1;
	   $pageControls->randomImage2 = "decoration-image-".$id2;
	  
	  return $pageControls;
    	  
	}
	
	function getMoviesData()
	{
		  require "php/extra/DataBaseConnect.php";
		  $result = mysqli_query($dataBase,'SELECT COUNT(*) as total FROM Pornusy');
		  $row = mysqli_fetch_assoc($result);
		  $totalMovies = $row['total'];
		  $query = $this->createQuery();
		  $result = mysqli_query($dataBase, $query);
		  $movies = array();
		  
		  while($row = mysqli_fetch_assoc($result))
		  {
			array_push($movies, new Movie($row['opis'], $row['gwiazdy'],$row['wyswietlenia'], $row['sekundy'],$row['minuty'],$row['godziny'], $row['lektorpl']));
		  }
		  
		  mysqli_close($dataBase);
		  $pageControls = $this->calculatePageControls($totalMovies);
		  return new PagePackage($movies, $pageControls);
		  
	}
}

?>