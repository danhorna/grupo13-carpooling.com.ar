<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
require_once 'conexionobject.php';
$result;
$conn = dbConnect();


$sql = "SELECT * FROM postulaciones WHERE id = '$_POST[elp]'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	$idv = $row['idv'];
	$estado = $row['estado'];
	$tar = $row['idt'];
	$cola = $row['cola'];
	$lazo = $row['lazo'];
}

if ($cola == '') {
	$sql = "DELETE FROM postulaciones WHERE id = '$_POST[elp]'";
	$result = $conn->query($sql);


	if ($estado == 'aceptado') {
	$sql = "SELECT * FROM viajes WHERE idv = '$idv'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$row['asientos'] = $row['asientos'] + 1;
		$query = "UPDATE viajes SET asientos = '$row[asientos]' WHERE idv = '$idv'";
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
	$sql2 = "SELECT * FROM postulaciones WHERE lazo = '$lazo'";
	$result2 = $conn->query($sql2);
	$rows2 = $result2->fetchAll();
	foreach ($rows2 as $row2) {
		$poselim = $row2['id'];
		$idv = $row2['idv'];
		$estado = $row2['estado'];
		$tar = $row2['idt'];
		
		$sql3 = "DELETE FROM postulaciones WHERE id = '$poselim'";
		$result3 = $conn->query($sql3);
		
		if ($estado == 'aceptado') {
			$sql4 = "SELECT * FROM viajes WHERE idv = '$idv'";
			$result4 = $conn->query($sql4);
			$rows4 = $result4->fetchAll();
			foreach ($rows4 as $row4) {
				$row4['asientos'] = $row4['asientos'] + 1;
				$query = "UPDATE viajes SET asientos = '$row4[asientos]' WHERE idv = '$idv'";
				$conn->query($query);
			}
			$sql5 = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
			$result5 = $conn->query($sql5);
			$rows5 = $result5->fetchAll();
			foreach ($rows5 as $row5) {
				$repu = $row5['repu'];
			}

			$repu = $repu - 1;
			$query = "UPDATE usuarios SET repu = '$repu' WHERE email = '$_SESSION[email]'";
			$conn->query($query);
			
		}
		$sql6 = "SELECT * FROM tarjetas WHERE id = '$tar'";
		$result6 = $conn->query($sql6);
		$rows6 = $result6->fetchAll();
		foreach ($rows6 as $row6) {
			$ta = $row6['postuacti'];
		}

		$ta = $ta - 1;
		$query = "UPDATE tarjetas SET postuacti = '$ta' WHERE id = '$tar'";
		$conn->query($query);
		
		
	}
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
		<p><h1>Postulacion eliminada!</p></h1>
		<p><h2><a href="check.php?">Historial</p></h2>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>