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
 <script type="text/javascript" src="functions/functionsreg.js"></script>
 </head>
 <body>
	<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="index.php">Carpooling</a></h1>
			<div id="menu">
				<ul>
					<li><a href="main.php" >Inicio</a></li>
					<li><a href="create.php" >Crear viaje</a></li>
					<li><a href="postulate.php" >Postularse</a></li>
					<li><a href="search.php" >Buscador</a></li>
					<li><a href="profile.php" >Mi perfil</a></li>
					<li><a href="bye.php" >Cerrar sesion</a></li>
				</ul>
			</div>
		</div>
	</div>
	</div>
	<div class="wrapper">
	<div id="three-column" class="container">
		<p><h3>Complete los datos para la creacion del viaje</h3></p>
			<form action="altaok.php" method="post" onsubmit="return validacion()">
			<p><h4>Marca del auto: <input type="text" name="marca" id="marca"/></h4></p>
			<p><h4>Modelo del auto: <input type="text" name="modelo" id="modelo"/></h4></p>
			<p><h4>Patente: <input type="text" name="patente" id="patente" /></h4></p>
			<p><h4>Asientos: <input type="number" name="asientos" id="asientos" min="1"/></h4></p>
			<p><h4>Color del auto: <input type="text" name="color" id="color"/></h4></p>
			<p><h4>Descripcion: <textarea name="des"></textarea></h4></p>
			<p><input type="submit" value="Registrar vehiculo"/></p>
			</form>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
 </body>
</html>