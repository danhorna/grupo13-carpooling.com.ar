<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	
	
	$modvi = $_POST['modvi'];
	$sql = "SELECT * FROM postulaciones WHERE idv = '$modvi' AND (estado='aceptado' OR estado='espera')";
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
		if(empty($rows)) {
			$sql = "SELECT * FROM viajes WHERE idv = '$modvi'";
	
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
			foreach ($rows as $row) {
				$origen = $row['origen'];
				$destino = $row['destino'];
				$duracion = $row['duracion'];
				$hora = $row['hora'];
				$costo = $row['costo'];
				$tipo = $row['tipo'];
				$auto = $row['auto'];
				$id = $row['idv'];
				$lazo = $row['lazo'];
			}
			?>
			
			<form action="modviok.php" method="post" onsubmit="return validacion()">
			
			<?php 
				include_once('conexion.php');
				
				$result = mysqli_query($conexion,"SELECT * from $ve_tb where idu='$_SESSION[email]'");
			?> 
				<p><h4>Auto: <select name="opcion" id="opcion"> 
				<?php   while($row = mysqli_fetch_array($result))   { ?>
							<option value = <?php echo $row["id"]; if ($auto == $row['id']) { ?>
									selected
							<?php } ?>><?php echo $row["modelo"]; ?></option> 
			<?php 		} ?>   
				</select> </h4></p>
				
			
			
			<p><h4>Origen: <input type="text" name="origen" id="origen" value = "<?php echo $origen ?>"/></h4></p>
			<p><h4>Destino: <input type="text" name="destino" id="destino" value = "<?php echo $destino ?>"/></h4></p>
			<p><h4>Hora: <input type="time" name="hora" id="hora" value="<?php echo $hora ?>" min="00:01"/></h4></p>
			<p><h4>Duracion del viaje(min): <input type="number" name="duracion" id="duracion" min="1" value = "<?php echo $duracion ?>"/></h4></p>
			<p><h4>Costo($): <input type="number" name="costo" id="costo" min="1" value = "<?php echo $costo ?>"/></h4></p>
			<input type="hidden" name="idv" id="idv" value=" <?php echo $id; ?>"/>
			<input type="hidden" name="viajetipo" id="viajetipo" value=" <?php echo $tipo; ?>"/>
			<input type="hidden" name="viajelazo" id="viajelazo" value=" <?php echo $lazo; ?>"/>
			<p><input type="submit" value="Actualizar viaje"/></p>
			</form>
			
			
			
			
			
				<?php 
			
			
		}
		else {?>
			<p><h1>No se puede modificar el viaje ya que tiene postulantes!</p></h1>
			<p><h2><a href="check.php?">Historial</p></h2>
			<?php
		}
		
		
		
		?>
	
		
	
	
	
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
 </body>
</html>