<?php
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
function comparador($nuevahora, $horacomp, $comp) {
    $dateFrom = DateTime::createFromFormat('!H:i', $nuevahora);
    $dateTo = DateTime::createFromFormat('!H:i', $horacomp);
    $dateInput = DateTime::createFromFormat('!H:i', $comp);
    if ($dateFrom > $dateTo) $dateTo->modify('+1 day');
    return ($dateFrom <= $dateInput && $dateInput <= $dateTo) || ($dateFrom <= $dateInput->modify('+1 day') && $dateInput <= $dateTo);
}
?>

<html>
 <head>
 <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
 <link href="fonts/default.css" rel="stylesheet" type="text/css" media="all" />
 <title>Carpooling registro</title>
 <script type="text/javascript" src="functions/functions.js"></script>
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
	$user = $_SESSION['email'];
	$entra = 'No';
	require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	
	if ($_POST['tipo'] == 'Ocasional') {
	
	$sql = "SELECT * FROM viajes WHERE id = '$user' AND activo = 'si' AND fecha = '$_POST[fecha]'" ;
	
	$result = $conn->query($sql);

	$rows = $result->fetchAll();
	foreach ($rows as $row) {
		$hora = $row['hora'];
		$nuevahora = substr($hora, 0, -3);
		$sumar = $row['duracion'] * 60;
		$horacomp=date("H:i",strtotime($nuevahora)+$sumar);
		$comp = $_POST['hora'];
		
		if ($entra == 'No') {
			$entra = (comparador($nuevahora, $horacomp, $comp) ? 'Si' : 'No');
		}
	}
		
	if ($entra == 'Si') {
		echo "<br />"."<p><h1>" . "Ya tiene un viaje registrado para esa hora.". "</h1></p>" . "<br />";
		echo "<h2>" ."<a href='create.php'>Por favor use otro horario</a>" . "</h2>";
	}
	
	else{
		
		
		$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		foreach ($rows as $row) {
				$asientos = $row['asientos'];
		}
		$query = "INSERT INTO viajes (auto, origen, destino, hora, duracion, tipo, costo, id, activo, asientos, fecha)
			      VALUES ('$_POST[opcion]', '$_POST[origen]', '$_POST[destino]', '$_POST[hora]', '$_POST[duracion]', '$_POST[tipo]', 
				  '$_POST[costo]', '$user', 'si', '$asientos', '$_POST[fecha]')";
				  
		if ($conn->query($query) == TRUE) {
			
			$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
	
			foreach ($rows as $row) {
				$row['viajes'] = $row['viajes'] + 1;
				$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$_POST[opcion]'";
				$conn->query($query);
			}
			
			
			echo "<br />" . "<p><h1>" . "Viaje registrado exitosamente!" . "</h1></p>";
			echo "<h2>" . "<a href='main.php'>Inicio</a>" . "</h2>";
			
		}
		else {
			echo "Error al registrar el viaje." . $query . "<br>" ; 
		}
	}
	
	}
	
	if ($_POST['tipo'] == 'Semanal') {
		$error = 'false';
		$hoy = date("Y-m-d");
		$comienzo = $_POST['fecha'];
		$dias = 31;
		while (($dias > '0') AND ($error <> 'true')) {
			while (($hoy <> $comienzo) AND ($hoy < $comienzo)) {
				$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
				$hoy = date('Y-m-d' , $hoy );
				$dias = $dias - 1;
			}
			
			$sql = "SELECT * FROM viajes WHERE id = '$user' AND activo = 'si' AND fecha = '$hoy'" ;
			$result = $conn->query($sql);
			$rows = $result->fetchAll();
			foreach ($rows as $row) {
				$hora = $row['hora'];
				$nuevahora = substr($hora, 0, -3);
				$sumar = $row['duracion'] * 60;
				$horacomp=date("H:i",strtotime($nuevahora)+$sumar);
				$comp = $_POST['hora'];
		
				if ($entra == 'No') {
					$entra = (comparador($nuevahora, $horacomp, $comp) ? 'Si' : 'No');
				}
			}
			
			if ($entra == 'Si') {
				$error = 'true';
			}
			$hoy = strtotime ( '+7 day' , strtotime ( $hoy ) ) ;
			$hoy = date('Y-m-d' , $hoy );
			$dias = $dias - 7;
		}
		
		
		
		if ($error <> 'true') {
			$hoy = date("Y-m-d");
			$comienzo = date($_POST['fecha']);
			$dias = 31;
			$random = rand(1,3000);
			$dato = $_POST['duracion'].$random;
			$primer = 'pri';
			while ($dias > '0') {
				while (($hoy <> $comienzo) AND ($hoy < $comienzo)) {
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
				}
				
				$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
				$result = $conn->query($sql);
				$rows = $result->fetchAll();
				foreach ($rows as $row) {
					$asientos = $row['asientos'];
				}
				$query = "INSERT INTO viajes (auto, origen, destino, hora, duracion, tipo, costo, id, activo, asientos, fecha, lazo, cola)
			      VALUES ('$_POST[opcion]', '$_POST[origen]', '$_POST[destino]', '$_POST[hora]', '$_POST[duracion]', '$_POST[tipo]', 
				  '$_POST[costo]', '$user', 'si', '$asientos', '$hoy', '$dato', '$primer')";
				  
				if ($conn->query($query) == TRUE) {
					
					$primer = 'sec';
			
					$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
	
					foreach ($rows as $row) {
						$row['viajes'] = $row['viajes'] + 1;
						$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$_POST[opcion]'";
						$conn->query($query);
					}
				
				
				}
				$hoy = strtotime ( '+7 day' , strtotime ( $hoy ) ) ;
				$hoy = date('Y-m-d' , $hoy );
				$dias = $dias - 7;
			}
			echo "<br />" . "<p><h1>" . "Viaje registrado exitosamente!" . "</h1></p>";
			echo "<h2>" . "<a href='check.php'>Ver mis viajes</a>" . "</h2>";
		}
		else {
			echo "<br />"."<p><h1>" . "Ya tiene un viaje registrado para esa hora en al menos una semana.". "</h1></p>" . "<br />";
			echo "<h2>" ."<a href='create.php'>Por favor use otro horario</a>" . "</h2>";
		}
	}
	
	if ($_POST['tipo'] == 'Diario') {
		$error = 'false';
		$hoy = date("Y-m-d");
		$comienzo = $_POST['fecha'];
		$dias = 31;
		while (($dias > '0') AND ($error <> 'true')) {
			while (($hoy <> $comienzo) AND ($hoy < $comienzo)) {
				$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
				$hoy = date('Y-m-d' , $hoy );
				$dias = $dias - 1;
			}
			
			$dia = date("l", strtotime($hoy));
			if ((isset($_POST['Monday'])) AND ($_POST['Monday'] == '1') AND ($dia == 'Monday')) {
				$sql = "SELECT * FROM viajes WHERE id = '$user' AND activo = 'si' AND fecha = '$hoy'" ;
				$result = $conn->query($sql);
				$rows = $result->fetchAll();
				foreach ($rows as $row) {
					$hora = $row['hora'];
					$nuevahora = substr($hora, 0, -3);
					$sumar = $row['duracion'] * 60;
					$horacomp=date("H:i",strtotime($nuevahora)+$sumar);
					$comp = $_POST['hora'];
					if ($entra == 'No') {
						$entra = (comparador($nuevahora, $horacomp, $comp) ? 'Si' : 'No');
					}
				}
				if ($entra == 'Si') {
					$error = 'true';
				}
				$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
				$hoy = date('Y-m-d' , $hoy );
				$dias = $dias - 1;
			}
			
			else {
				
				if (isset($_POST['Tuesday']) AND ($_POST['Tuesday'] == '1') AND ($dia == 'Tuesday')) {
					$sql = "SELECT * FROM viajes WHERE id = '$user' AND activo = 'si' AND fecha = '$hoy'" ;
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$hora = $row['hora'];
						$nuevahora = substr($hora, 0, -3);
						$sumar = $row['duracion'] * 60;
						$horacomp=date("H:i",strtotime($nuevahora)+$sumar);
						$comp = $_POST['hora'];
						if ($entra == 'No') {
							$entra = (comparador($nuevahora, $horacomp, $comp) ? 'Si' : 'No');
						}
					}
					if ($entra == 'Si') {
						$error = 'true';
					}
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
					echo '1';
				}
				else {
					if (isset($_POST['Wednesday']) AND ($_POST['Wednesday'] == '1') AND ($dia == 'Wednesday')) {
					$sql = "SELECT * FROM viajes WHERE id = '$user' AND activo = 'si' AND fecha = '$hoy'" ;
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$hora = $row['hora'];
						$nuevahora = substr($hora, 0, -3);
						$sumar = $row['duracion'] * 60;
						$horacomp=date("H:i",strtotime($nuevahora)+$sumar);
						$comp = $_POST['hora'];
						if ($entra == 'No') {
							$entra = (comparador($nuevahora, $horacomp, $comp) ? 'Si' : 'No');
						}
					}
					if ($entra == 'Si') {
						$error = 'true';
					}
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
					}
					else {
						if (isset($_POST['Thursday']) AND ($_POST['Thursday'] == '1') AND ($dia == 'Thursday')) {
					$sql = "SELECT * FROM viajes WHERE id = '$user' AND activo = 'si' AND fecha = '$hoy'" ;
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$hora = $row['hora'];
						$nuevahora = substr($hora, 0, -3);
						$sumar = $row['duracion'] * 60;
						$horacomp=date("H:i",strtotime($nuevahora)+$sumar);
						$comp = $_POST['hora'];
						if ($entra == 'No') {
							$entra = (comparador($nuevahora, $horacomp, $comp) ? 'Si' : 'No');
						}
					}
					if ($entra == 'Si') {
						$error = 'true';
					}
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
						}
						else {
							if (isset($_POST['Friday']) AND ($_POST['Friday'] == '1') AND ($dia == 'Friday')) {
					$sql = "SELECT * FROM viajes WHERE id = '$user' AND activo = 'si' AND fecha = '$hoy'" ;
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$hora = $row['hora'];
						$nuevahora = substr($hora, 0, -3);
						$sumar = $row['duracion'] * 60;
						$horacomp=date("H:i",strtotime($nuevahora)+$sumar);
						$comp = $_POST['hora'];
						if ($entra == 'No') {
							$entra = (comparador($nuevahora, $horacomp, $comp) ? 'Si' : 'No');
						}
					}
					if ($entra == 'Si') {
						$error = 'true';
					}
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
							}
							else {
								if (isset($_POST['Saturday']) AND ($_POST['Saturday'] == '1') AND ($dia == 'Saturday')) {
					$sql = "SELECT * FROM viajes WHERE id = '$user' AND activo = 'si' AND fecha = '$hoy'" ;
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$hora = $row['hora'];
						$nuevahora = substr($hora, 0, -3);
						$sumar = $row['duracion'] * 60;
						$horacomp=date("H:i",strtotime($nuevahora)+$sumar);
						$comp = $_POST['hora'];
						if ($entra == 'No') {
							$entra = (comparador($nuevahora, $horacomp, $comp) ? 'Si' : 'No');
						}
					}
					if ($entra == 'Si') {
						$error = 'true';
					}
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
								}
								else {
									if (isset($_POST['Sunday']) AND ($_POST['Sunday'] == '1') AND ($dia == 'Sunday')) {
					$sql = "SELECT * FROM viajes WHERE id = '$user' AND activo = 'si' AND fecha = '$hoy'" ;
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$hora = $row['hora'];
						$nuevahora = substr($hora, 0, -3);
						$sumar = $row['duracion'] * 60;
						$horacomp=date("H:i",strtotime($nuevahora)+$sumar);
						$comp = $_POST['hora'];
						if ($entra == 'No') {
							$entra = (comparador($nuevahora, $horacomp, $comp) ? 'Si' : 'No');
						}
					}
					if ($entra == 'Si') {
						$error = 'true';
					}
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
									}
									else {
										$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
										$hoy = date('Y-m-d' , $hoy );
										$dias = $dias - 1;
									}
								}
							}
						}
					}
				}
			}
			
			
			
		}
		
		if ($error <> 'true') {
			$hoy = date("Y-m-d");
			$comienzo = date($_POST['fecha']);
			$dias = 31;
			$random = rand(1,3000);
			$dato = $_POST['duracion'].$random;
			$primer = 'pri';
			while ($dias > '0') {
				while (($hoy <> $comienzo) AND ($hoy < $comienzo)) {
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
				}
				
				$dia = date("l", strtotime($hoy));
				
				if (isset($_POST['Monday']) AND ($_POST['Monday'] == '1') AND ($dia == 'Monday')) {
					
					$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$asientos = $row['asientos'];
					}
					$query = "INSERT INTO viajes (auto, origen, destino, hora, duracion, tipo, costo, id, activo, asientos, fecha, lazo, cola)
					VALUES ('$_POST[opcion]', '$_POST[origen]', '$_POST[destino]', '$_POST[hora]', '$_POST[duracion]', '$_POST[tipo]', 
					'$_POST[costo]', '$user', 'si', '$asientos', '$hoy', '$dato', '$primer')";
					if ($conn->query($query) == TRUE) {
						$primer = 'sec';
						$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
						$result = $conn->query($sql);
						$rows = $result->fetchAll();
	
						foreach ($rows as $row) {
							$row['viajes'] = $row['viajes'] + 1;
							$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$_POST[opcion]'";
							$conn->query($query);
						}
				
				
					}
					
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
					
				}
				
				else {
					if (isset($_POST['Tuesday']) AND ($_POST['Tuesday'] == '1') AND ($dia == 'Tuesday')) {
					
					$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$asientos = $row['asientos'];
					}
					$query = "INSERT INTO viajes (auto, origen, destino, hora, duracion, tipo, costo, id, activo, asientos, fecha, lazo, cola)
					VALUES ('$_POST[opcion]', '$_POST[origen]', '$_POST[destino]', '$_POST[hora]', '$_POST[duracion]', '$_POST[tipo]', 
					'$_POST[costo]', '$user', 'si', '$asientos', '$hoy', '$dato', '$primer')";
				  
					if ($conn->query($query) == TRUE) {
						$primer = 'sec';
						$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
						$result = $conn->query($sql);
						$rows = $result->fetchAll();
	
						foreach ($rows as $row) {
							$row['viajes'] = $row['viajes'] + 1;
							$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$_POST[opcion]'";
							$conn->query($query);
						}
				
				
					}
					
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
					
					}
					else {
						if (isset($_POST['Wednesday']) AND ($_POST['Wednesday'] == '1') AND ($dia == 'Wednesday')) {
					
					$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$asientos = $row['asientos'];
					}
					$query = "INSERT INTO viajes (auto, origen, destino, hora, duracion, tipo, costo, id, activo, asientos, fecha, lazo, cola)
					VALUES ('$_POST[opcion]', '$_POST[origen]', '$_POST[destino]', '$_POST[hora]', '$_POST[duracion]', '$_POST[tipo]', 
					'$_POST[costo]', '$user', 'si', '$asientos', '$hoy', '$dato', '$primer')";
				  
					if ($conn->query($query) == TRUE) {
						$primer = 'sec';
						$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
						$result = $conn->query($sql);
						$rows = $result->fetchAll();
	
						foreach ($rows as $row) {
							$row['viajes'] = $row['viajes'] + 1;
							$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$_POST[opcion]'";
							$conn->query($query);
						}
				
				
					}
					
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
					
						}
						else {
							if (isset($_POST['Thursday']) AND ($_POST['Thursday'] == '1') AND ($dia == 'Thursday')) {
					
					$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$asientos = $row['asientos'];
					}
					$query = "INSERT INTO viajes (auto, origen, destino, hora, duracion, tipo, costo, id, activo, asientos, fecha, lazo, cola)
					VALUES ('$_POST[opcion]', '$_POST[origen]', '$_POST[destino]', '$_POST[hora]', '$_POST[duracion]', '$_POST[tipo]', 
					'$_POST[costo]', '$user', 'si', '$asientos', '$hoy', '$dato', '$primer')";
				  
					if ($conn->query($query) == TRUE) {
						$primer = 'sec';
						$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
						$result = $conn->query($sql);
						$rows = $result->fetchAll();
	
						foreach ($rows as $row) {
							$row['viajes'] = $row['viajes'] + 1;
							$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$_POST[opcion]'";
							$conn->query($query);
						}
				
				
					}
					
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
					
							}
							else {
								if (isset($_POST['Friday']) AND ($_POST['Friday'] == '1') AND ($dia == 'Friday')) {
					
					$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$asientos = $row['asientos'];
					}
					$query = "INSERT INTO viajes (auto, origen, destino, hora, duracion, tipo, costo, id, activo, asientos, fecha, lazo, cola)
					VALUES ('$_POST[opcion]', '$_POST[origen]', '$_POST[destino]', '$_POST[hora]', '$_POST[duracion]', '$_POST[tipo]', 
					'$_POST[costo]', '$user', 'si', '$asientos', '$hoy', '$dato', '$primer')";
				  
					if ($conn->query($query) == TRUE) {
						$primer = 'sec';
						$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
						$result = $conn->query($sql);
						$rows = $result->fetchAll();
	
						foreach ($rows as $row) {
							$row['viajes'] = $row['viajes'] + 1;
							$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$_POST[opcion]'";
							$conn->query($query);
						}
				
				
					}
					
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
					
								}
								else {
									if (isset($_POST['Saturday']) AND ($_POST['Saturday'] == '1') AND ($dia == 'Saturday')) {
					
					$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$asientos = $row['asientos'];
					}
					$query = "INSERT INTO viajes (auto, origen, destino, hora, duracion, tipo, costo, id, activo, asientos, fecha, lazo, cola)
					VALUES ('$_POST[opcion]', '$_POST[origen]', '$_POST[destino]', '$_POST[hora]', '$_POST[duracion]', '$_POST[tipo]', 
					'$_POST[costo]', '$user', 'si', '$asientos', '$hoy', '$dato', '$primer')";
				  
					if ($conn->query($query) == TRUE) {
						$primer = 'sec';
						$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
						$result = $conn->query($sql);
						$rows = $result->fetchAll();
	
						foreach ($rows as $row) {
							$row['viajes'] = $row['viajes'] + 1;
							$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$_POST[opcion]'";
							$conn->query($query);
						}
				
				
					}
					
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
					
									}
									else {
										if (isset($_POST['Sunday']) AND ($_POST['Sunday'] == '1') AND ($dia == 'Sunday')) {
					
					$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
					$result = $conn->query($sql);
					$rows = $result->fetchAll();
					foreach ($rows as $row) {
						$asientos = $row['asientos'];
					}
					$query = "INSERT INTO viajes (auto, origen, destino, hora, duracion, tipo, costo, id, activo, asientos, fecha, lazo, cola)
					VALUES ('$_POST[opcion]', '$_POST[origen]', '$_POST[destino]', '$_POST[hora]', '$_POST[duracion]', '$_POST[tipo]', 
					'$_POST[costo]', '$user', 'si', '$asientos', '$hoy', '$dato', '$primer')";
				  
					if ($conn->query($query) == TRUE) {
						$primer = 'sec';
						$sql = "SELECT * FROM vehiculos WHERE id = '$_POST[opcion]'";
						$result = $conn->query($sql);
						$rows = $result->fetchAll();
	
						foreach ($rows as $row) {
							$row['viajes'] = $row['viajes'] + 1;
							$query = "UPDATE vehiculos SET viajes = '$row[viajes]' WHERE id = '$_POST[opcion]'";
							$conn->query($query);
						}
				
				
					}
					
					$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
					
										}
										else {
											$hoy = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
					$hoy = date('Y-m-d' , $hoy );
					$dias = $dias - 1;
										}
									}
								}
							}
				
						}
					}
					
				}
			

			
			}
			echo "<br />" . "<p><h1>" . "Viaje registrado exitosamente!" . "</h1></p>";
			echo "<h2>" . "<a href='check.php'>Ver mis viajes</a>" . "</h2>";
			
			
			
			
		}
		else {
			echo "<br />"."<p><h1>" . "Ya tiene un viaje registrado para esa hora en al menos un dia seleccionado.". "</h1></p>" . "<br />";
			echo "<h2>" ."<a href='create.php'>Por favor use otro horario</a>" . "</h2>";
		}
		
	}
?>


	</div>
	</div>
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
 
 
 
 
 </body>
</html>









