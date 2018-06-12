<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
	require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	
	
	$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[id]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	
	foreach ($rows as $row) {
		$query = "UPDATE vehiculos SET marca = '$_POST[marca]', modelo = '$_POST[modelo]', color = '$_POST[color]', descripcion = '$_POST[descripcion]', asientos = '$_POST[asientos]', patente = '$_POST[patente]' WHERE id = '$_POST[id]'";
		$conn->query($query);
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
		<div><span class="arrow-down"></span></div>
		<p><h1>Vehiculo actualizado!</p></h1>
		<p><h2><a href="autos.php?">Listado de autos</p></h2>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>