<?php

session_start();
$_SESSION['pagina'] = "estadisticas";

// ! Se usa chartjs para los graficos
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadisticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .sidebar {
            height: 100vh;
        }

        #myChart, #bar-Chart {
            width: 600px !important;  
            height: 400px !important; 
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <!-- TODO: Icono perfil, links, iconos -->
    <div class="d-flex">
        <?php include '../interface/sidebar.php'; ?>
        <!-- Fin Sidebar -->
        <div class="flex-grow-1 p-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="casos-hiper-hipo-tab" data-bs-toggle="tab" data-bs-target="#casos-hiper-hipo-tab-pane" type="button" role="tab" aria-controls="casos-hiper-hipo-tab-pane" aria-selected="true">Casos Hiper/Hipo</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="raciones-comida-tab" data-bs-toggle="tab" data-bs-target="#raciones-comida-tab-pane" type="button" role="tab" aria-controls="raciones-comida-tab-pane" aria-selected="false">Raciones por comida</button>
                </li>
                
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="casos-hiper-hipo-tab-pane" role="tabpanel" aria-labelledby="casos-hiper-hipo-tab" tabindex="0"> <?php include 'stats/hiperHipo.php'; ?></div>
                <div class="tab-pane fade" id="raciones-comida-tab-pane" role="tabpanel" aria-labelledby="raciones-comida-tab" tabindex="0"><?php include 'stats/racionesComida.php'; ?></div>
                
            </div>
        </div>
    </div>
    
</body>

</html>