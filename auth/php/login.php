<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
<?php
require_once "../../connection/conexion.php";

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
$stmt = $conn->prepare("SELECT id_usu, contra FROM usuario WHERE usuario = ?");
$stmt->bind_param("s", $usuario);

// Ejecutar la consulta
$stmt->execute();

// Vincular las variables de resultado
$stmt->bind_result($id, $hash);


// Verificar si se encontró un usuario
if ($stmt->fetch() && password_verify($password, $hash)) {
    session_start();
    $_SESSION["name"] = $usuario;
    // Cambiar el usuario a id
    $_SESSION["usuario"] = $id;
    header("Location: ../../pages/ui/index.php", true, 301); // Redirección permanente
    exit();

} else {
    echo "<p>Usuario o contraseña incorrectos</p> <br> <a href='../index.html'>Volver al inicio</a> <a href='formLogin.html'>Volver a intentarlo</a></body>
</html>";
}



/* // Verificar si se encontró un usuario
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    session_start();
    
    // Cambiar el usuario a id
    $row = $result->fetch_assoc();
    $_SESSION["usuario"] = $row["id_usu"];
    header("Location: ../../pages/ui/index.html", true, 301); // Redirección permanente
    exit();

} else {
    echo "<p>Usuario o contraseña incorrectos</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='formLogin.html'>Volver a intentarlo</a></body>
</html>";
} */
?>