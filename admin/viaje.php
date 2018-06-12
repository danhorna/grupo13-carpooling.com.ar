<?php
	require_once 'conexionobject.php';
	$result;
	
	$conn = dbConnect();
	$sql = "SELECT * FROM viajes WHERE idv = '$_POST[idviaje]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$origen = $row['origen'];
		$destino = $row['destino'];
		$duracion = $row['duracion'];
		$tipo = $row['tipo'];
		$costo = $row['costo'];
		$auto = $row['auto'];
		$idu = $row['id'];
		$asientos = $row['asientos'];
		$lazo = $row['lazo'];
	}
	$sql = "SELECT * FROM vehiculos WHERE id = '$auto'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$marca = $row['marca'];
		$modelo = $row['modelo'];
		$color = $row['color'];
		$descripcion = $row['descripcion'];
		$patente = $row['patente'];
	}
	
	$sql = "SELECT * FROM usuarios WHERE email = '$idu'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$nombre = $row['nombre'];
		$apellido = $row['apellido'];
		$reputacion = $row['repu'];
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
		</div>
	</div>
	</div>
	<div class="wrapper">
	<div id="three-column" class="container">
		<div style="float: left; width: 45%">  
		
		<p><h1>Informacion del viaje: </h1></p>
		<p><h3>Origen: <?php echo $origen;?> </h3></p>
		<p><h3>Destino: <?php echo $destino;?> </h3></p>
		<p><h3>Duracion: <?php echo $duracion;?> minutos</h3></p>
		<p><h3>Asientos: <?php echo $asientos;?> </h3></p>
		<p><h3>Tipo: <?php echo $tipo;?> </h3></p>
		<p><h3>Costo: $<?php echo $costo;?> </h3></p>
		<p><h1>Informacion del auto: </h1></p>
		<p><h3>Marca: <?php echo $marca;?> </h3></p>
		<p><h3>Modelo: <?php echo $modelo;?> </h3></p>
		<p><h3>Color: <?php echo $color;?> </h3></p>
		<p><h3>Descripcion: <?php echo $descripcion;?> </h3></p>
		<p><h3>Patente: <?php echo $patente;?> </h3></p>
		<p><h1>Informacion del piloto: </h1></p>
		<p><h3>Piloto: <?php echo $nombre;?> <?php echo $apellido;?></h3></p>
		<p><h3>Reputacion: <?php echo $reputacion;?> </h3></p>
		
		<?php
		
		if ($tipo <> 'Ocasional') {
			?>
			<p><h2>Fechas del viaje: </h2></p>
			<?php
			$sql = "SELECT * FROM viajes WHERE lazo = '$lazo'";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
			foreach ($rows as $row) { ?>
				<p><h4><li> <?php echo $row['fecha']; ?></li></h4></p>
				<?php
			}
		}
		?>
		
		
		<p><form>
		<input type="button" value="Atras" onclick="window.location.href='modificar.php'" />
		</form></p>
	
		

		
		
	</div>
	<div style="float: right; width: 45%">
		<?php
		$sql = "SELECT * FROM preguntas WHERE idv = '$_POST[idviaje]'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	if (!empty($rows)) {
		foreach ($rows as $row) {
			$idu = $row['idu'];
			$pregunta = $row['pregunta'];
			$idp = $row['id'];
		
			$sql2 = "SELECT * FROM usuarios WHERE email = '$idu'";
			$result2 = $conn->query($sql2);
			$rows2 = $result2->fetchAll();
			foreach ($rows2 as $row2) {
				$nombre = $row2['nombre'];
				$apellido = $row2['apellido'];
			}
			?>
			<p><h3><?php echo $nombre ?> <?php echo $apellido ?> pregunta: <?php echo $pregunta;?> </h3></p>
			<?php
				if ($row['respondido'] == 'si') {
					$sql = "SELECT * FROM respuestas WHERE idp = '$idp'";
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
					$respuesta = $row['respuesta'];
					}
				?>
				<p><h3>Respuesta del conductor: <?php echo $respuesta;?> </h3></p>
				<?php
			
				}
		
		
			?>
		
		
		
			<hr size="10px" color="black" />
			<?php
		
		}
	}
	?>
	</div>
	
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
	
 </body>
</html>