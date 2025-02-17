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
$tipo_comida = $_POST["tipo_comida"];



// Crear la consulta
$stmt = $conn->prepare("SELECT * FROM comida WHERE fecha = ? AND tipo_comida = ?");
$stmt->bind_param("ss", $fecha, $tipo_comida);


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
        <h1>Editar Comida</h1>
        <form action="../../php/edit/updateComida.php" method="post">
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
                        <input type="number" name="gl_1h" id="gl_1h" class="form-control" value="<?php echo $row['gl_1h']?>" required>
                    </div>
                    <div class="col">
                        <label for="gl_2h" class="form-label">Glucosa 1h después:</label>
                        <input type="number" name="gl_2h" id="gl_2h" class="form-control" value="<?php echo $row['gl_2h']?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="raciones" class="form-label">Raciones:</label>
                    <input type="number" name="raciones" id="raciones" class="form-control" value="<?php echo $row['raciones']?>" required>
                </div>
                <div class="mb-3">
                    <label for="insulina" class="form-label">Insulina:</label>
                    <input type="number" name="insulina" id="insulina" class="form-control" value="<?php echo $row['insulina']?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Editar comida</button>
        </form>
    </div>
</body>

</html>