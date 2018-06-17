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
		
		<p><h1>Postulados a mis viajes</p></h1>
		<?php
			require_once 'conexionobject.php';
			$result;
	
	
			$conn = dbConnect();
			$sql = "SELECT * FROM postulaciones WHERE iduv = '$_SESSION[email]' AND estado = 'espera'";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
		?>
		<p><table border="3" WIDTH="100%" > </p>
		<thead>
			<tr>
				<th>Destino</th>
				<th>Tipo</th>
				<th>Postulante</th>
				<th>Aprobar</th>
				<th>Declinar</th>
			</tr>
		</thead>
		<?php
			$entra = 'n';
			foreach ($rows as $row) {
				$entra = 's';
				$lazo = $row['lazo'];
				$cola = $row['cola'];
				$sql2 = "SELECT * FROM viajes WHERE idv = '$row[idv]'";
				$result2 = $conn->query($sql2);
				$rows2 = $result2->fetchAll();
				foreach ($rows2 as $row2) {
					$des = $row2['destino'];
					$tipo = $row2['tipo'];
					$asientos = $row2['asientos'];
				}
				if ($cola <> 'sec') {
				$sql3 = "SELECT * FROM usuarios WHERE idu = '$row[idu]'";
				$result3 = $conn->query($sql3);
				$rows3 = $result3->fetchAll();
				foreach ($rows3 as $row3) {
					$idu = $row3['idu'];
					$nom = $row3['nombre'];
				}
		?>
		<tr>
			<td align="center"><?php echo $des; ?></a></td>
			<td align="center"><?php echo $tipo; ?></td>
			<td align="center"><?php echo $nom; ?></td>
			<td align="center">
				<p><form action="lista.php" method="post">
					<input type="hidden" name="lazo" id="lazo" value="<?php echo $lazo; ?>"/>
					<input type="hidden" name="lista" id="lista" value="<?php echo $row['id'];?>"/>
					<input type="hidden" name="tipov" id="tipov" value="<?php echo $tipo; ?>"/>
					<?php
					if ($asientos == 0) { ?>
						Viaje lleno
						<?php
					}
					else { ?>
					<input type="submit" value="Click aca"/> <?php } ?>
				</form></p></td>
			<td align="center">
				<p><form action="listd.php" method="post" onclick="return confirm('Estas seguro que deseas rechazar al postulante?')">
					<input type="hidden" name="listd" id="listd" value=" <?php echo $row['id']; ?>"/>
					<?php
					if ($asientos == 0) { ?>
						Viaje lleno
						<?php
					}
					else { ?>
					<input type="submit" value="Click aca"/><?php } ?>
				</form></p></td>
		</tr>
			<?php }} 
		
		?>
		</table>
		<?php  
			if ($entra == 'n') { ?>
				<p><h3><font color="red">No hay postulaciones en tus viajes</font></p></h3> <?php
			}
		
		?>
		
		<p><h1>Postulaciones aceptadas</p></h1>
		
		<?php
			require_once 'conexionobject.php';
			$result;
	
	
			$conn = dbConnect();
			$sql = "SELECT * FROM postulaciones WHERE iduv = '$_SESSION[email]' AND estado = 'aceptado'";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
		?>
		<p><table border="3" WIDTH="100%" > </p>
		<thead>
			<tr>
				<th>Destino</th>
				<th>Tipo</th>
				<th>Postulante</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<?php
			foreach ($rows as $row) {
				if ($row['cola'] <> 'sec' AND $row['cola'] <> 'don') {
				$sql2 = "SELECT * FROM viajes WHERE idv = '$row[idv]'";
				$result2 = $conn->query($sql2);
				$rows2 = $result2->fetchAll();
				foreach ($rows2 as $row2) {
					$des = $row2['destino'];
					$tipo = $row2['tipo'];
					$est = $row2['activo'];
				}
				$sql3 = "SELECT * FROM usuarios WHERE idu = '$row[idu]'";
				$result3 = $conn->query($sql3);
				$rows3 = $result3->fetchAll();
				foreach ($rows3 as $row3) {
					$idu = $row3['idu'];
					$nom = $row3['nombre'];
				}
		?>
		<tr>
			<td align="center"><?php echo $des; ?></a></td>
			<td align="center"><?php echo $tipo; ?></td>
			<td align="center"><?php echo $nom; ?></td>
			<?php
				if ($est == 'si') { ?>
			<td align="center">
				<p><form action="listdd.php" method="post">
					<input type="hidden" name="listdd" id="listd" value=" <?php echo $row['id']; ?>"/>
					<input type="submit" value="Click aca"/>
				</form></p></td> <?php }
				else { ?>
					<td align="center">Viaje finalizado</td> <?php
				}
				?>
		</tr>
		<?php }} ?>
		</table>
		
		</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
 </body>
</html>
		
		
		
		
		
		
		
		
		