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
		
		<p><h1>Historial de viajes</p></h1>
		<?php
			require_once 'conexionobject.php';
			$result;
	
	
			$conn = dbConnect();
			$sql = "SELECT * FROM viajes WHERE id = '$_SESSION[email]' ORDER BY activo DESC, fecha ASC";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
		?>

		<p><table border="3" WIDTH="100%" > </p>
		<thead>
			<tr>
				<th>ID</th>
				<th>Destino</th>
				<th>Tipo</th>
				<th>Fecha</th>
				<th>Activo</th>
				<th>Modificar</th>
				<th>Eliminar</th>
				<th>Informacion</th>
			</tr>
		</thead>
		<?php
			foreach ($rows as $row) {
				if ($row['cola'] <> 'sec' AND $row['cola'] <> 'don') {
		?>
			<tr>
				<td align="center"><?php echo $row['idv']; ?></a></td>
				<td align="center"><?php echo $row['destino']; ?></a></td>
				<td align="center"><?php echo $row['tipo']; ?></td>
				<?php
				$newDate = date("d/m/Y", strtotime($row['fecha']));
				?>
				<td align="center"><?php echo $newDate; ?></a></td>
				<td align="center"><?php echo $row['activo']; ?></td>
				<?php
				if ($row['activo'] == 'si') { ?>
				<td align="center">
				<p><form action="modvi.php" method="post">
					<input type="hidden" name="modvi" id="modvi" value=" <?php echo $row['idv']; ?>"/>
					<input type="submit" value="Click aca"/>
				</form></p></td>
				<?php }
				else { ?>
					<td align="center">No permitido</td> <?php
				}
				?>
				<?php
				if ($row['activo'] == 'si') { ?>
				<td align="center">
				<p><form action="delvi.php" method="post" onclick="return confirm('Estas seguro que deseas eliminar el viaje?')">
					<input type="hidden" name="delvi" id="delvi" value=" <?php echo $row['idv']; ?>"/>
					<input type="submit" value="Click aca"/>
				</form></p></td>
				<?php }
				else { ?>
					<td align="center">No permitido</td> <?php
				}
				?>
				<td align="center">
								<p><form action="viaje.php" method="post">
									<input type="hidden" name="iduser" id="iduser" value="<?php echo $row['id']; ?>"/>
									<input type="hidden" name="idviaje" id="idviaje" value="<?php echo $row['idv']; ?>"/>
									<input type="submit" value="Click aca"/>
								</form></p></td>
			</tr>
		
			<?php }} ?>
		</table>
		
		<p><h1>Historial de postulaciones</p></h1>
		<p><table border="3" WIDTH="100%" > </p>
		<thead>
			<tr>
				<th>Destino</th>
				<th>Tipo</th>
				<th>Costo</th>
				<th>Estado</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<?php
			
			$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
			foreach ($rows as $row) {
				$id = $row['idu'];
			}
			$sql = "SELECT * FROM postulaciones WHERE idu = '$id'";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
			foreach ($rows as $row) {
				$sql = "SELECT * FROM viajes WHERE idv = '$row[idv]'";
				$result = $conn->query($sql);
				$raws = $result->fetchAll();
				foreach ($raws as $raw) {
					if ($raw['cola'] <> 'sec' AND $raw['cola'] <> 'don'){	?>
					<tr>
					<td align="center"><?php echo $raw['destino']; ?></a></td>
					<td align="center"><?php echo $raw['tipo']; ?></td>
					<td align="center">$<?php echo $raw['costo']; ?></td>
					<td align="center"><?php echo $row['estado']; ?></td>
					<?php
					if (!($row['estado'] == 'rechazado') AND ($raw['activo'] == 'si')) { ?>
						<td align="center">
						<p><form action="elp.php" method="post" onclick="return confirm('Estas seguro que deseas eliminar la postulacion?')">
							<input type="hidden" name="elp" id="elp" value=" <?php echo $row['id']; ?>"/>
							<input type="submit" value="Click aca"/>
						</form></p></td>
					<?php }
					else { ?>
						<td align="center">No se puede realizar la accion</td> <?php
					}
					?>
						
					</tr>
					<?php 
				}
				}
			
			} ?>
		</table>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>