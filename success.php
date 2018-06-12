<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
?>
<html>
 <head>
 <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
 <link href="fonts/default.css" rel="stylesheet" type="text/css" media="all" />
 <title>Carpooling</title>
 <meta http-equiv="Refresh" content="5;url=index.php">
 </head>
 <body>	
	<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="index.php">Carpooling</a></h1>
		</div>
	</div>
	</div>
	<div id="page-wrapper">
	<div id="page" class="container">
		<div class="title">
			<h1>Hola <?php echo $_SESSION['email'] ?>, en breve seras redireccionado a la pagina principal...</h1>
		</div>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
	
	
	
	
 </body>
</html>