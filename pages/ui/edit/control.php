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
$stmt = $conn->prepare("SELECT * FROM control_glucosa WHERE fecha = ?");

$stmt->bind_param("s", $fecha);


// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();

// Obtener los resultados
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Glucosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Sidebar</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="../index.html" class="nav-link text-white" aria-current="page">
                        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="../selectControl.html" class="nav-link active">
                        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                        Control
                    </a>
                </li>
                <li>
                    <a href="../selectComida.html" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                        Comida
                    </a>
                </li>
                <li>
                    <a href="../selectHiperHipo.html" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                        Hiper/Hipoglucemia
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>mdo</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
        <!-- Fin Sidebar -->
    <div class="flex-grow-1 p-3">
        <h1>Editar de control de glucosa</h1>
        <form action="../../php/edit/control.php" method="post">
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