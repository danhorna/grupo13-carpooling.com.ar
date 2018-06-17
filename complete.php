
<html>
 <head>
 <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
 <link href="fonts/default.css" rel="stylesheet" type="text/css" media="all" />
 <title>Carpooling registro</title>
 <meta http-equiv="Refresh" content="5;url=register.php">
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
	require_once 'conexion.php';
	
	$buscarUsuario = "SELECT * FROM $us_tb
	WHERE email = '$_POST[email]' ";
	
	$result = $conexion->query($buscarUsuario);

	$count = mysqli_num_rows($result);
	
	if ($count == 1) {
		echo "<br />"."<p><h1>" . "El email ya a sido usado.". "</h1></p>" . "<br />";
		echo "<h2>" ."Por favor use otro email" . "</h2>";
	}
	
	else{
		$query = "INSERT INTO usuarios (nombre, apellido, email, fecha , pw, foto, activo)
        VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '$_POST[edad]', '$_POST[pw]', 'default.jpg', 'si')";
		
		if ($conexion->query($query) === TRUE) {
			session_start();
			$_SESSION['email'] = $_POST['email'];
			echo "<br />" . "<p><h1>" . "Registrado Exitosamente!" . "</h1></p>";
			echo "<h1>" . "Bienvenido " . $_POST['nombre'] . "</h1>" . "\n\n";
			?>
			<h2> Seras redirigido a la pagina principal </h2>
			<?php
		}
		else {
			echo "Error al registrarse." . $query . "<br>".  $conexion->error; 
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




