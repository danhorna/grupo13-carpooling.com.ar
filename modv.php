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
	
	
	$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[modv]'";
	
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	
	foreach ($rows as $row) {
	$marca = $row['marca'];
	$modelo = $row['modelo'];
	$color = $row['color'];
	$descripcion = $row['descripcion'];
	$asientos = $row['asientos'];
	$patente = $row['patente'];
	$viajes = $row['viajes'];
	$id = $row['id'];
	}
	if ($viajes == 0) {
?>
	
	<form action="modok.php" method="post">
	<p><h3>Marca : <input type="text" name="marca" id="marca" value="<?php echo $marca?>"/></h4></p>
	<p><h3>Modelo : <input type="text" name="modelo" id="modelo" value="<?php echo $modelo;?>"/></h4></p>
	<p><h3>Color : <input type="text" name="color" id="color" value="<?php echo $color?>"/></h4></p>
	<p><h4>Asientos: <input type="number" name="asientos" id="asientos" min="1" value="<?php echo $asientos?>"/></h4></p>
	<p><h3>Patente : <input type="text" name="patente" id="patente" value="<?php echo $patente?>"/></h4></p>
	<p><h4>Descripcion: <textarea name="descripcion"><?php echo $descripcion?></textarea></h4></p>
	<input type="hidden" name="id" id="id" value=" <?php echo $id; ?>"/>
	<input type="submit" value="Modificar datos"/>
	</form>
	
	<?php
	}
	else{ ?>
		<p><h1>No se puede modificar el vehiculo ya que tiene viajes activos</p></h1>
		<p><h2><a href="autos.php?">Listado de autos</p></h2>
	<?php
	}
	?>
	

</div>
	</div>
	
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>
