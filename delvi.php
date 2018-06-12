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
 <script type="text/javascript" src="functions/search.js"></script>
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
	<?php
	require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	
	$sql = "SELECT * FROM viajes WHERE idv = '$_POST[delvi]'";
	
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	
	foreach ($rows as $row) {
		$idv = $row['idv'];
		$ida = $row['auto'];
		$tipo = $row['tipo'];
		$lazo = $row['lazo'];
	}
	if ($tipo == 'Ocasional') {
	$sql = "DELETE FROM viajes WHERE idv = $idv";
	$result = $conn->query($sql);
	
	$sql = "SELECT * FROM vehiculos WHERE id = '$ida'";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
	
			foreach ($rows as $row) {
				$row['viajes'] = $row['viajes'] - 1;
				$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$ida'";
				$conn->query($query);
			}
			
	$sql = "SELECT * FROM postulaciones WHERE idv = '$idv'";
	$resta = 0;
	$result = $conn->query($sql);
	$rows = $result->fetchAll();		
	foreach ($rows as $row) {
		$resta = $resta + 1;
	}
	
	$sql = "DELETE FROM postulaciones WHERE idv = $idv";
	$result = $conn->query($sql);
	
	$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
	
			foreach ($rows as $row) {
				$row['repu'] = $row['repu'] - $resta;
				$query = "UPDATE usuarios SET repu = '$row[repu]' WHERE email = '$_SESSION[email]'";
				$conn->query($query);
			}
	}
	else{
		$sql = "SELECT * FROM viajes WHERE lazo = '$lazo'";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		foreach ($rows as $row) {
			if ($row['activo'] == 'si'){
				$sql2 = "SELECT * FROM vehiculos WHERE id = '$row[auto]'";
				$result2 = $conn->query($sql2);
				$rows2 = $result2->fetchAll();
				foreach ($rows2 as $row2) {
					$row2['viajes'] = $row2['viajes'] - 1;
					$query = "UPDATE vehiculos SET viajes = '$row2[viajes]' WHERE id = '$row[auto]'";
					$conn->query($query);
				}
				$sql3 = "SELECT * FROM postulaciones WHERE idv = '$row[idv]'";
				$resta3 = 0;
				$result3 = $conn->query($sql3);
				$rows3 = $result3->fetchAll();		
				foreach ($rows3 as $row3) {
					$resta3 = $resta3 + 1;
				}
				$sql4 = "DELETE FROM postulaciones WHERE idv = '$row[idv]'";
				$result4 = $conn->query($sql4);
				
				$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
				$result = $conn->query($sql);
				$rows = $result->fetchAll();
	
				foreach ($rows as $row) {
					$row['repu'] = $row['repu'] - $resta3;
					$query = "UPDATE usuarios SET repu = '$row[repu]' WHERE email = '$_SESSION[email]'";
					$conn->query($query);
				}
			}
		}
		
		$sql = "DELETE FROM viajes WHERE lazo = $lazo";
		$result = $conn->query($sql);
		
		
	}
	?> <p><h1>Viaje eliminado correctamente!</p></h1>
	<p><h2><a href="check.php?">Historial</p></h2>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
	
 </body>
</html>