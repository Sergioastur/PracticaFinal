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
$tipo_comida = $_POST["tipo_comida"];

// Verificar si existe la comida
$stmt = $conn->prepare("SELECT * FROM comida WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?");
$stmt->bind_param("ssi", $_POST["fecha"], $_POST["tipo_comida"], $_SESSION["usuario"]);
$stmt->execute();
$result = $stmt->get_result();

if (!($result->num_rows > 0)) {
    echo '<script>
        alert("No existe una comida en la fecha elegida");
        window.location.href = "../selectComida.php";
    </script>';
    exit();
}



// Crear la consulta
$stmt = $conn->prepare("SELECT * FROM comida WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?");
$stmt->bind_param("ssi", $fecha, $tipo_comida, $_SESSION["usuario"]);



// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Glucosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Sidebar -->
    <!-- TODO: Icono perfil, links, iconos -->
    <div class="d-flex">
    <?php include '../../interface/sidebar.php'; ?>
        <!-- Fin Sidebar -->
    <div class="flex-grow-1 d-flex justify-content-center align-items-center formulario">
        
        <form action="../../php/edit/updateComida.php" method="post" class="p-4 border rounded shadow bg-white" style="width: 50%;">
        <h1>Editar Comida</h1>
        <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $row["fecha"]; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="tipo_comida" class="form-label">Tipo de comida</label>
                <select class="form-select" id="tipo_comida" name="tipo_comida">
                <option value="desayuno" <?php if($row['tipo_comida'] == 'desayuno'){echo "selected";}else{echo "disabled";} ?>>Desayuno</option>
                        <option value="comida" <?php if($row['tipo_comida'] == 'comida'){echo "selected";}else{echo "disabled";} ?>>Comida</option>
                        <option value="merienda" <?php if($row['tipo_comida'] == 'merienda'){echo "selected";}else{echo "disabled";} ?>>Merienda</option>
                        <option value="cena" <?php if($row['tipo_comida'] == 'cena'){echo "selected";}else{echo "disabled";} ?>>Cena</option>
                        <option value="aperitivo" <?php if($row['tipo_comida'] == 'aperitivo'){echo "selected";}else{echo "disabled";} ?>>Aperitivo</option>
                </select>
            </div>
            <div class="mb-3 row row-cols-2">
                    <div class="col">
                        <label for="gl_1h" class="form-label">Glucosa 1h antes:</label>
                        <input type="number" name="gl_1h" id="gl_1h" class="form-control" value="<?php echo $row['gl_1h']?>" min="80" max="130" required>
                    </div>
                    <div class="col">
                        <label for="gl_2h" class="form-label">Glucosa 1h después:</label>
                        <input type="number" name="gl_2h" id="gl_2h" class="form-control" value="<?php echo $row['gl_2h']?>" min="80" max="130" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="raciones" class="form-label">Raciones:</label>
                    <input type="number" name="raciones" id="raciones" class="form-control" value="<?php echo $row['raciones']?>"  min="0" max="50" required>
                </div>
                <div class="mb-3">
                    <label for="insulina" class="form-label">Insulina:</label>
                    <input type="number" name="insulina" id="insulina" class="form-control" value="<?php echo $row['insulina']?>"  min="0" max="100" required>
                </div>
                <button type="submit" class="btn btn-primary">Editar comida</button>
        </form>
    </div>
</body>

</html>