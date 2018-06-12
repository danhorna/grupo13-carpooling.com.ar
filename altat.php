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
		<p><h3>Complete los datos para registrar su tarjeta</h3></p>
		<form action="altatok.php" method="post" onsubmit="return validacion()">
			<p><h4>Nick: <input type="text" name="nick" id="nick" maxlength="16"/></h4></p>
			<p><h4>Tipo: <input type="radio" name="tarjeta" value="1">Visa <input type="radio" name="tarjeta" value="2">MasterCard</h4></p>
			<p><h4>Numero de tarjeta: <input type="text" name="numero" id="numero" maxlength="16"/></h4></p>
			<p><h4>Nombre en la tarjeta: <input type="text" name="nombre" id="nombre"/></h4></p>
			<p><h4>Fecha de vencimiento: <input type="text" name="vencimiento" id="vencimiento"/></h4></p>
			<p><h4>Digitos del reverso: <input type="password" name="clave" id="clave" maxlength="3" size="1"/></h4></p>
			<p><input type="submit" value="Registrar tarjeta"/></p>
			</form>
	
	
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>