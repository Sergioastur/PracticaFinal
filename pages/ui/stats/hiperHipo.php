
<?php
if (!isset($_SESSION)) {
    session_start();
}
include(__DIR__ . '/../../../connection/conexion.php');
$id_usu= $_SESSION["usuario"];

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $month = $_POST['month'];
    $year = $_POST['year'];
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
} else {
    $month = date('m');
    $year = date('Y');
}

// Numero de hiperglucemias
$sql = "SELECT COUNT(*) AS total_hiperglucemias 
FROM hiperglucemia 
WHERE MONTH(fecha) = ? AND YEAR(fecha) = ? AND id_usu = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $month, $year, $id_usu);
$stmt->execute();
$result_hiper = $stmt->get_result();

// Obtener el total como entero
$row = $result_hiper->fetch_assoc();
$total_hiperglucemias = (int)$row['total_hiperglucemias'];


// Numer de hipoglucemis
$sql = "SELECT COUNT(*) AS total_hipoglucemias 
        FROM hipoglucemia 
        WHERE MONTH(fecha) = ? AND YEAR(fecha) = ? AND id_usu = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $month, $year, $id_usu);
$stmt->execute();
$result_hipo = $stmt->get_result();

// Obtener el total como entero
$row = $result_hipo->fetch_assoc();
$total_hipoglucemias = (int)$row['total_hipoglucemias'];


$data = [
    'Hiperglucemia' => $total_hiperglucemias,
    'Hipoglucemial' => $total_hipoglucemias
];

// Convertir los datos a formato JSON
$labels = json_encode(array_keys($data));
$values = json_encode(array_values($data));


?>
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
<?php

?>
<div class="row justify-content-center"><canvas id="myChart" width="400" height="400"></canvas></div>

<script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo $labels; ?>,
                datasets: [{
                    label: 'Nº de casos',
                    data: <?php echo $values; ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 
                        'rgba(54, 162, 235, 0.2)'  
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Distribución de Casos'
                    }
                }
            }
        });
    </script>
