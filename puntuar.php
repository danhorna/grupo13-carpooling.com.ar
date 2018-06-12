<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
require_once 'conexionobject.php';
$result;
$conn = dbConnect();

if(isset($_POST['bi'])){
	$query = "UPDATE postulaciones SET calificado = 'si' WHERE id = '$_POST[bp]'";
	$conn->query($query);
	
	$sql = "SELECT * FROM usuarios WHERE idu = '$_POST[bi]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$calificacion = $row['repu'];
	}
	$calificacion = $calificacion + 2;
	$query = "UPDATE usuarios SET repu = '$calificacion' WHERE idu = '$_POST[bi]'";
	$conn->query($query);
	
	$sql = "SELECT * FROM tarjetas WHERE id = '$_POST[idt]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$cant = $row['postuacti'];
	}
	$cant = $cant - 1;
	
	$query = "UPDATE tarjetas SET postuacti = '$cant' WHERE id = '$_POST[idt]'";
	$conn->query($query);
}
else {
	if (isset($_POST['mi'])) {
		$query = "UPDATE postulaciones SET calificado = 'si' WHERE id = '$_POST[mp]'";
		$conn->query($query);
	
		$sql = "SELECT * FROM usuarios WHERE idu = '$_POST[mi]'";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		foreach ($rows as $row) {
		$calificacion = $row['repu'];
		}
		$calificacion = $calificacion - 1;
		echo $calificacion;
		echo $_POST['mi'];
		$query = "UPDATE usuarios SET repu = '$calificacion' WHERE idu = '$_POST[mi]'";
		$conn->query($query);
		
		$sql = "SELECT * FROM tarjetas WHERE id = '$_POST[idt]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$cant = $row['postuacti'];
	}
	$cant = $cant - 1;
	
	$query = "UPDATE tarjetas SET postuacti = '$cant' WHERE id = '$_POST[idt]'";
	$conn->query($query);
	}
	else {
		$query = "UPDATE postulaciones SET calificado = 'si' WHERE id = '$_POST[np]'";
		$conn->query($query);
		
		$sql = "SELECT * FROM tarjetas WHERE id = '$_POST[idt]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$cant = $row['postuacti'];
	}
	$cant = $cant - 1;
	
	$query = "UPDATE tarjetas SET postuacti = '$cant' WHERE id = '$_POST[idt]'";
	$conn->query($query);
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
		<p><h1>Calificacion aplicada!</p></h1>
		<p><h2><a href="main.php?">Inicio</p></h2>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>