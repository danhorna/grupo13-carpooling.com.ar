<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
require_once 'conexionobject.php';
$result;
$conn = dbConnect();
$puede = 'si';
$espiloto = 'no';
$escopiloto = 'no';
$sql = "SELECT * FROM postulaciones WHERE iduv = '$_SESSION[email]' OR idpo = '$_SESSION[email]'";
$result = $conn->query($sql);
$rows = $result->fetchAll();
function diff_dte($date1, $date2){
       if (!is_integer($date1)) $date1 = strtotime($date1);
       if (!is_integer($date2)) $date2 = strtotime($date2);  
       return floor(abs($date1 - $date2) / 60 / 60 / 24);
}  
foreach ($rows as $row) {
	if ($row['iduv'] == $_SESSION['email']) {
		$espiloto = 'si';
	}
	else{
		$escopiloto = 'si';
	}
	$calificado = $row['calificado'];
	$calificadoco = $row['calificadoco'];
	$sql2 = "SELECT * FROM viajes WHERE idv = '$row[idv]'";
	$result2 = $conn->query($sql2);
	$rows2 = $result2->fetchAll();
	foreach ($rows2 as $row2) {
		$fecha = $row2['fecha'];
		$hoy = date('Y-m-d');
		$dias = diff_dte($fecha,$hoy);
		if ($row2['activo'] == 'no') {
			if (($espiloto == 'si') AND ($calificadoco == 'no') AND ($dias > '30')) {
				$puede = 'no';
			}
			if (($escopiloto == 'si') AND ($calificado == 'no') AND ($dias > '30')){
				$puede = 'no';
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
 <script type="text/javascript" src="functions/search.js"></script>
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
		$puede2 = 'no';
		$sql2 = "SELECT * FROM tarjetas WHERE idu = '$_SESSION[email]'";
		$result2 = $conn->query($sql2);
		$rows2 = $result2->fetchAll();
		foreach ($rows2 as $row2) {
			$puede2 = 'si';
		}
	
	
		if ($puede == 'si' AND $puede2 == 'si') { ?>
		
		<p><table border="3" WIDTH="100%" cellpadding="10" > </p>
		<thead>
			<tr>	
				<th>ID</th>
				<th>Origen</th>
				<th>Destino</th>
				<th>Tipo</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Informacion</th>
			</tr>
		</thead>
		<?php
		
		$sql = "SELECT * FROM viajes WHERE activo = 'si' AND destino = '$_POST[destino]' AND tipo = '$_POST[tipo]' ORDER BY fecha ASC,hora ASC";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
			foreach ($rows as $row) {
				if ($row['cola'] <> 'sec') {
				if (!($row['id'] == $_SESSION['email'])) {
					$asi = $row['asientos'];
					$entra = 'si';
					$idv = $row['idv'];
					$sql2 = "SELECT * FROM postulaciones WHERE idv = '$idv' AND idpo = '$_SESSION[email]'";
					$result2 = $conn->query($sql2);
					$rows2 = $result2->fetchAll();
					foreach ($rows2 as $row2) {
						$entra = 'no';
					}
					
					
					
		?>
			<tr>
				<td align="center"><?php echo $row['idv']; ?></a></td>
				<td align="center"><?php echo $row['origen']; ?></a></td>
				
				<td align="center"><?php echo $row['destino']; ?></a></td>
				<td align="center"><?php echo $row['tipo']; ?></a></td>
				<?php
				$newDate = date("d/m/Y", strtotime($row['fecha']));
				if ($row['tipo'] == 'Semanal'){
				?>
				<td align="center">Desde: <?php echo $newDate; ?></a></td>
				<?php
				}
				else {
						if ($row['tipo'] == 'Ocasional') {?>
					<td align="center">Unico dia: <?php echo $newDate; ?> </a></td>
					<?php
						}
						else {?>
					<td align="center">Comienza: <?php echo $newDate; ?> </a></td>
					<?php
							
						}
				}
				$hora=substr($row['hora'], 0, -3);
				?>
				<td align="center"><?php echo $hora; ?></a></td>
				<?php
				if ($entra == 'no') { ?>
				<td align="center">
								<p><form action="viaje.php" method="post">
									<input type="hidden" name="iduser" id="iduser" value=" <?php echo $row['id']; ?>"/>
									<input type="hidden" name="idviaje" id="idviaje" value=" <?php echo $row['idv']; ?>"/>
									<input type="submit" style="color:red" value="Ya postulado"/>
									
								</form></p></td>
				<?php
				}
				else{ 
					if ($asi > '0') {?>
				<td align="center">
								<p><form action="viaje.php" method="post">
									<input type="hidden" name="iduser" id="iduser" value=" <?php echo $row['id']; ?>"/>
									<input type="hidden" name="idviaje" id="idviaje" value=" <?php echo $row['idv']; ?>"/>
									<input type="submit" value="Postularse"/>
								</form></p></td>
								<?php
					}
					else {
						?>
						<td align="center">El viaje esta lleno</td> <?php
					}
				} ?>
			</tr>
		
		<?php  }}}?>
		</table>
		
		<?php
		}
		else {
				if ($puede == 'no') {?>
			<p><h1>No puedes postularte ya que tenes calificaciones pendientes mayores a 30 dias!</p></h1>
			<p><h2><a href="main.php?">Calificar</p></h2>
			<?php
				}
				else { ?>
					<p><h1>Debes tener una tarjeta registrada para poder postularte</p></h1>
			<p><h2><a href="paid.php?">Mis tarjetas</p></h2>
					<?php
				}
		}?>
		
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
	
 </body>
</html>