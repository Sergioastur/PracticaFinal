<?php session_start(); ?>
<?php
require_once "../../../connection/conexion.php";


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
        window.location.href = "../../ui/selectControl.php";
    </script>';
    exit();
}


// Actualizar la consulta
$stmt = $conn->prepare("UPDATE control_glucosa SET deporte = ?, lenta = ? WHERE fecha = ? AND id_usu = ?");
$stmt->bind_param("sssi", $deporte, $lenta, $fecha, $usuario);

// Ejecutar la consulta
if ($stmt->execute()) {
    header("Location: ../../ui/selectControl.php", true, 301); // Redirección permanente
    exit();
} else {
    echo "<p>Error al actualizar el control</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='../ui/editControl.php'>Volver a intentarlo</a>";
}

?>