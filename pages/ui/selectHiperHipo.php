<?php
session_start();
$_SESSION['pagina'] = "hiperHipo";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Que quieres hacer?</title>
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
    <!--! No permitir crear una hiper y una hipo-->
    <div class="d-flex">
    <?php include '../interface/sidebar.php'; ?>
        <!-- Fin Sidebar -->
        <div class="flex-grow-1 p-3">
            <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                <div class="container-fluid py-5">
                  <h1 class="display-5 fw-bold">Crea una Hiperglucemia o una Hipoglucemia</h1>
                  <p class="col-md-8 fs-4">Registra un episodio de hiperglucemia (nivel alto de azúcar en la sangre) o hipoglucemia (nivel bajo de azúcar en la sangre). 
                  Esto es útil para el seguimiento médico y el control de la diabetes, permitiendo llevar un historial de eventos y ajustar el tratamiento según sea necesario.</p>
                  <a href="crearHiperHipo.php?tipo=hiper" class="btn btn-primary btn-lg" type="button">Hiperglucemia</a>
                  <a href="crearHiperHipo.php?tipo=hipo" class="btn btn-primary btn-lg" type="button">Hipoglucemia</a>
                </div>
              </div>
              <div class="row align-items-md-stretch">
                <div class="col-md-6">
                  <div class="h-100 p-5 text-bg-dark rounded-3">
                    <h2>Editar una Hiperglucemia o una Hipoglucemia</h2>
                    <p> Si necesitas modificar un registro existente, puedes editar los detalles de un episodio de hiperglucemia o hipoglucemia. 
                    Esto te permitirá corregir información o agregar notas adicionales para mejorar el control de tu salud.</p>
                    <a href="editarHiperHipo.php" class="btn btn-outline-light" type="button">Editar</a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Borrar una Hiperglucemia o una Hipoglucemia</h2>
                    <p>Elimina un registro de hiperglucemia o hipoglucemia si ya no es necesario o si fue ingresado por error. 
                    Mantén tu historial limpio y preciso para un mejor control de tu estado de salud.</p>
                    <a href="borrarHiperHipo.php" class="btn btn-outline-secondary" type="button">Borrar</a>
                  </div>
                </div>
              </div>
        </div>
    </div>
    
</body>
</html>