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
		</div>
	</div>
	</div>
	<div class="wrapper">
	<div id="three-column" class="container">
	<?php
	require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	$sql = "SELECT * FROM viajes WHERE idv = '$_POST[simul]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$fecha = $row['fecha'];
	}
	$actual = strtotime($fecha);
	$mesmenos = date("Y,m,d", strtotime("-2 month", $actual));
	
	$query = "UPDATE viajes SET fecha = '$mesmenos' WHERE idv = '$_POST[simul]'";
	$conn->query($query);
	
	?>
	
	<p><h1>Fecha del viaje cambiada para simular el paso de 30 dias sin calificar</p></h1>
	<p><h2><a href="modificar.php?">Atras</p></h2>
	
	
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>