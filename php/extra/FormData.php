<?php

class FormData
{
  public $columnName;
  public $value;
  public $parsingType;
  
  function __construct($columnName, $value, $parsingType)
  {
    $this->columnName = $columnName;
	$this->value = $value;
	$this->parsingType = $parsingType;
  }  
}

?>