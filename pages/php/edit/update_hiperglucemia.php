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
    $glucosa = $_POST["glucosa"];
    $hora = $_POST["hora"];
    $correccion = $_POST["correccion"];
    $tipo_comida = $_POST["tipo_comida"];
    $usuario = $_SESSION["usuario"];


    // Crear la consulta
    $stmt = $conn->prepare("UPDATE hiperglucemia SET glucosa = ?, hora = ?, correccion = ? WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?");
    $stmt->bind_param("sssssi", $glucosa, $hora, $correccion, $fecha, $tipo_comida, $usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: ../../ui/selectHiperHipo.php", true, 301); // Redirección permanente
        exit();
    } else {
        echo "<p>Error al actualizar la hiper</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='../ui/editarHiperHipo.php'>Volver a intentarlo</a>";
    }


    
?>