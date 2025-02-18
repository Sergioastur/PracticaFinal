<?php
require_once "../../../connection/conexion.php";
session_start();

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// Recibir los datos
$fecha = $_POST["fecha"];

// Crear la consulta
$stmt = $conn->prepare("DELETE FROM control_glucosa WHERE fecha = ? AND id_usu = ?");
$stmt->bind_param("si", $fecha, $_SESSION['usuario']);

// Ejecutar la consulta
if ($stmt->execute()) {
    header("Location: ../../ui/selectControl.php", true, 301); // Redirección permanente
    exit();
} else {
    echo "<p>Error al eliminar el control</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='../ui/deleteControl.php'>Volver a intentarlo</a>";
}

?>