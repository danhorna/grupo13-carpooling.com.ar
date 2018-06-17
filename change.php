
<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['email'])){
header("location: login.php");
}
$nombre_img = $_FILES['imagen']['name'];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];
 
if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 200000)) 
{
   if (($_FILES["imagen"]["type"] == "image/gif")
   || ($_FILES["imagen"]["type"] == "image/jpeg")
   || ($_FILES["imagen"]["type"] == "image/jpg")
   || ($_FILES["imagen"]["type"] == "image/png"))
   {
      $directorio = $_SERVER['DOCUMENT_ROOT'].'/test/img/'; 										/////////CHANGE
	  
	  $ran = rand(1,300);
      move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$ran.$nombre_img);
    } 
    else 
    {
       echo "No se puede subir una imagen con ese formato ";
    }
} 
else 
{
   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
}

	require_once 'conexionobject.php';
	$result;
	$conn = dbConnect();
	
	$sql = "SELECT * FROM usuarios WHERE email = '$_SESSION[email]'";
	
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	
	foreach ($rows as $row) {
		$ruta = $row['foto'];
	}
	
	if ($ruta <> 'default.jpg') {
	unlink($directorio.$ruta);
	}
	
	$sql = "UPDATE usuarios SET foto = '$ran$nombre_img' WHERE email = '$_SESSION[email]'";
	
	$conn->query($sql);

?>


<html>
 <head>
 <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
 <link href="fonts/default.css" rel="stylesheet" type="text/css" media="all" />
 <link href="fonts/fonts.css" rel="stylesheet" type="text/css" media="all" />
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
		<p><h1>Foto actualizada!</p></h1>
	</div>
	</div>
	
	<div id="copyright" class="container">
	<p>&copy; Carpooling. All rights reserved. |  Design by Grupo 13.</p>
	<p><a href="contacto.php">Contacto</a> |  <a href="help.php">Ayuda</a></p>
	</div>
	
 </body>
</html>