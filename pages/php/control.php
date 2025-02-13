<?php
session_start();
// Datos de conexión
$servidor = "localhost:3306";
$usuario = "root";
$password = "";
$db = "diabetes";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

//TODO: usuario convertir a id
// Recibir los datos
$fecha = $_POST["fecha"];
$deporte = $_POST["deporte"];
$lenta = $_POST["lenta"];
$usuario = $_SESSION["usuario"];


?>