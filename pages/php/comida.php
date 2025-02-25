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
            window.location.href = "../ui/selectComida.php";
        </script>';
        exit();
    }

    // Verificar que exista el control
    $sql = "SELECT * FROM control_glucosa WHERE fecha = ? AND id_usu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $fecha, $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "<script>alert('No existe un control de glucosa para esa fecha'); window.location.href = '../ui/selectComida.php';</script> ";
        exit();
    }

    // Verificar que no exista la comida
    $sql = "SELECT * FROM comida WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fecha, $tipo_comida, $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Ya existe una comida con esa fecha y tipo'); window.location.href = '../ui/selectComida.php';</script> ";
        exit();
    }


    // Crear la consulta
    $stmt = $conn->prepare("INSERT INTO comida (fecha, tipo_comida, gl_1h, gl_2h, raciones, insulina, id_usu) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssi", $fecha, $tipo_comida, $gl_1h, $gl_2h, $raciones, $insulina, $usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: ../ui/selectComida.php", true, 301); // Redirección permanente
        exit();
    } else {
        echo "<p>Error al crear la comida</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='../ui/crearComida.php'>Volver a intentarlo</a>";
    }
?>