<?php

$email = $_POST['email'];
$pw = $_POST['pw'];
$conf = 'si';

include_once('conexion.php');


$result = mysqli_query($conexion,"SELECT * from $us_tb where email='" . $email . "'");

if($row = mysqli_fetch_array($result)){
	if($row['pw'] == $pw and $row['activo'] == $conf){
		session_start();
		$_SESSION['email'] = $email;
		header("Location: success.php");
	}
	else{
		header("Location: error.php");
		exit();
	}
}
else{
header("Location: error.php");
exit();
}	

?>