<?php
	require_once 'conexionobject.php';
	$nice = "no";
	$conn = dbConnect();
	$sql = "SELECT * FROM viajes ORDER BY activo DESC, fecha ASC, lazo ASC";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();

	foreach ($rows as $row) {
		echo $row['idv'];
		?> <p></p>
		<?php
		
	}


?>
