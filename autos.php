<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	
	
	$user = $_SESSION['email'];
	$sql = "SELECT * FROM vehiculos WHERE idu = '$user'";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
?>

<html>
 <head>
 <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
 <link href="fonts/default.css" rel="stylesheet" type="text/css" media="all" />
 <title>Carpooling</title>
 <script type="text/javascript" src="functions/functionsreg.js"></script>
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
		if(empty($rows)) { ?>
		<p><h1>No posee vehiculos registrados!</p></h1>
		<?php
			}
			else {
				?>
		<p><table border="3" WIDTH="100%" > </p>
		<thead>
			<tr>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Asientos disponibles</th>
				<th>Modificar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		
		<?php
			
			foreach ($rows as $row) {
		?>
			<tr>
				<td align="center"><?php echo $row['marca']; ?></a></td>
				<td align="center"><?php echo $row['modelo']; ?></td>
				<td align="center"><?php echo $row['asientos']; ?></td>
				<td align="center">
				<p><form action="modv.php" method="post">
					<input type="hidden" name="modv" id="modv" value=" <?php echo $row['id']; ?>"/>
					<input type="submit" value="Click aca"/>
				</form></p></td>
				<td align="center">
				<p><form action="deletev.php" method="post" onclick="return confirm('Estas seguro que deseas eliminar el vehiculo?')">
					<input type="hidden" name="delv" id="delv" value=" <?php echo $row['id']; ?>"/>
					<input type="submit" value="Click aca"/>
				</form></p>
				
				</td>
			</tr>
		
			<?php }} ?>
		</table>
		
		<p><input type="button" value="Alta de vehiculo" onclick="window.location.href='alta.php'" /></p>
		
		
			
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>