<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
require_once 'conexionobject.php';
$result;	
$conn = dbConnect();
$sql = "SELECT * FROM postulaciones WHERE id = '$_POST[listd]'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	$tar = $row['idt'];
	$query = "UPDATE postulaciones SET estado = 'rechazado' WHERE id = '$_POST[listd]'";
	$conn->query($query);
}

$sql = "SELECT * FROM tarjetas WHERE id = '$tar'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	$ta = $row['postuacti'];
}

$ta = $ta - 1;
$query = "UPDATE tarjetas SET postuacti = '$ta' WHERE id = '$tar'";
$conn->query($query);

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
		<p><h1>Postulante rechazado correctamente!</p></h1>
		<p><h2><a href="list.php?">Postulados</p></h2>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
 </body>
</html>