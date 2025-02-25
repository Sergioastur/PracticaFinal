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
    $glucosa = $_POST["glucosa"];
    $hora = $_POST["hora"];
    $tipo_comida = $_POST["tipo_comida"];
    $usuario = $_SESSION["usuario"];

    // Verificar que la fecha no sea superior a hoy
    $fecha_actual = date("Y-m-d");
    if ($fecha > $fecha_actual) {
        echo '<script>
            alert("La fecha no puede ser superior a la fecha actual");
            window.location.href = "../../ui/selectHiperHipo.php";
        </script>';
        exit();
    }


    // Crear la consulta
    $stmt = $conn->prepare("UPDATE hipoglucemia SET glucosa = ?, hora = ? WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?");
    $stmt->bind_param("ssssi", $glucosa, $hora, $fecha, $tipo_comida, $usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: ../../ui/selectHiperHipo.php", true, 301); // Redirección permanente
        exit();
    } else {
        echo "<p>Error al actualizar la hiper</p> <br> <a href='../../index.html'>Volver al inicio</a> <a href='../ui/editarHiperHipo.php'>Volver a intentarlo</a>";
    }


    
?>