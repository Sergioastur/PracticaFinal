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

// Verificar que existe el control
$stmt = $conn->prepare("SELECT * FROM control_glucosa WHERE fecha = ? AND id_usu = ?");
$stmt->bind_param("si", $fecha, $_SESSION['usuario']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('No existe un control con esa fecha');
    window.location.href='../selectControl.php';
    </script>";
    exit();
}

// Crear la consulta
$stmt = $conn->prepare("DELETE FROM control_glucosa WHERE fecha = ? AND id_usu = ?");
$stmt->bind_param("si", $fecha, $_SESSION['usuario']);

// Ejecutar la consulta
if ($stmt->execute()) {
    header("Location: ../selectControl.php", true, 301); // Redirección permanente
    exit();
} else {
    echo "<p>Error al eliminar el control</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='../ui/deleteControl.php'>Volver a intentarlo</a>";
}

?>