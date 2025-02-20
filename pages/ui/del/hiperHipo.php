<?php
session_start();
require_once "../../../connection/conexion.php";

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

 // Buscar en la tabla hiperglucemia
 $sql_hiper = "SELECT * FROM hiperglucemia WHERE tipo_comida = ? AND fecha = ? AND id_usu = ?";
 $stmt_hiper = $conn->prepare($sql_hiper);
 $stmt_hiper->bind_param("ssi", $tipo_comida, $fecha, $usuario);
 $stmt_hiper->execute();
 $result_hiper = $stmt_hiper->get_result();

 // Buscar en la tabla hipoglucemia
 $sql_hipo = "SELECT * FROM hipoglucemia WHERE tipo_comida = ? AND fecha = ? AND id_usu = ?";
 $stmt_hipo = $conn->prepare($sql_hipo);
 $stmt_hipo->bind_param("ssi", $tipo_comida, $fecha, $usuario);
 $stmt_hipo->execute();
 $result_hipo = $stmt_hipo->get_result();


if ($result_hiper->num_rows > 0) {
    $registro = $result_hiper->fetch_assoc();
    $tabla = 'hiperglucemia';
} elseif ($result_hipo->num_rows > 0) {
    $registro = $result_hipo->fetch_assoc();
    $tabla = 'hipoglucemia';
} else {
    header("Location: ../selectHiperHipo.php", true, 301); // Redirección permanente
    exit();
}

// Crear la consulta
$stmt = $conn->prepare("DELETE FROM $tabla WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?");
$stmt->bind_param("ssi", $fecha, $tipo_comida, $usuario);

// Ejecutar la consulta
$stmt->execute();


// Redirigir a la página de inicio
header("Location: ../selectHiperHipo.php", true, 301); // Redirección permanente

?>