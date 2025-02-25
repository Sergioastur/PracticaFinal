<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    
</head>
<body>
    


<?php
ob_start();
require_once "../../connection/conexion.php";

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

// Comprobar que no hay usuarios repetidos

$check_stmt = $conn->prepare("SELECT usuario FROM usuario WHERE usuario = ?");
$check_stmt->bind_param("s", $usuario);
$check_stmt->execute();
$check_stmt->store_result();

//Verificar que la fecha no sea superior a hoy
$fecha_actual = date("Y-m-d");
if ($fecha_nacimiento > $fecha_actual) {
    echo '<script>
        alert("La fecha de nacimiento no puede ser superior a la fecha actual");
        window.location.href = "../../index.html";
    </script>';
    exit();
}

// Verificar que las contraseñas coinciden
if ($password != $password2) {
    echo "<p>Las contraseñas no coinciden</p>";
    
} else if ($check_stmt->num_rows > 0) {
    echo '<script>
        alert("El usuario ya existe");
        window.location.href = "../../index.html";
    </script>';
    exit();
}
 else {
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Crear la consulta
    $stmt = $conn->prepare("INSERT INTO usuario (nombre, apellidos, fecha_nacimiento, usuario, contra) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $apellidos, $fecha_nacimiento, $usuario, $password);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>
            alert('Usuario creado correctamente');
            window.location.href = '../../index.html';
            </script>";
    } else {
        echo "<p>Error al crear el usuario</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='../ui/formCrearUsu.html'>Volver a intentarlo</a>";
    }
}

ob_end_flush();
?>

</body>
</html>