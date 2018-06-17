<?php
session_start();
if(isset($_SESSION['email'])){
header("location: main.php");
}
?>

<html>
 <head>
 <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
 <link href="fonts/default.css" rel="stylesheet" type="text/css" media="all" />
 <title>Carpooling registro</title>
 <script type="text/javascript" src="functions/functions.js"></script>
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
			<h2>Reactivar su cuenta</h2>
		</div>
	</div>
	</div>
	<div class="wrapper">
	<div id="three-column" class="container">
		<p><h3><font color="red">Los opciones marcadas con * son obligatorias</font></h3></p>
			<form action="react.php" method="post" onsubmit="return validacion()">
			<p><h4>Nombre<font color="red">(*)</font>: <input type="text" name="nombre" id="nombre"/></h4></p>
			<p><h4>Apellido<font color="red">(*)</font>: <input type="text" name="apellido" id="apellido" /></h4></p>
			<p><h4>Correo<font color="red">(*)</font>: <input type="text" name="email" id="email"/></h4></p>
			<p><h4>Clave<font color="red">(*)</font>: <input type="password" name="pw" id="pw"/></h4></p>
			<p><input type="submit" value="Reactivar"/></p>
			</form>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
 
 
 
 
 </body>
</html>