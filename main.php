<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
require_once 'conexionobject.php';
$result;
$hoy=date("Y-m-d");
$conn = dbConnect();
$verificar = 'no';
$inpo = 'no';
$inco = 'no';
$sql = "SELECT * FROM postulaciones WHERE idpo = '$_SESSION[email]' AND calificado = 'no'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	if ($row['estado'] == 'aceptado') {
		$sql2 = "SELECT * FROM viajes WHERE idv = '$row[idv]' AND fecha < '$hoy'";
		$result2 = $conn->query($sql2);
		$rows2 = $result2->fetchAll();
		foreach ($rows2 as $row2) {
			if ($row2['activo'] == 'no'){
				$inpo = 'si';
				$verificar = 'si';
			}
		}
		
	}
}
$sql = "SELECT * FROM postulaciones WHERE iduv = '$_SESSION[email]' AND calificadoco = 'no'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {
	if ($row['estado'] == 'aceptado') {
		$sql2 = "SELECT * FROM viajes WHERE idv = '$row[idv]' AND fecha < '$hoy'";
		$result2 = $conn->query($sql2);
		$rows2 = $result2->fetchAll();
		foreach ($rows2 as $row2) {
			if ($row2['activo'] == 'no'){
				$inco = 'si';
				$verificar = 'si';
			}
		}
		
	}
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
	<div><span class="arrow-down"></span></div>
		<?php
			if ($verificar == 'no') { ?>
				<p><h1>Bienvenido, use alguna de las opciones de arriba</p></h1>
		<?php	}
			else { if ($inpo == 'si') { ?>
				<p><h1>Calificaciones pendientes a pilotos</p></h1>
				<p><table border="3" WIDTH="100%" > </p>
				<thead>
					<tr>
						<th>ID</th>
						<th>Destino</th>
						<th>Fecha</th>
						<th>Costo</th>
						<th>Pagaste</th>
						<th>Piloto</th>
						<th>Calificacion positiva</th>
						<th>Calificacion negativa</th>
						<th>Calificacion neutral</th>
					</tr>
				</thead>
			
		<?php	
				$contador = 0;
				$sql = "SELECT * FROM postulaciones WHERE idpo = '$_SESSION[email]' AND estado = 'aceptado' AND calificado = 'no'";
				$result = $conn->query($sql);
				$rows = $result->fetchAll();
				$hoy=date("Y-m-d");
				foreach ($rows as $row) {
					$sql2 = "SELECT * FROM viajes WHERE idv = '$row[idv]' AND activo = 'no' AND fecha < '$hoy' ";
					$result2 = $conn->query($sql2);
					$rows2 = $result2->fetchAll();
					foreach ($rows2 as $row2) {
						$contador = $contador + 1;
					}
				}
				
				foreach ($rows as $row) {
					if ($contador > 0) {
						$postulacion = $row['id'];
						$contador = $contador - 1;
						$idtarjeta = $row['idt'];
						$sql2 = "SELECT * FROM viajes WHERE idv = '$row[idv]' AND activo = 'no' AND fecha < '$hoy'";
						$result2 = $conn->query($sql2);
						$rows2 = $result2->fetchAll();
						foreach ($rows2 as $row2) {
							$destino = $row2['destino'];
							$costo = $row2['costo'];
							$idp = $row2['id'];
							$auto = $row2['auto'];
							$asientos = $row2['asientos'];
							$idviaje = $row2['idv'];
							$fecha = $row2['fecha'];
						}
						
						
						
						$sql4 = "SELECT * FROM vehiculos WHERE id = '$auto'";
						$result4 = $conn->query($sql4);
						$rows4 = $result4->fetchAll();
						foreach ($rows4 as $row4) {
							$asientostotales = $row4['asientos'];
						}
						
						$cobrar = ($asientostotales - $asientos) + 1;
	
						$cobrar = $costo / $cobrar;
						
						$sql3 = "SELECT * FROM usuarios WHERE email = '$idp'";
						$result3 = $conn->query($sql3);
						$rows3 = $result3->fetchAll();
						foreach ($rows3 as $row3) {
							$piloto = $row3['nombre'];
							$idp = $row3['idu'];
						} ?>
						
						<tr>
							<td align="center"><?php echo $idviaje; ?></a></td>
							<td align="center"><?php echo $destino; ?></a></td>
							<?php
								$newDate = date("d/m/Y", strtotime($fecha));
							?>
							<td align="center"><?php echo $newDate; ?></a></td>
							<td align="center">$<?php echo $costo; ?></td>
							<td align="center">$<?php echo $cobrar; ?></td>
							<td align="center"><?php echo $piloto; ?></td>
							<td align="center">
								<p><form action="puntuar.php" method="post">
									<input type="hidden" name="idt" id="idt" value=" <?php echo $idtarjeta; ?>"/>
									<input type="hidden" name="bi" id="bi" value=" <?php echo $idp; ?>"/>
									<input type="hidden" name="bp" id="bp" value=" <?php echo $postulacion; ?>"/>
									<input type="submit" value="Click aca"/>
								</form></p></td>
							<td align="center">
								<p><form action="puntuar.php" method="post">
									<input type="hidden" name="idt" id="idt" value=" <?php echo $idtarjeta; ?>"/>
									<input type="hidden" name="mi" id="mi" value=" <?php echo $idp; ?>"/>
									<input type="hidden" name="mp" id="mp" value=" <?php echo $postulacion; ?>"/>
									<input type="submit" value="Click aca"/>
								</form></p></td>
							<td align="center">
								<p><form action="puntuar.php" method="post">
									<input type="hidden" name="idt" id="idt" value=" <?php echo $idtarjeta; ?>"/>
									<input type="hidden" name="np" id="np" value=" <?php echo $postulacion; ?>"/>
									<input type="submit" value="Click aca"/>
								</form></p></td>
						</tr>
				<?php } }?>	
						</table>
						
					
				
			
			
			
			
			
			
		<?php	}
				if ($inco == 'si') { ?>
					<p><h1>Calificaciones pendientes a copilotos</p></h1>
					<p><table border="3" WIDTH="100%" > </p>
						<thead>
							<tr>
								<th>ID</th>
								<th>Destino</th>
								<th>Fecha</th>
								<th>Costo</th>
								<th>Copiloto</th>
								<th>Calificacion positiva</th>
								<th>Calificacion negativa</th>
								<th>Calificacion neutral</th>
							</tr>
						</thead>
				<?php
				$contador = 0;
				$sql = "SELECT * FROM postulaciones WHERE iduv = '$_SESSION[email]' AND estado = 'aceptado' AND calificadoco = 'no'";
				$result = $conn->query($sql);
				$rows = $result->fetchAll();
				$hoy=date("Y-m-d");
				foreach ($rows as $row) {
					$sql2 = "SELECT * FROM viajes WHERE idv = '$row[idv]' AND activo = 'no' AND fecha < '$hoy'";
					$result2 = $conn->query($sql2);
					$rows2 = $result2->fetchAll();
					foreach ($rows2 as $row2) {
						$contador = $contador + 1;
					}
				}	
				foreach ($rows as $row) {
					if ($contador > 0) {
							$postulacion = $row['id'];
							$contador = $contador - 1;
							$sql2 = "SELECT * FROM viajes WHERE idv = '$row[idv]' AND activo = 'no' AND fecha < '$hoy'";
							$result2 = $conn->query($sql2);
							$rows2 = $result2->fetchAll();
							foreach ($rows2 as $row2) {
								$destino = $row2['destino'];
								$costo = $row2['costo'];
								$idviaje = $row2['idv'];
								$fecha = $row2['fecha'];
								
							}
							$sql3 = "SELECT * FROM usuarios WHERE email = '$row[idpo]'";
							$result3 = $conn->query($sql3);
							$rows3 = $result3->fetchAll();
							foreach ($rows3 as $row3) {
								$copiloto = $row3['nombre'];
								$idc = $row3['idu'];
							} ?>
							<tr>
							<td align="center"><?php echo $idviaje; ?></a></td>
							<td align="center"><?php echo $destino; ?></a></td>
							<?php
								$newDate = date("d/m/Y", strtotime($fecha));
							?>
							<td align="center"><?php echo $newDate; ?></a></td>
							<td align="center">$<?php echo $costo; ?></td>
							<td align="center"><?php echo $copiloto; ?></td>
							<td align="center">
								<p><form action="puntuarco.php" method="post">
									<input type="hidden" name="bi" id="bi" value=" <?php echo $idc; ?>"/>
									<input type="hidden" name="bp" id="bp" value=" <?php echo $postulacion; ?>"/>
									<input type="submit" value="Click aca"/>
								</form></p></td>
							<td align="center">
								<p><form action="puntuarco.php" method="post">
									<input type="hidden" name="mi" id="mi" value=" <?php echo $idc; ?>"/>
									<input type="hidden" name="mp" id="mp" value=" <?php echo $postulacion; ?>"/>
									<input type="submit" value="Click aca"/>
								</form></p></td>
							<td align="center">
								<p><form action="puntuarco.php" method="post">
									<input type="hidden" name="np" id="np" value=" <?php echo $postulacion; ?>"/>
									<input type="submit" value="Click aca"/>
								</form></p></td>
						</tr>
					<?php } }?>	
						</table>
					
					
					<?php
				}
		
		
		
		} ?>
		
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>