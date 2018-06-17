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
 <script type="text/javascript" src="functions/newfunc.js"></script>
 <script type="text/javascript" src="functions/jquery.js"></script>
 <script type="text/javascript" src="functions/jquery3.js"></script>
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
		$sql2 = "SELECT * FROM vehiculos WHERE idu = '$_SESSION[email]'";
		$result2 = $conn->query($sql2);
		$rows2 = $result2->fetchAll();
		foreach ($rows2 as $row2) {
			$puede2 = 'si';
		}

		if ($puede == 'si' AND $puede2 == 'si') { ?>
	
		<p><h2>Complete los datos para la creacion del viaje</h2></p>
		
			<form action="index.php" method="post">
			Tipo de viaje: 
				<select id="status" name="status" onChange="mostrar(this.value);">
				<option value="Seleccione">Seleccione...</option>
				<option value="Ocasional">Ocasional</option>
				<option value="Semanal">Semanal</option>
				<option value="Diario">Diario</option>
				</select>
			</form>
			
			<div id="Ocasional" class="element" style="display: none;">
			<h3>Creando viaje ocasional:</h3>
			<form action="nicela.php" method="post" onsubmit="return validacion()">
			
			<?php 
				include_once('conexion.php');
				
				$result = mysqli_query($conexion,"SELECT * from $ve_tb where idu='$_SESSION[email]'");
			?> 
				<p><h4>Auto: <select name="opcion" id="opcion"> 
				<?php   while($row = mysqli_fetch_array($result))   { ?>
							<option value = <?php echo $row["id"]; ?>><?php echo $row["modelo"]; ?></option> 
			<?php 		} ?>   
				</select> 
							
							</h4></p>
				
			
			<input type="hidden" name="tipo" id="tipo" value="Ocasional"/>
			<p><h4>Origen: <input type="text" name="origen" id="origen"/></h4></p>
			<p><h4>Destino: <input type="text" name="destino" id="destino"/></h4></p>
			<p><h4>Fecha: <input type="date" name="fecha" id="fecha" min="<?php $hoyq=date("Y-m-d"); echo $hoyq;?>" max="<?php $hoym=strtotime ( '+1 month' , strtotime ( $hoyq ) ) ; $hoym = date('Y-m-d' , $hoym ); echo $hoym; ?>" value="<?php echo $hoyq ?>"/></h4></p>
			<p><h4>Hora: <input type="time" name="hora" id="hora" value="00:00" min="00:01"/></h4></p>
			<p><h4>Duracion del viaje(min): <input type="number" name="duracion" id="duracion" min="1"/></h4></p>
			<p><h4>Costo($): <input type="number" name="costo" id="costo" min="1"/></h4></p>
			<p><input type="submit" value="Registrar viaje"/></p>
			</form>
			<p><h6><font color="red">Nota: Se creara un unico viaje en el dia seleccionado. </font></h6></p>
			</div>
			
			<div id="Semanal" class="element" style="display: none;">
			<h3>Creando viaje semanal:</h3>
			<form action="nicela.php" method="post" >
			
			<?php 
				include_once('conexion.php');
				
				$result = mysqli_query($conexion,"SELECT * from $ve_tb where idu='$_SESSION[email]'");
			?> 
				<p><h4>Auto: <select name="opcion" id="opcion"> 
				<?php   while($row = mysqli_fetch_array($result))   { ?>
							<option value = <?php echo $row["id"]; ?>><?php echo $row["modelo"]; ?></option> 
			<?php 		} ?>   
				</select> 
							
							</h4></p>
				
			
			<input type="hidden" name="tipo" id="tipo" value="Semanal"/>
			<p><h4>Origen: <input type="text" name="origen" id="origen"/></h4></p>
			<p><h4>Destino: <input type="text" name="destino" id="destino"/></h4></p>
			<p><h4>Fecha: <input type="date" name="fecha" id="fecha" min="<?php $hoyq=date("Y-m-d"); echo $hoyq;?>" max="<?php $hoym=strtotime ( '+1 month' , strtotime ( $hoyq ) ) ; $hoym = date('Y-m-d' , $hoym ); echo $hoym; ?>" value="<?php echo $hoyq ?>"/></h4></p>
			<p><h4>Hora: <input type="time" name="hora" id="hora" value="00:00" min="00:01"/></h4></p>
			<p><h4>Duracion del viaje(min): <input type="number" name="duracion" id="duracion" min="1"/></h4></p>
			<p><h4>Costo($): <input type="number" name="costo" id="costo" min="1"/></h4></p>
			<p><input type="submit" value="Registrar viaje"/></p>
			</form>
			<p><h6><font color="red">Nota: Se crearan viajes durante 31 dias, comenzando desde hoy. </font></h6></p>
			</div>
			
			<div id="Diario" class="element" style="display: none;">
			<h3>Creando viaje diario:</h3>
			<form action="nicela.php" method="post" >
			
			<?php 
				include_once('conexion.php');
				
				$result = mysqli_query($conexion,"SELECT * from $ve_tb where idu='$_SESSION[email]'");
			?> 
				<p><h4>Auto: <select name="opcion" id="opcion"> 
				<?php   while($row = mysqli_fetch_array($result))   { ?>
							<option value = <?php echo $row["id"]; ?>><?php echo $row["modelo"]; ?></option> 
			<?php 		} ?>   
				</select> 
							
							</h4></p>
				
			
			<input type="hidden" name="tipo" id="tipo" value="Diario"/>
			<p><h4>Origen: <input type="text" name="origen" id="origen"/></h4></p>
			<p><h4>Destino: <input type="text" name="destino" id="destino"/></h4></p>
			<p><h4>Hora: <input type="time" name="hora" id="hora" value="00:00" min="00:01"/></h4></p>
			<p><h4>Duracion del viaje(min): <input type="number" name="duracion" id="duracion" min="1"/></h4></p>
			<p><h4>Costo($): <input type="number" name="costo" id="costo" min="1"/></h4></p>
			<p><h4>Dias:</h4></p>
			<input type="checkbox" name="Monday" value="1">L 
			<input type="checkbox" name="Tuesday" value="1">M 
			<input type="checkbox" name="Wednesday" value="1">M 
			<input type="checkbox" name="Thursday" value="1">J 
			<input type="checkbox" name="Friday" value="1">V 
			<input type="checkbox" name="Saturday" value="1">S 
			<input type="checkbox" name="Sunday" value="1">D
			<p><h4>Seleccionar comienzo: </h4></p>
			<p><h4><input type="date" name="fecha" id="fecha" min="<?php $hoyq=date("Y-m-d"); echo $hoyq;?>" max="<?php $hoym=strtotime ( '+1 month' , strtotime ( $hoyq ) ) ; $hoym = date('Y-m-d' , $hoym ); echo $hoym; ?>" value="<?php echo $hoyq ?>"/></h4></p>
			<p><input type="submit" value="Registrar viaje"/></p>
			</form>
			<p><h6><font color="red">Nota: Se crearan viajes durante 31 dias, comenzando desde hoy. </font></h6></p>
			</div>
		<?php
		}
		else { 
			if ($puede == 'no') {?>
			<p><h1>No puedes crear el viaje ya que tenes calificaciones pendientes mayores a 30 dias!</p></h1>
			<p><h2><a href="main.php?">Calificar</p></h2>
			<?php
			}
			else { ?>
					<p><h1>No puedes crear el viaje ya que debes tener por lo menos un auto registrado</p></h1>
				<p><h2><a href="autos.php?">Mis autos</p></h2>
			<?php
			}
		}		?>
			
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
 </body>
</html>