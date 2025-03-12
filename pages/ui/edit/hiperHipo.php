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
    $usuario = $_SESSION["usuario"];


    // Buscar en la tipo hiperglucemia
    $sql_hiper = "SELECT * FROM hiperglucemia WHERE tipo_comida = ? AND fecha = ?";
    $stmt_hiper = $conn->prepare($sql_hiper);
    $stmt_hiper->bind_param("ss", $tipo_comida, $fecha);
    $stmt_hiper->execute();
    $result_hiper = $stmt_hiper->get_result();

    // Buscar en la tipo hipoglucemia
    $sql_hipo = "SELECT * FROM hipoglucemia WHERE tipo_comida = ? AND fecha = ?";
    $stmt_hipo = $conn->prepare($sql_hipo);
    $stmt_hipo->bind_param("ss", $tipo_comida, $fecha);
    $stmt_hipo->execute();
    $result_hipo = $stmt_hipo->get_result();

    if ($result_hiper->num_rows > 0) {
        $registro = $result_hiper->fetch_assoc();
        $tipo = 'hiperglucemia';
    } elseif ($result_hipo->num_rows > 0) {
        $registro = $result_hipo->fetch_assoc();
        $tipo = 'hipoglucemia';
    } else {
        echo "<script>alert('No existe una hiper/hipoglucemia en la fecha elegida'); window.location.href = '../selectHiperHipo.php';</script> ";
        exit();
    }


    //guardar los datos en variables
    $glucosa = $registro["glucosa"];
    $hora = $registro["hora"];
    if ($tipo == 'hiperglucemia') {
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
    <title>Editar <?php echo $tipo;?></title>
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
    <?php include '../../interface/sidebar.php'; ?>
        
        <!-- Fin Sidebar -->
        <div class="flex-grow-1 d-flex justify-content-center align-items-center formulario">
            
            <form action="../../php/edit/update_<?php echo $tipo;?>.php" method="POST" class="p-4 border rounded shadow bg-white" style="width: 50%;">
            <h1>Editar <?php echo $tipo;?></h1>
                <div class="mb-3">
                    <label for="glucosa" class="form-label">Glucosa:</label>
                    <input type="number" name="glucosa" id="glucosa" class="form-control" value="<?php echo $glucosa;?>" min="0" max="100" required>
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora:</label>
                    <input type="time" name="hora" id="hora" class="form-control" value="<?php echo $hora;?>" required>
                </div>
                <div class="mb-3">
                    <label for="correccion" class="form-label">Correción:</label>
                    <input type="number" name="correccion" id="correccion" min="0" max="100" class="form-control" value="<?php echo $correcion;?>" <?php if($tipo == 'hiperglucemia'){echo "required";}else{echo "disabled";}?>>
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