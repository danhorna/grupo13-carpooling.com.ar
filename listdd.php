<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
require_once 'conexionobject.php';
$result;	
$conn = dbConnect();
$sql = "SELECT * FROM postulaciones WHERE id = '$_POST[listdd]'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	$lazo = $row['lazo'];
	$idv = $row['idv'];
}
$sql = "SELECT * FROM viajes WHERE idv = '$idv'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	$tipo = $row['tipo'];
}

if ($tipo == 'Ocasional') {

$sql = "SELECT * FROM postulaciones WHERE id = '$_POST[listdd]'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	$lazo = $row['lazo'];
	$idv = $row['idv'];
}
foreach ($rows as $row) {
	$idv = $row['idv'];
	$tar = $row['idt'];
	$query = "UPDATE postulaciones SET estado = 'rechazado' WHERE id = '$_POST[listdd]'";
	$conn->query($query);
}

$sql = "SELECT * FROM viajes WHERE idv = '$idv'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	$asientos = $row['asientos'] + 1;
	$query = "UPDATE viajes SET asientos = '$asientos' WHERE idv = '$idv'";
	$conn->query($query);
}

$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	$repu = $row['repu'];
}

$repu = $repu - 1;
$query = "UPDATE usuarios SET repu = '$repu' WHERE email = '$_SESSION[email]'";
$conn->query($query);

$sql = "SELECT * FROM tarjetas WHERE id = '$tar'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	$ta = $row['postuacti'];
}

$ta = $ta - 1;
$query = "UPDATE tarjetas SET postuacti = '$ta' WHERE id = '$tar'";
$conn->query($query);

}
else{
	$sql = "SELECT * FROM postulaciones WHERE lazo = '$lazo'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$ta = 0;
		$sql5 = "SELECT * FROM tarjetas WHERE id = '$row[idt]'";
		$result5 = $conn->query($sql5);
		$rows5 = $result->fetchAll();
		foreach ($rows5 as $row5) {
			$ta = $row5['postuacti'];
		}
		$ta = $ta - 1;
		$query = "UPDATE tarjetas SET postuacti = '$ta' WHERE id = '$row[idt]'";
		$conn->query($query);
		$query = "UPDATE postulaciones SET estado = 'rechazado' WHERE id = '$row[id]'";
		$conn->query($query);
	}
	
	$sql = "SELECT * FROM viajes WHERE lazo = '$lazo'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$asientos = $row['asientos'] + 1;
		$query = "UPDATE viajes SET asientos = '$asientos' WHERE idv = '$row[idv]'";
		$conn->query($query);
	}
	
	$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$repu = $row['repu'];
	}
	
	$repu = $repu - 1;
	$query = "UPDATE usuarios SET repu = '$repu' WHERE email = '$_SESSION[email]'";
	$conn->query($query);
	
	
	
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
		<p><h1>Postulante eliminado!</p></h1>
		<p><h2><a href="list.php?">Postulados</p></h2>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>