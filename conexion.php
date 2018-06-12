<?php

$vi_tb = 'viajes';
$us_tb = 'usuarios';
$ve_tb = 'vehiculos';
$host = 'localhost';
$database = 'carpooling2';
$username = 'root';
$password = '';


$conexion = new mysqli ($host, $username, $password, $database);
if (!$conexion) {
    die('Error al conectarse a mysql: ' . mysql_error());
}
?>