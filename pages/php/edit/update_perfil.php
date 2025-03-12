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
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$usuario = $_POST["usuario"];
$id_usu = $_SESSION["usuario"];

// Verificar que la fecha no sea superior a hoy
$fecha_actual = date("Y-m-d");
if ($fecha_nacimiento > $fecha_actual) {
    echo '<script>
        alert("La fecha de nacimiento no puede ser superior a la fecha actual");
        window.location.href = "../../ui/perfil.php";
    </script>';
    exit();
}

// Crear la consulta
$stmt = $conn->prepare("UPDATE usuario SET nombre = ?, apellidos = ?, fecha_nacimiento = ?, usuario = ? WHERE id_usu = ?");
$stmt->bind_param("ssssi", $nombre, $apellidos, $fecha_nacimiento, $usuario, $id_usu);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "<script>alert('Perfil actualizado correctamente'); window.location.href = '../../ui/perfil.php';</script>";
    exit();
} else {
    echo "<p>Error al actualizar el perfil</p> <br> <a href='../../../index.html'>Volver al inicio</a> <a href='../../ui/editarPerfil.php'>Volver a intentarlo</a>";
}
?>