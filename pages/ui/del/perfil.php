<?php session_start(); ?>
<?php
require_once "../../../connection/conexion.php";


// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Hacer la consulta
$stmt = $conn->prepare("DELETE FROM usuario WHERE id_usu = ?");
$stmt->bind_param("i", $_SESSION["usuario"]);

// Ejecutar la consulta
$stmt->execute();

// Cerrar la sesión
session_destroy();

// Redirigir a la página de inicio
header("Location: ../../../index.html", true, 301); // Redirección permanente

?>