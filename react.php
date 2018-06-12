<?php
session_start();
if(isset($_SESSION['email'])){
header("location: main.php");
}

$entro = 'no';
require_once 'conexionobject.php';
$result;	
$conn = dbConnect();
$sql = "SELECT * FROM usuarios WHERE nombre = '$_POST[nombre]' AND apellido = '$_POST[apellido]' AND email = '$_POST[email]' AND pw = '$_POST[pw]' AND activo = 'no'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	$query = "UPDATE usuarios SET activo = 'si' WHERE email = '$_POST[email]'";
	$conn->query($query);
	$entro = 'si';
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
	<div id="page-wrapper">
	<div id="page" class="container">
		<div class="title">
			<h2>Reactivar su cuenta</h2>
		</div>
	</div>
	</div>
	<div class="wrapper">
	<div id="three-column" class="container">
	<?php
		if ($entro == 'si') { ?>
			<p><h1>Cuenta reactivada!</p></h1>
			<p><h2><a href="login.php?">Login</p></h2>
			<?php
		}
		else { ?>
			<p><h1>Los datos son incorrectos o la cuenta se encuentra activa!</p></h1>
			<p><h2><a href="reactivar.php?">Reintentar</p></h2>
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