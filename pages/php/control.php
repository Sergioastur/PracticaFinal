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

// Crear la consulta
$stmt = $conn->prepare("INSERT INTO control (fecha, deporte, lenta, id_usuario) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $fecha, $deporte, $lenta, $usuario);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "<p>Control creado correctamente</p> <br> <a href='../../index.html'>Volver al inicio</a>";
} else {
    echo "<p>Error al crear el control</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='../ui/crearControl.php'>Volver a intentarlo</a>";
}

?>