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
    $usuario = $_SESSION["usuario"];


    // Buscar en la tabla hiperglucemia
    $sql_hiper = "SELECT * FROM hiperglucemia WHERE tipo_comida = ? AND fecha = ?";
    $stmt_hiper = $conn->prepare($sql_hiper);
    $stmt_hiper->bind_param("ss", $tipo_comida, $fecha);
    $stmt_hiper->execute();
    $result_hiper = $stmt_hiper->get_result();

    // Buscar en la tabla hipoglucemia
    $sql_hipo = "SELECT * FROM hipoglucemia WHERE tipo_comida = ? AND fecha = ?";
    $stmt_hipo = $conn->prepare($sql_hipo);
    $stmt_hipo->bind_param("ss", $tipo_comida, $fecha);
    $stmt_hipo->execute();
    $result_hipo = $stmt_hipo->get_result();

    if ($result_hiper->num_rows > 0) {
        $registro = $result_hiper->fetch_assoc();
        $tabla = 'hiperglucemia';
    } elseif ($result_hipo->num_rows > 0) {
        $registro = $result_hipo->fetch_assoc();
        $tabla = 'hipoglucemia';
    } else {
        header("Location: ../selectHiperHipo.html", true, 301); // Redirección permanente
        exit();
    }


    //guardar los datos en variables
    $glucosa = $registro["glucosa"];
    $hora = $registro["hora"];
    if ($tabla == 'hiperglucemia') {
        $correcion = $registro["correccion"];
    } 
    else {
        $correcion = 0;
    }
    $fecha = $registro["fecha"];
    $tipo_comida = $registro["tipo_comida"];
    $usuario = $registro["id_usu"];


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?php echo $tabla;?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Sidebar</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="index.html" class="nav-link text-white" aria-current="page">
                        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="../selectControl.html" class="nav-link text-white">
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
                    <a href="../selectHiperHipo.html" class="nav-link active">
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
            <h1>Editar <?php echo $tabla;?></h1>
            <form action="../../php/edit/update_<?php echo $tabla;?>.php" method="POST">
                <div class="mb-3">
                    <label for="glucosa" class="form-label">Glucosa:</label>
                    <input type="number" name="glucosa" id="glucosa" class="form-control" value="<?php echo $glucosa;?>" required>
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora:</label>
                    <input type="time" name="hora" id="hora" class="form-control" value="<?php echo $hora;?>" required>
                </div>
                <div class="mb-3">
                    <label for="correccion" class="form-label">Correción:</label>
                    <input type="number" name="correccion" id="correccion" class="form-control" value="<?php echo $correcion;?>" <?php if($tabla == 'hiperglucemia'){echo "required";}else{echo "disabled";}?>>
                </div>
                <div class="mb-3">
                    <label for="tipo_comida" class="form-label">Tipo de comida:</label>
                    <select name="tipo_comida" id="tipo_comida" class="form-select" required>
                        <option value="desayuno" <?php if($tipo_comida == 'desayuno'){echo "selected";}else{echo "disabled";} ?>>Desayuno</option>
                        <option value="comida" <?php if($tipo_comida == 'comida'){echo "selected";}else{echo "disabled";} ?>>Comida</option>
                        <option value="merienda" <?php if($tipo_comida == 'merienda'){echo "selected";}else{echo "disabled";} ?>>Merienda</option>
                        <option value="cena" <?php if($tipo_comida == 'cena'){echo "selected";}else{echo "disabled";} ?>>Cena</option>
                        <option value="aperitivo" <?php if($tipo_comida == 'aperitivo'){echo "selected";}else{echo "disabled";} ?>>Aperitivo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $fecha; ?>" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Editar</button>
                
            </form>
        </div>
</body>
</html>