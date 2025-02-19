<?php
include(__DIR__ . '/../../../connection/conexion.php');
$id_usu = $_SESSION["usuario"];

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

// Consulta SQL
$sql = "SELECT 
            c.tipo_comida,
            SUM(c.raciones) AS total_raciones
        FROM 
            COMIDA c
        WHERE 
            c.id_usu = ? 
            AND MONTH(c.fecha) = ? 
            AND YEAR(c.fecha) = ? 
        GROUP BY 
            c.tipo_comida";

// Preparar la declaración
$stmt = $conn->prepare($sql);

// Vincular parámetros
$stmt->bind_param("iii", $id_usu, $month, $year);

// Ejecutar la declaración
$stmt->execute();

// Obtener resultados
$resultado = $stmt->get_result();

// Inicializar variables para almacenar la suma de raciones
$raciones_desayuno = 0;
$raciones_comida = 0;
$raciones_merienda = 0;
$raciones_cena = 0;
$raciones_aperitivo = 0;

// Verificar resultados
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        switch ($row['tipo_comida']) {
            case 'desayuno':
                $raciones_desayuno = $row['total_raciones'];
                break;
            case 'comida':
                $raciones_comida = $row['total_raciones'];
                break;
            case 'merienda':
                $raciones_merienda = $row['total_raciones'];
                break;
            case 'cena':
                $raciones_cena = $row['total_raciones'];
                break;
            case 'aperitivo':
                $raciones_aperitivo = $row['total_raciones'];
                break;
        }
    }
} else {
    echo "No se encontraron datos para el mes y año seleccionados.";
}

$data = [
    'Desayuno' => $raciones_desayuno,
    'Comida' => $raciones_comida,
    'Merienda' => $raciones_merienda,
    'Cena' => $raciones_cena,
    'Aperitivo' => $raciones_aperitivo
];

$labels = json_encode(array_keys($data));
$values = json_encode(array_values($data));


?>
<form id="fecha" method="post" class="mb-4">
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
            <input type="number" class="form-control" id="year" name="year" min="2023" max="2025" value="<?php echo $year; ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mt-4">Ver Grafica</button>
        </div>
    </div>
</form>
<div class="row justify-content-center"><canvas id="bar-Chart" width="400" height="400"></canvas></div>
<script>
    const ctx2 = document.getElementById('bar-Chart').getContext('2d');
    const miGrafica = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: <?php echo $labels; ?>,
            datasets: [{
                label: 'Nº Raciones',
                data: <?php echo $values; ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
