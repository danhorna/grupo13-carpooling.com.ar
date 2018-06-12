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
		<p><table border="3" WIDTH="100%" > </p>
		<thead>
			<tr>
				<th>ID</th>
				<th>Destino</th>
				<th>Tipo</th>
				<th>Fecha</th>
				<th>Activo</th>
				<th>Finalizar</th>
				<th>Simular falta de calificacion</th>
				<th>Informacion</th>
				
			</tr>
		</thead>
		<?php
		require_once 'conexionobject.php';
		$result;
		$conn = dbConnect();
		$sql = "SELECT * FROM viajes WHERE cola <> 'sec' AND cola <> 'don'";
		$result = $conn->query($sql);
		$rows = $result->fetchAll();
		foreach ($rows as $row) {
			?>
			<tr>
				<td align="center"><?php echo $row['idv']; ?></a></td>
				<td align="center"><?php echo $row['destino']; ?></a></td>
				<td align="center"><?php echo $row['tipo']; ?></a></td>
				<?php
								$newDate = date("d/m/Y", strtotime($row['fecha']));
							?>
							<td align="center"><?php echo $newDate; ?></a></td>
				<td align="center"><?php echo $row['activo']; ?></a></td>
				<td align="center">
								<p><form action="finalizar.php" method="post">
									<input type="hidden" name="lazo" id="lazo" value="<?php echo $row['lazo']; ?>"/>
									<input type="hidden" name="tipoidv" id="tipoidv" value="<?php echo $row['tipo']; ?>"/>
									<input type="hidden" name="finidv" id="finidv" value="<?php echo $row['idv']; ?>"/>
									<input type="submit" value="Click aca"/>
								</form></p></td>
				<td align="center">
								<p><form action="dias.php" method="post">
									<input type="hidden" name="simul" id="simul" value="<?php echo $row['idv']; ?>"/>
									<input type="submit" value="Simular"/>
								</form></p></td>
				<td align="center">
								<p><form action="viaje.php" method="post">
									<input type="hidden" name="idviaje" id="idviaje" value="<?php echo $row['idv']; ?>"/>
									<input type="submit" value="Click aca"/>
								</form></p></td>
			</tr>
			<?php
			
			
		}
		
		
		
		
		
		
		
		
		
		?>
		</table>
		
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	</div>
	
 </body>
</html>