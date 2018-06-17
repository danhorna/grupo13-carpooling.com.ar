<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
require_once 'conexionobject.php';
$result;	
$conn = dbConnect();
if ($_POST['tipov'] == 'Ocasional') {
	$sql = "SELECT * FROM postulaciones WHERE id = '$_POST[lista]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$query = "UPDATE postulaciones SET estado = 'aceptado' WHERE id = '$_POST[lista]'";
		$idv = $row['idv'];
		$conn->query($query);
	}
	$sql = "SELECT * FROM viajes WHERE idv = '$idv'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$row['asientos'] = $row['asientos'] - 1;
		$query = "UPDATE viajes SET asientos = '$row[asientos]' WHERE idv = '$idv'";
		$conn->query($query);
	}
}
else{
	if ($_POST['tipov'] == 'Semanal' OR $_POST['tipov'] == 'Diario') {
		$sql = "SELECT * FROM postulaciones WHERE lazo = '$_POST[lazo]'";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		foreach ($rows as $row) {
			$query = "UPDATE postulaciones SET estado = 'aceptado' WHERE lazo = '$_POST[lazo]'";
			$idv = $row['idv'];
			$conn->query($query);
		}
		$sql = "SELECT * FROM viajes WHERE lazo = '$_POST[lazo]'";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		foreach ($rows as $row) {
			$row['asientos'] = $row['asientos'] - 1;
			$query = "UPDATE viajes SET asientos = '$row[asientos]' WHERE lazo = '$_POST[lazo]'";
			$conn->query($query);
		}
	}
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
	<div class="wrapper">
	<div id="three-column" class="container">
	<div><span class="arrow-down"></span></div>
		<p><h1>Postulante aprobado!</p></h1>
		<p><h2><a href="list.php?">Postulados</p></h2>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
 </body>
</html>