<?php
session_start();
$_SESSION['pagina'] = "inicio";

$hora = date('H'); // Obtiene la hora actual en formato 24 horas

if ($hora < 12) {
    $saludo = "¡Buenos días!";
} else {
    $saludo = "¡Buenas tardes!";
}

// Obtiene el mes como número (1-12)
$mes_numero = date('n'); 

// Array meses
$meses = [
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


$mes = $meses[$mes_numero];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido, <?php echo $_SESSION['name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Sidebar -->
    <!-- TODO: Icono perfil, links, iconos -->
    <div class="d-flex ">
        <?php include '../interface/sidebar.php'; ?>
        <div class="flex-grow-1 p-3 content">
            <h1><?php echo $saludo;?></h1>
            <p>Hoy es <?php echo date('d'); ?> de <?php echo $mes?> del <?php echo date('Y');?></p>
        </div>
    </div>
    <!-- Fin Sidebar -->
</body>

</html>