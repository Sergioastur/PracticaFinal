<?php
session_start();
require_once "../../connection/conexion.php";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// Recibir los datos
$fecha = $_POST["fecha"];
$deporte = $_POST["deporte"];
$lenta = $_POST["lenta"];
$usuario = $_SESSION["usuario"];

// Verificar que la fecha no sea superior a hoy
$fecha_actual = date("Y-m-d");
if ($fecha > $fecha_actual) {
    echo '<script>
        alert("La fecha no puede ser superior a la fecha actual");
        window.location.href = "../ui/selectControl.php";
    </script>';
    exit();
}

// Verificar si el usuario ya tiene un control en esa fecha
$sql = "SELECT * FROM control_glucosa WHERE fecha = ? AND id_usu = ?";
$stmt_check = $conn->prepare($sql);
$stmt_check->bind_param("si", $fecha, $usuario);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    echo '<script>
        alert("Ya existe un control en la misma fecha");
        window.location.href = "../ui/selectControl.php";
    </script>';
    exit();
}


// Crear la consulta
$stmt = $conn->prepare("INSERT INTO control_glucosa (fecha, deporte, lenta, id_usu) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $fecha, $deporte, $lenta, $usuario);

// Ejecutar la consulta
if ($stmt->execute()) {
    header("Location: ../ui/selectControl.php", true, 301); // Redirección permanente
    exit();
} else {
    echo "<p>Error al crear el control</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='../ui/crearControl.php'>Volver a intentarlo</a>";
}

?>