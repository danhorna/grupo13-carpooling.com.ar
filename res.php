<?php
	$correo = $_POST['email'];
	require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	
	$sql = "SELECT * FROM usuarios WHERE email = '$correo'";
	$dato = 'si';
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	if (empty($rows)) {
			$dato = "no";
		}
	else {
			//mail($correo,'Recuperacion','Tu contraseña es: '. $row['pw']);
	}
		
		
		
	
?>

<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
	<div id="page-wrapper">
	<div id="page" class="container">
	</div>
	</div>
	<div class="wrapper">
	<div id="three-column" class="container">
	<?php	
		if ($dato == 'si') { ?>
			<p><h1>La contraseña fue enviada a <?php echo $correo ?>!</p></h1>
			<p><h2><a href="login.php?">Login</h2>
		<?php }
		else { ?>
			<p><h1>El correo no esta registrado!</p></h1>
			<p><h2><a href="register.php?">Registrarse</h2>
	<?php
		} ?>
		
		
	
	
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
	
 </body>
</html>