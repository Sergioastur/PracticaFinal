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
$hora = $_POST["hora"];
$correcion = $_POST["correcion"];
$tipo_comida = $_POST["tipo_comida"];
$glucosa = $_POST["glucosa"];
$usuario = $_SESSION["usuario"];

// Verificar que la fecha no sea superior a hoy
$fecha_actual = date("Y-m-d");
if ($fecha > $fecha_actual) {
    echo '<script>
        alert("La fecha no puede ser superior a la fecha actual");
        window.location.href = "../ui/selectHiperHipo.php";
    </script>';
    exit();
}

// Verificar si no existe una hiper en la misma fecha y tipo de comida
$stmt_check_hiper = $conn->prepare("SELECT COUNT(*) as total FROM hiperglucemia WHERE fecha = ? AND tipo_comida = ?");
$stmt_check_hiper->bind_param("ss", $fecha, $tipo_comida);
$stmt_check_hiper->execute();
$result_hiper = $stmt_check_hiper->get_result();
$row_hiper = $result_hiper->fetch_assoc();

// Verificar si no exite una hipo en la misma fecha y tipo de comida
$stmt_check_hipo = $conn->prepare("SELECT COUNT(*) as total FROM hipoglucemia WHERE fecha = ? AND tipo_comida = ?");
$stmt_check_hipo->bind_param("ss", $fecha, $tipo_comida);
$stmt_check_hipo->execute();
$result_hipo = $stmt_check_hipo->get_result();
$row_hipo = $result_hipo->fetch_assoc();


if ($row_hipo["total"] > 0) {
    echo '<script>
        alert("Ya existe una hipo en la misma fecha y tipo de comida");
        window.location.href = "../ui/selectHiperHipo.php";
    </script>';
    exit();
} elseif ($row_hiper["total"] > 0) {
    echo '<script>
        alert("Ya existe una hiper en la misma fecha y tipo de comida");
        window.location.href = "../ui/selectHiperHipo.php";
    </script>';
    exit();
}


// Crear la consulta
$stmt = $conn->prepare("INSERT INTO hiperglucemia (fecha, hora, correccion, tipo_comida, glucosa, id_usu) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $fecha, $hora, $correcion, $tipo_comida, $glucosa, $usuario);
$query = "SELECT COUNT(*) as total FROM comida WHERE fecha = ? AND tipo_comida = ?";
$stmt_check = $conn->prepare($query);
$stmt_check->bind_param("ss", $fecha, $tipo_comida);
$stmt_check->execute();
$result = $stmt_check->get_result();
$row = $result->fetch_assoc();


if ($row["total"] == 0) {
    echo "<script>alert('No existe una comida con esa fecha y tipo'); window.location.href = '../ui/selectHiperHipo.php';</script> ";
    exit();
} else {
// Ejecutar la consulta

if ($stmt->execute()) {
    header("Location: ../ui/selectHiperHipo.php", true, 301); // Redirección permanente
    exit();
} else {
    echo "<p>Error al crear la hiper</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='../ui/crearHiper.php'>Volver a intentarlo</a>";
}

}

?>
