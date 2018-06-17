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
<?php
	$user = $_SESSION['email'];
	require_once 'conexion.php';
	
	$buscarUsuario = "SELECT * FROM $ve_tb WHERE patente = '$_POST[patente]'";
	
	$result = $conexion->query($buscarUsuario);

	$count = mysqli_num_rows($result);
	
	if ($count == 1) {
		echo "<br />"."<p><h1>" . "La patente ya se encuentra registrada.". "</h1></p>" . "<br />";
		echo "<h2>" ."<a href='alta.php'>Vuelva a intentarlo</a>" . "</h2>";
	}
	
	else{
		$query = "INSERT INTO $ve_tb (marca, modelo, patente, asientos , color, idu, descripcion)
			      VALUES ('$_POST[marca]', '$_POST[modelo]', '$_POST[patente]', '$_POST[asientos]', '$_POST[color]', '$user', '$_POST[des]')";
				  
		if ($conexion->query($query) === TRUE) {
			echo "<br />" . "<p><h1>" . "Auto registrado exitosamente!" . "</h1></p>";
			echo "<h2>" . "<a href='autos.php'>Listado de autos</a>" . "</h2>";
		}
		else {
			echo "Error al registrar el auto." . $query . "<br>" . $conexion->error; 
		}
	}
	mysqli_close($conexion);
?>


	</div>
	</div>
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
 
 
 
 
 </body>
</html>