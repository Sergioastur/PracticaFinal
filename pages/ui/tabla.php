<?php
session_start();
$_SESSION['pagina'] = "tabla";
include '../../connection/conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit;
}

// Conexion a la base de datos
$conn = new mysqli($servidor, $usuario, $password, $db);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario autenticado
$id_usu = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $month = $_POST['month'];
    $year = $_POST['year'];
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
} else {
    $month = date('m');
    $year = date('Y');
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla</title>
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
<div class="d-flex">
    <?php include '../interface/sidebar.php'; ?>
    <div class="flex-grow-1 p-3">
        <h1>Tabla</h1>
        <form method="post" class="mb-4">
    <div class="row justify-content-center">
        <div class="col-auto">
            <label for="month" class="form-label">Mes:</label>
            <select class="form-select" id="month" name="month">
                <?php
                $months = [
                    1 => 'Enero',
                    2 => 'Febrero',
                    3 => 'Marzo',
                    4 => 'Abril',
                    5 => 'Mayo',
                    6 => 'Junio',
                    7 => 'Julio',
                    8 => 'Agosto',
                    9 => 'Septiembre',
                    10 => 'Octubre',
                    11 => 'Noviembre',
                    12 => 'Diciembre'
                ];
                foreach ($months as $key => $value) {
                    if ($month == $key) {
                        echo "<option value='$key' selected>$value</option>";
                    } else {
                        echo "<option value='$key'>$value</option>";
                    }
                    
                }
                ?>
            </select>
        </div>
        <div class="col-auto">
            <label for="year" class="form-label">Año:</label>
            <input type="number" class="form-control" id="year" name="year" min="2023" max="<?php echo $year; ?>" value="<?php echo $year; ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mt-4">Ver Grafica</button>
        </div>
    </div>
</form>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th></th>
                    <th colspan="9">DESAYUNO</th>
                    <th colspan="9">COMIDA</th>
                    <th colspan="9">MERIENDA</th>
                    <th colspan="9">CENA</th>
                    <th colspan="9">APERITIVO</th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <?php for ($i = 0; $i < 5; $i++) echo "<th colspan='4'></th><th colspan='2'>HIPO</th><th colspan='3'>HIPER</th>"; ?>
                    <th></th>
                </tr>
                <tr>
                    <th>Dia</th>
                    <?php for ($i = 0; $i < 5; $i++) echo "<th>GL/1H</th><th>RAC.</th><th>INSU.</th><th>GL/2H</th><th>GLU.</th><th>HORA</th><th>GLU.</th><th>HORA.</th><th>CORR.</th>"; ?>
                    <th>LENTA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                /* if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $month = $_POST['month'];
                    $year = $_POST['year'];
                    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year); */
                    
                    for ($day = 1; $day <= $days; $day++) {
                        $fecha = "$year-$month-$day";
                        echo "<tr><td>$day</td>";
                        
                        foreach (['desayuno', 'comida', 'merienda', 'cena', 'aperitivo'] as $comida) {
                            $query = "SELECT * FROM comida WHERE id_usu = $id_usu AND fecha = '$fecha' AND tipo_comida = '$comida'";
                            $result = $conn->query($query);
                            $data = $result->fetch_assoc();
                            echo "<td>" . ($data['gl_1h'] ?? '') . "</td><td>" . ($data['raciones'] ?? '') . "</td><td>" . ($data['insulina'] ?? '') . "</td><td>" . ($data['gl_2h'] ?? '') . "</td>";
                            
                            $query_hipo = "SELECT * FROM hipoglucemia WHERE id_usu = $id_usu AND fecha = '$fecha' AND tipo_comida = '$comida'";
                            $result_hipo = $conn->query($query_hipo);
                            $data_hipo = $result_hipo->fetch_assoc();
                            echo "<td>" . ($data_hipo['glucosa'] ?? '') . "</td><td>" . ($data_hipo['hora'] ?? '') . "</td>";
                            
                            $query_hiper = "SELECT * FROM hiperglucemia WHERE id_usu = $id_usu AND fecha = '$fecha' AND tipo_comida = '$comida'";
                            $result_hiper = $conn->query($query_hiper);
                            $data_hiper = $result_hiper->fetch_assoc();
                            echo "<td>" . ($data_hiper['glucosa'] ?? '') . "</td><td>" . ($data_hiper['hora'] ?? '') . "</td><td>" . ($data_hiper['correccion'] ?? '') . "</td>";
                        }
                        
                        $query_lenta = "SELECT lenta FROM control_glucosa WHERE id_usu = $id_usu AND fecha = '$fecha'";
                        $result_lenta = $conn->query($query_lenta);
                        echo "<td>" . ($result_lenta->fetch_assoc()['lenta'] ?? '') . "</td></tr>";
                    }
                /* } */
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php $conn->close(); ?>
