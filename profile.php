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
	
	
	$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
	
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	
	foreach ($rows as $row) {
	$ruta = $row['foto'];
	$nom = $row['nombre'];
	$ape = $row['apellido'];
	$email = $row['email'];
	$repu = $row['repu'];
	$id = $row['idu'];
	}
	
?>
	<p><div>
		<img src="img/<?php echo $ruta; ?>" alt="" width="200" height="200" />
	</div></p>
	
	<p><form>
		<input type="button" value="Cambiar foto" onclick="window.location.href='changepic.php'" />
	</form></p>
	
	<p><h3>Nombre y Apellido: <?php echo $nom?> <?php echo $ape;?> </h3></p>
	<p><h3>Email : <?php echo $email;?> </h3></p>
	<p><form>
		<input type="button" value="Ver reputacion" onclick="window.location.href='reputacion.php'" />
	</form></p>
	
	<form action="modification.php" method="post">
		<input type="hidden" name="idu" id="idu" value=" <?php echo $id; ?>"/>
		
		<input type="submit" value="Modificar datos"/>
	</form>
	
	<p><form>
		<input type="button" value="Mis autos" onclick="window.location.href='autos.php'" />
	</form></p>
	
	<p><form>
		<input type="button" value="Mis tarjetas" onclick="window.location.href='paid.php'" />
	</form></p>
	
	<p><form>
		<input type="button" value="Ver mis viajes/postulaciones" onclick="window.location.href='check.php'" />
	</form></p>
	<p><form>
		<input type="button" value="Postulados a mis viajes" onclick="window.location.href='list.php'" />
	</form></p>
	
	<p><form>
		<input type="button" value="Dar de baja" onclick="window.location.href='baja.php'" />
	</form></p>
	
	
	
	

</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>
