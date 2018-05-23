<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="UTF-8"/>
	<title>Raport wysyłania wiadomości</title>
	<meta name="description" content="Status wysłanej wiadomości do imperatora">
	<meta name="keywords" content="raport, wiadomość, imperator">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Cybertron">
	<link rel="stylesheet" href="/css/message-report.css">
	<link href='http://fonts.googleapis.com/css?family=Play&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div class="message-report">
	 <?php $this->model->sendEmail(); ?>
	</div>
   
  <footer class="porn-empire-footer">
&copy; 2018 Cybertron
</footer>
  </body>
 </html>