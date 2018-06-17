<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}

require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	
	
	$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
	
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	
	foreach ($rows as $row) {
		$repu = $row['repu'];
		$query = "UPDATE usuarios SET activo = 'no' WHERE email = '$_SESSION[email]'";
		$conn->query($query);
	}
	
	$sql = "SELECT * FROM viajes WHERE id = '$_SESSION[email]'";
	
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	$restar = 0;
	foreach ($rows as $row) {
		if ($row['activo'] == 'si') {
			echo 'HELP';
			$restar = $restar + 1;
			$auto = $row['auto'];
			$idv = $row['idv'];
			$sql2 = "DELETE FROM viajes WHERE idv = $idv";
			$result = $conn->query($sql2);
			$sql2 = "DELETE FROM postulaciones WHERE idv = $idv";
			$result = $conn->query($sql2);
			$sql2 = "DELETE FROM preguntas WHERE idv = $idv";
			$result = $conn->query($sql2);
			$sql2 = "SELECT * FROM vehiculos WHERE id = '$auto'";
			$result2 = $conn->query($sql2);
			$rows2 = $result2->fetchAll();
			foreach ($rows2 as $row2) {
				$vt = $row2['viajes'];
			}
			$vt = $vt - 1;
			$query = "UPDATE vehiculos SET viajes = '$vt' WHERE id = '$auto'";
			$conn->query($query);
			
		}
	}
	$repu = $repu - $restar;
	$query = "UPDATE usuarios SET repu = '$repu' WHERE email = '$_SESSION[email]'";
	$conn->query($query);
	
	
	
	
session_destroy();
?>
 
	
<html>
 <head>
 <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
 <link href="fonts/default.css" rel="stylesheet" type="text/css" media="all" />
 <title>Carpooling</title>
 <meta http-equiv="Refresh" content="5;url=main.php">
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
		<p><h1>Baja realizada correctamente!</p></h1>
		<p><h1>En breve seras redireccionado a la pagina principal...</p></h1>
		
		
		
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
	
 </body>
</html>