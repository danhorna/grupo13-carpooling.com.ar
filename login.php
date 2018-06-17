<?php
session_start();
if(isset($_SESSION['email'])){
header("location: main.php");
}
?>

<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
 <link href="fonts/default.css" rel="stylesheet" type="text/css" media="all" />
 <title>Carpooling login</title>
 <script type="text/javascript" src="functions/functionlog.js"></script>
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
			<h2>Inicio de sesion</h2>
		</div>
	</div>
	</div>
	<div class="wrapper">
	<div id="three-column" class="container">
		<form action="ingresar.php" method="post" onsubmit="return validacion()">
            <p><h3>Correo: <input type="text" name="email" id="email"/></h3></p>
            <p><h3>Clave: <input type="password" name="pw" id="pw"/></h3></p>
            <p><input type="submit" value="Iniciar sesion"/></p>
        </form>
		<h4><a href="reset.php">Recuperar contraseña</a></h4>
		<h4><a href="reactivar.php">Reactivar cuenta</a></h4>
	
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
	
	
	
	
 </body>
</html>