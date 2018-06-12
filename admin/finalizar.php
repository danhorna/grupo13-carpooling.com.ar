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
	
function porcentaje($cantidad,$porciento,$decimales){
return number_format($cantidad*$porciento/100 ,$decimales);
}
	require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	
if ($_POST['tipoidv'] == 'Ocasional') {	
	$sql = "SELECT * FROM viajes WHERE idv = '$_POST[finidv]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$query = "UPDATE viajes SET activo = 'no' WHERE idv = '$_POST[finidv]'";
		$conn->query($query);
		$auto = $row['auto'];
		$costo = $row['costo'];
		$asientos = $row['asientos'];
	}
	
	
	$sql = "SELECT * FROM vehiculos WHERE id = '$auto'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$asientostotales = $row['asientos'];
		$row['viajes'] = $row['viajes'] - 1;
		$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$auto'";
		$conn->query($query);
	}
	
	
	$porciento =  porcentaje($costo,5,1);
	
	$cobrar = ($asientostotales - $asientos) + 1;
	
	$cobrar = $costo / $cobrar;
	
	$cobrarpi = $cobrar + $porciento;

}
else {
		
		$sql = "SELECT * FROM viajes WHERE idv = '$_POST[finidv]'";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		foreach ($rows as $row) {
			$viajed = $row['fecha'];
			$auto = $row['auto'];
			$costo = $row['costo'];
			$asientos = $row['asientos'];
		}
		
		$sql = "SELECT * FROM viajes WHERE lazo = '$_POST[lazo]'";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		foreach ($rows as $row) {
			$query = "UPDATE viajes SET activo = 'no' WHERE idv = '$row[idv]'";
			$conn->query($query);
			
			$query = "UPDATE viajes SET cola = 'don' WHERE idv = '$_POST[finidv]'";
			$conn->query($query);
			
		}
		
		$sql = "SELECT * FROM viajes WHERE lazo = '$_POST[lazo]' AND cola <> 'don' ORDER BY fecha";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		$sigue = 'si';
		foreach ($rows as $row) {
			if ($sigue == 'si'){
				$query = "UPDATE viajes SET cola = 'pri' WHERE idv = '$row[idv]'";
				$conn->query($query);
				$sigue = 'no';
			}
		}
		
		$sql = "SELECT * FROM vehiculos WHERE id = '$auto'";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		foreach ($rows as $row) {
			$asientostotales = $row['asientos'];
			$row['viajes'] = $row['viajes'] - 1;
			$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$auto'";
			$conn->query($query);
		}
		
		$porciento =  porcentaje($costo,5,1);
	
		$cobrar = ($asientostotales - $asientos) + 1;
	
		$cobrar = $costo / $cobrar;
	
		$cobrarpi = $cobrar + $porciento;
		
		
	
}	
	
	
	
	
	?>
	
	<p><h1>Viaje cerrado correctamente!</p></h1>
	<p><h2>Cada postulante pago: $<?php echo $cobrar ?> (se cuenta al piloto como parte del gasto)</p></h2>
	<p><h2>El piloto debe gastar: $<?php echo $cobrarpi ?> ($<?php echo $cobrar?> por el viaje y $<?php echo $porciento?> por comision al sitio)</p></h2>
	<?php
		if ($_POST['tipoidv'] == 'Semanal'){
			?>
				<p><h2>Para el viaje del dia: <?php echo $viajed ?></p></h2>
			<?php
		}
	?>
	<p><h2><a href="modificar.php?">Atras</p></h2>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>