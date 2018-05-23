<?php 

class SendMessageView extends View
{
  function render()
  {
     require "php/template/MessageReport.php";
  }

  function __construct($model)
  {
     $this->model = $model;
  }  
}

?>
