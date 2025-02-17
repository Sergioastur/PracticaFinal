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
$tipo_comida = $_POST["tipo_comida"];
$usuario = $_SESSION["usuario"];


// Crear la consulta
$stmt = $conn->prepare("DELETE FROM comida WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?");
$stmt->bind_param("ssi", $fecha, $tipo_comida, $usuario);

// Ejecutar la consulta
if ($stmt->execute()) {
    header("Location: ../../ui/selectComida.php", true, 301); // Redirección permanente
    exit();
} else {
    echo "<p>Error al eliminar la comida</p> <br> <a href='../../../index.html'>Volver al inicio</a> <a href='../../ui/editarComida.php'>Volver a intentarlo</a>";
}

?>