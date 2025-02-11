<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
<?php
// Datos de conexión
$servidor = "localhost:3307";
$usuario = "root";
$password = "";
$db = "diabetes";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// Recibir los datos
$usuario = $_POST["usuario"];
$password = $_POST["password"];

// Crear la consulta
$stmt = $conn->prepare("SELECT * FROM usuario WHERE usuario = ? AND contra = ?");
$stmt->bind_param("ss", $usuario, $password);

// Ejecutar la consulta
$stmt->execute();

// Verificar si se encontró un usuario
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    header("Location: ../pages/control.html", true, 301); // Redirección permanente
    exit();

} else {
    echo "<p>Usuario o contraseña incorrectos</p> <br> <a href='../index.html'>Volver al inicio</a> <a href='formLogin.html'>Volver a intentarlo</a></body>
</html>";
}
?>

