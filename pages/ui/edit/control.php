<?php session_start(); ?>
<?php 
require_once "../../../connection/conexion.php";
// Recibir los datos
$fecha = $_POST["fecha"];

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear la consulta
$stmt = $conn->prepare("SELECT * FROM control_glucosa WHERE fecha = ? AND id_usu = ?");
$stmt->bind_param("si", $fecha, $_SESSION["usuario"]);



// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();

// Obtener los resultados
$row = $result->fetch_assoc();

// Verificar si existe el control
if ($result->num_rows == 0) {
    echo '<script>
        alert("No existe un control en la fecha elegida");
        window.location.href = "../selectControl.php";
    </script>';
    exit();
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Glucosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .sidebar {
            height: 100vh;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <!-- TODO: Icono perfil, links, iconos -->
    <div class="d-flex">
    <?php include '../../interface/sidebar.php'; ?>
        <!-- Fin Sidebar -->
    <div class="flex-grow-1 d-flex justify-content-center align-items-center formulario">
        
        <form action="../../php/edit/control.php" method="post" class="p-4 border rounded shadow bg-white" style="width: 50%;">
        <h1>Editar de control de glucosa</h1>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $row['fecha'];?>" readonly>
            </div>
            <div class="mb-3">
                <label for="deporte" class="form-label">Nivel de actividad:</label>
                <select class="form-select" id="deporte" name="deporte">
                    <option value="1" <?php if($row['deporte'] == 1) echo "selected"; ?>>1 - Actividad mínima</option>
                    <option value="2" <?php if($row['deporte'] == 2) echo "selected"; ?>>2 - Actividad baja</option>
                    <option value="3" <?php if($row['deporte'] == 3) echo "selected"; ?>>3 - Actividad media</option>
                    <option value="4" <?php if($row['deporte'] == 4) echo "selected"; ?>>4 - Actividad alta</option>
                    <option value="5" <?php if($row['deporte'] == 5) echo "selected"; ?>>5 - Actividad máxima</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="lenta" class="form-label">Insulina lenta:</label>
                <input type="number" name="lenta" id="lenta" class="form-control" value="<?php echo $row['lenta'];?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>
</body>

</html>