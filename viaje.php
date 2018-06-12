<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
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
		
		<hr size="2px" color="black" />
		<?php
		
		
		
		if (!($_POST['iduser'] == $_SESSION['email'])) { 
			?>
			
		<p><h2>Te vas a postular en las fechas: </h2></p>
		<?php
		
			
			?>
		
		
		
		<p><form action="confirm.php" method="post">
		<?php
			$att = 'n';
			if ($tipo == 'Semanal') {
				$sql3 = "SELECT * FROM viajes WHERE lazo = '$lazo' AND activo = 'si'";
				$result3 = $conn->query($sql3);
				$rows3 = $result3->fetchAll();
				foreach ($rows3 as $row3) {
					$postulado = 'no';
					$newDate = date("d/m/Y", strtotime($row3['fecha']));
					$sql4 = "SELECT * FROM postulaciones WHERE idv = '$row3[idv]' AND idpo = '$_SESSION[email]'";
					$result4 = $conn->query($sql4);
					$rows4 = $result4->fetchAll();
					foreach ($rows4 as $row4) {
						$postulado = 'si';
						$att = 's';
					}
					if ($postulado == 'si') { 
						$diaz = date("l", strtotime($row3['fecha']));
							if ($diaz == 'Monday'){
								$diaz = 'Lunes';
							}
							if ($diaz == 'Tuesday'){
								$diaz = 'Martes';
							}
							if ($diaz == 'Wednesday'){
								$diaz = 'Miercoles';
							}
							if ($diaz == 'Thursday'){
								$diaz = 'Jueves';
							}
							if ($diaz == 'Friday'){
								$diaz = 'Viernes';
							}
							if ($diaz == 'Saturday'){
								$diaz = 'Sabado';
							}
							if ($diaz == 'Sunday'){
								$diaz = 'Domingo';
							}
					?>
						<p><h4><li> <?php echo $newDate; ?> - <?php echo $diaz; ?> <font color="red">!</font></li></h4></p>
						<?php
					}
					else {
						$diaz = date("l", strtotime($row3['fecha']));
							if ($diaz == 'Monday'){
								$diaz = 'Lunes';
							}
							if ($diaz == 'Tuesday'){
								$diaz = 'Martes';
							}
							if ($diaz == 'Wednesday'){
								$diaz = 'Miercoles';
							}
							if ($diaz == 'Thursday'){
								$diaz = 'Jueves';
							}
							if ($diaz == 'Friday'){
								$diaz = 'Viernes';
							}
							if ($diaz == 'Saturday'){
								$diaz = 'Sabado';
							}
							if ($diaz == 'Sunday'){
								$diaz = 'Domingo';
							}
					?>
					<input type="hidden" name="tipolazo" id="tipolazo" value="<?php echo $lazo?>"/>
					<p><h4><li> <?php echo $newDate; ?>  - <?php echo $diaz; ?> </li></h4></p>
					<?php
				}}
			}
			else{
				if ($tipo == 'Ocasional') {
					$sql3 = "SELECT * FROM viajes WHERE idv = '$_POST[idviaje]' AND activo = 'si'";
					$result3 = $conn->query($sql3);
					$rows3 = $result3->fetchAll();
					foreach ($rows3 as $row3) {
						$postulado = 'no';
					$newDate = date("d/m/Y", strtotime($row3['fecha']));
					$sql4 = "SELECT * FROM postulaciones WHERE idv = '$row3[idv]' AND idpo = '$_SESSION[email]'";
					$result4 = $conn->query($sql4);
					$rows4 = $result4->fetchAll();
					foreach ($rows4 as $row4) {
						$postulado = 'si';
						$att = 's';
					}
					if ($postulado == 'si') {
						$diaz = date("l", strtotime($row3['fecha']));
							if ($diaz == 'Monday'){
								$diaz = 'Lunes';
							}
							if ($diaz == 'Tuesday'){
								$diaz = 'Martes';
							}
							if ($diaz == 'Wednesday'){
								$diaz = 'Miercoles';
							}
							if ($diaz == 'Thursday'){
								$diaz = 'Jueves';
							}
							if ($diaz == 'Friday'){
								$diaz = 'Viernes';
							}
							if ($diaz == 'Saturday'){
								$diaz = 'Sabado';
							}
							if ($diaz == 'Sunday'){
								$diaz = 'Domingo';
							}
					?>
						<p><h4><li> <?php echo $newDate; ?> - <?php echo $diaz; ?> <font color="red">!</font></li></h4></p>
						<?php
					}
					else {
						$diaz = date("l", strtotime($row3['fecha']));
							if ($diaz == 'Monday'){
								$diaz = 'Lunes';
							}
							if ($diaz == 'Tuesday'){
								$diaz = 'Martes';
							}
							if ($diaz == 'Wednesday'){
								$diaz = 'Miercoles';
							}
							if ($diaz == 'Thursday'){
								$diaz = 'Jueves';
							}
							if ($diaz == 'Friday'){
								$diaz = 'Viernes';
							}
							if ($diaz == 'Saturday'){
								$diaz = 'Sabado';
							}
							if ($diaz == 'Sunday'){
								$diaz = 'Domingo';
							}
					?>
					<input type="hidden" name="viajeid" id="viajeid" value="<?php echo $_POST['idviaje']?>"/>
					<p><h4><li> <?php echo $newDate; ?>  - <?php echo $diaz; ?> </li></h4></p>
					<?php
					}
				}}
				else{
					$sql3 = "SELECT * FROM viajes WHERE lazo = '$lazo' AND activo = 'si'";
					$result3 = $conn->query($sql3);
					$rows3 = $result3->fetchAll();
					foreach ($rows3 as $row3) {
						$postulado = 'no';
						$newDate = date("d/m/Y", strtotime($row3['fecha']));
						$sql4 = "SELECT * FROM postulaciones WHERE idv = '$row3[idv]' AND idpo = '$_SESSION[email]'";
						$result4 = $conn->query($sql4);
						$rows4 = $result4->fetchAll();
						foreach ($rows4 as $row4) {
							$postulado = 'si';
							$att = 's';
						}
						if ($postulado == 'si') { 
							$diaz = date("l", strtotime($row3['fecha']));
							if ($diaz == 'Monday'){
								$diaz = 'Lunes';
							}
							if ($diaz == 'Tuesday'){
								$diaz = 'Martes';
							}
							if ($diaz == 'Wednesday'){
								$diaz = 'Miercoles';
							}
							if ($diaz == 'Thursday'){
								$diaz = 'Jueves';
							}
							if ($diaz == 'Friday'){
								$diaz = 'Viernes';
							}
							if ($diaz == 'Saturday'){
								$diaz = 'Sabado';
							}
							if ($diaz == 'Sunday'){
								$diaz = 'Domingo';
							}
						?>
							<p><h4><li> <?php echo $newDate; ?>  - <?php echo $diaz; ?> <font color="red">!</font></li></h4></p>
							<?php
						}
						else {
							$diaz = date("l", strtotime($row3['fecha']));
							if ($diaz == 'Monday'){
								$diaz = 'Lunes';
							}
							if ($diaz == 'Tuesday'){
								$diaz = 'Martes';
							}
							if ($diaz == 'Wednesday'){
								$diaz = 'Miercoles';
							}
							if ($diaz == 'Thursday'){
								$diaz = 'Jueves';
							}
							if ($diaz == 'Friday'){
								$diaz = 'Viernes';
							}
							if ($diaz == 'Saturday'){
								$diaz = 'Sabado';
							}
							if ($diaz == 'Sunday'){
								$diaz = 'Domingo';
							}
							?>
							<input type="hidden" name="tipolazo" id="tipolazo" value="<?php echo $lazo?>"/>
							<p><h4><li> <?php echo $newDate; ?> - <?php echo $diaz; ?></li></h4></p>
							<?php
						}
					}
				}
			}
			if ($att <> 's'){
			include_once('conexion.php');
			$result = mysqli_query($conexion,"SELECT * from tarjetas where idu='$_SESSION[email]'"); ?>
			<p><h4>Tarjeta: 
			<select name="opcion" id="opcion"> 
	<?php
			while($row = mysqli_fetch_array($result))   { ?>
				<option value = <?php echo $row["id"]; ?>><?php echo $row["nick"]; ?></option> 
	<?php 		
			} ?>   
			</select></h4></p>
			<input type="hidden" name="viajetipo" id="viajetipo" value="<?php echo $tipo?>"/>
			<input type="hidden" name="idu" id="idu" value="<?php echo $idu?>"/>
			<input type="submit" value="Postularse"/>
			<?php
			}
			if ($att == 's') { ?>
			<p><h4><font color="red">!</font> : Ya estas postulado a este viaje</h4></p>
			<?php
			}
			?>
		</form></p>
		<hr size="2px" color="black" />
		<p><form action="pregunta.php" method="post">
			<input type="hidden" name="iduser" id="iduser" value="<?php echo $idu?>"/>
			<input type="hidden" name="idviaje" id="idviaje" value="<?php echo $_POST['idviaje']?>"/>
			<input type="submit" value="Preguntar"/>
		</form></p>
		<?php
		}
		
		if ($_POST['iduser'] == $_SESSION['email']) { ?>
		
		<p><form>
		<input type="button" value="Atras" onclick="window.location.href='check.php'" />
		</form></p>
		<?php
		}
		else { ?>
			<p><form>
			<input type="button" value="Atras" onclick="window.location.href='postulate.php'" />
			</form></p>
			<?php
		}?>
		

		
		
	</div>
	<div style="float: right; width: 45%">
		<?php
		if ($tipo == 'Semanal') {
			$sql5 = "SELECT * FROM viajes WHERE lazo = '$lazo'";
			$result5 = $conn->query($sql5);
			$rows5 = $result5->fetchAll();
			foreach ($rows5 as $row5) {
				$idvp = $row5['idv'];
				$sql6 = "SELECT * FROM preguntas WHERE idv = '$idvp'";
				$result6 = $conn->query($sql6);
				$rows6 = $result6->fetchAll();
				foreach ($rows6 as $row6) {
					$idu = $row6['idu'];
					$pregunta = $row6['pregunta'];
					$idp = $row6['id'];
					$sql7 = "SELECT * FROM usuarios WHERE email = '$idu'";
					$result7 = $conn->query($sql7);
					$rows7 = $result7->fetchAll();
					foreach ($rows7 as $row7) {
						$nombre = $row7['nombre'];
						$apellido = $row7['apellido'];
					}
				
					?>
				<p><h3><?php echo $nombre ?> <?php echo $apellido ?> pregunta: <?php echo $pregunta;?> </h3></p>
					<?php
				if (($_POST['iduser'] == $_SESSION['email']) AND ($row6['respondido'] == 'no')){
					?>
					<form action="respuesta.php" method="post" >
					<input type="hidden" name="idp" id="idp" value="<?php echo $idp?>"/>
					<p><h4>Respuesta: <textarea name="respuesta"></textarea></h4></p>
					<p><input type="submit" value="Enviar respuesta"/></p>
					</form>
					<?php
			
				}
				else {
					if ($row6['respondido'] == 'si') {
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

				}
?>				<hr size="10px" color="black" /> <?php
			}}
		}
		else{
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
			if (($_POST['iduser'] == $_SESSION['email']) AND ($row['respondido'] == 'no')){
				?>
				<form action="respuesta.php" method="post" >
				<input type="hidden" name="idp" id="idp" value="<?php echo $idp?>"/>
				<p><h4>Respuesta: <textarea name="respuesta"></textarea></h4></p>
				<p><input type="submit" value="Enviar respuesta"/></p>
				</form>
				<?php
			
			}
			else {
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
		}
		
		
		?>
		
		
		
		<hr size="10px" color="black" />
		<?php
		
		}}
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