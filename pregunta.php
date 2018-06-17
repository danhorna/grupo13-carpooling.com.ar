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
	<form action="preguntaok.php" method="post" >
		<input type="hidden" name="idviaje" id="idviaje" value="<?php echo $_POST['idviaje']?>"/>
		<p><h4>Pregunta: <textarea name="descripcion"></textarea></h4></p>
		<p><input type="submit" value="Enviar pregunta"/></p>
	</form>
	
	<p><form action="viaje.php" method="post">
			<input type="hidden" name="idviaje" id="idviaje" value="<?php echo $_POST['idviaje']?>"/>
			<input type="submit" value="Atras"/>
	</form></p>
	
	
	
	
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
	
 </body>
</html>