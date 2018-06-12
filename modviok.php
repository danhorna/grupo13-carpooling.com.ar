<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
	require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	
	if ($_POST['viajetipo'] == 'Ocasional') {
	$sql = "SELECT * FROM viajes WHERE idv = '$_POST[idv]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	
	foreach ($rows as $row) {
		$query = "UPDATE viajes SET auto = '$_POST[opcion]', origen = '$_POST[origen]', destino = '$_POST[destino]', hora = '$_POST[hora]', duracion = '$_POST[duracion]', tipo = '$_POST[tipo]', costo = '$_POST[costo]' WHERE idv = '$_POST[idv]'";
		$conn->query($query);
	}
	}
	else{
		echo 'te';
		$query = "UPDATE viajes SET auto = '$_POST[opcion]', origen = '$_POST[origen]', destino = '$_POST[destino]', hora = '$_POST[hora]', duracion = '$_POST[duracion]', costo = '$_POST[costo]' WHERE lazo = '$_POST[viajelazo]'";
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
		<p><h1>Viaje actualizado!</p></h1>
		<p><h2><a href="check.php?">Historial</p></h2>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>