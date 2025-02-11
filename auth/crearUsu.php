<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$usuario = $_POST["usuario"];

$password = $_POST["password"];
$password2 = $_POST["password2"];

// Verificar que las contraseñas coinciden
if ($password != $password2) {
    echo "<p>Las contraseñas no coinciden</p>";
    
} else {

    // Crear la consulta
    $stmt = $conn->prepare("INSERT INTO usuario (nombre, apellidos, fecha_nacimiento, usuario, contra) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $apellidos, $fecha_nacimiento, $usuario, $password);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<p>Usuario creado correctamente</p> <br> <a href='../index.html'>Volver al inicio</a>";
    } else {
        echo "<p>Error al crear el usuario el usuario ya existe</p> <br> <a href='../index.html'>Volver al inicio</a> <a href='formCrearUsu.php'>Volver a intentarlo</a>";
    }
}


?>

</body>
</html>