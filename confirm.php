<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
	$email = $_SESSION['email'];
	require_once 'conexionobject.php';
	$nice = "no";
	$conn = dbConnect();
	$sql = "SELECT * FROM usuarios WHERE email = '$email'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$idu = $row['idu'];
	}
	if ($_POST['viajetipo'] == 'Semanal'){
		$sql = "SELECT * FROM viajes WHERE lazo = '$_POST[tipolazo]'";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		$dato = 'pri';
		foreach ($rows as $row) {
			$query = "INSERT INTO postulaciones (idv, idu, estado, iduv, calificado, idpo, calificadoco, idt, lazo, cola) 
			VALUES ('$row[idv]', '$idu', 'espera', '$_POST[idu]', 'no', '$_SESSION[email]', 'no', '$_POST[opcion]', '$_POST[tipolazo]', '$dato')";
			$conn->query($query);
			$dato = 'sec';
			$nice = "si";
				$sql = "SELECT * FROM tarjetas WHERE id = '$_POST[opcion]'";
				$result = $conn->query($sql);
				$rows = $result->fetchAll();
				foreach ($rows as $row) {
					$num = $row['postuacti'];
					$num = $num + 1;
					$query = "UPDATE tarjetas SET postuacti = '$num' WHERE id = '$_POST[opcion]'";
					$conn->query($query);
				}
		}
	}
	else {
		if ($_POST['viajetipo'] == 'Ocasional') {
			$sql = "SELECT * FROM viajes WHERE idv = '$_POST[viajeid]'";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
			foreach ($rows as $row) {
				$query = "INSERT INTO postulaciones (idv, idu, estado, iduv, calificado, idpo, calificadoco, idt) 
				VALUES ('$row[idv]', '$idu', 'espera', '$_POST[idu]', 'no', '$_SESSION[email]', 'no', '$_POST[opcion]')";
				$conn->query($query);
				$nice = "si";
				$sql = "SELECT * FROM tarjetas WHERE id = '$_POST[opcion]'";
				$result = $conn->query($sql);
				$rows = $result->fetchAll();
				foreach ($rows as $row) {
					$num = $row['postuacti'];
					$num = $num + 1;
					$query = "UPDATE tarjetas SET postuacti = '$num' WHERE id = '$_POST[opcion]'";
					$conn->query($query);
				}
			}
		}
		else {
			$sql = "SELECT * FROM viajes WHERE lazo = '$_POST[tipolazo]'";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
			$dato = 'pri';
			foreach ($rows as $row) {
				$query = "INSERT INTO postulaciones (idv, idu, estado, iduv, calificado, idpo, calificadoco, idt, lazo, cola) 
				VALUES ('$row[idv]', '$idu', 'espera', '$_POST[idu]', 'no', '$_SESSION[email]', 'no', '$_POST[opcion]', '$_POST[tipolazo]', '$dato' )";
				$conn->query($query);
				$dato = 'sec';
				$nice = "si";
				$sql = "SELECT * FROM tarjetas WHERE id = '$_POST[opcion]'";
				$result = $conn->query($sql);
				$rows = $result->fetchAll();
				foreach ($rows as $row) {
					$num = $row['postuacti'];
					$num = $num + 1;
					$query = "UPDATE tarjetas SET postuacti = '$num' WHERE id = '$_POST[opcion]'";
					$conn->query($query);
				}
			}
		}
	}
	
?>	
<html>
 <head>
 <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
 <link href="fonts/default.css" rel="stylesheet" type="text/css" media="all" />
 <link href="fonts/fonts.css" rel="stylesheet" type="text/css" media="all" />
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
		<?php
			if ($nice == 'si') {
				echo '<p><h1>' . 'Te postulaste exitosamente!' . '</h1></p>';
			}
			else {
				echo '<p><h1>' . 'No puedes postularte al mismo viaje!' . '</h1></p>';
			}
		?>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
	
	
	
	
 </body>
</html>
	
	
	
	
	
	
	
	
