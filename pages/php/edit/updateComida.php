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
$gl_1h = $_POST["gl_1h"];
$gl_2h = $_POST["gl_2h"];
$raciones = $_POST["raciones"];
$insulina = $_POST["insulina"];
$usuario = $_SESSION["usuario"];

// Verificar que la fecha no sea superior a hoy
$fecha_actual = date("Y-m-d");
if ($fecha > $fecha_actual) {
    echo '<script>
        alert("La fecha no puede ser superior a la fecha actual");
        window.location.href = "../../ui/selectComida.php";
    </script>';
    exit();
}


// Crear la consulta
$stmt = $conn->prepare("UPDATE comida SET gl_1h = ?, gl_2h = ?, raciones = ?, insulina = ? WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?");
$stmt->bind_param("ssssssi", $gl_1h, $gl_2h, $raciones, $insulina, $fecha, $tipo_comida, $usuario);

// Ejecutar la consulta
if ($stmt->execute()) {
    header("Location: ../../ui/selectComida.php", true, 301); // Redirección permanente
    exit();
} else {
    echo "<p>Error al actualizar la comida</p> <br> <a href='../../../index.html'>Volver al inicio</a> <a href='../../ui/editarComida.php'>Volver a intentarlo</a>";
}

?>