<?php
session_start();
$_SESSION['pagina'] = "comida";
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
    <div class="d-flex">
    <?php include '../interface/sidebar.php'; ?>
        <!-- Fin Sidebar -->
        <div class="flex-grow-1 p-3">
            <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                <div class="container-fluid py-5">
                  <h1 class="display-5 fw-bold">Crear comida</h1>
                  <p class="col-md-8 fs-4">Utiliza esta sección para añadir nuevos registros de alimentos que consumas. Asegúrate de incluir detalles como el nombre de la comida, raciones, niveles de glucosa, etc..., lo cual es crucial para el control de la diabetes.</p>
                  <a href="crearComida.php" class="btn btn-primary btn-lg" type="button">Crear</a>
                </div>
              </div>
              <div class="row align-items-md-stretch">
                <div class="col-md-6">
                  <div class="h-100 p-5 text-bg-dark rounded-3">
                    <h2>Editar comida</h2>
                    <p>Modifica los registros de alimentos existentes para corregir o actualizar la información. Puedes ajustar los datos según sea necesario para mantener un seguimiento adecuado de tu dieta.</p>
                    <a href="editarComida.php" class="btn btn-outline-light" type="button">Editar</a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Borrar comida</h2>
                    <p>Si un registro de alimento ya no es necesario o deseas eliminarlo, utiliza esta opción. Ten en cuenta que esta acción es irreversible, así que asegúrate de que realmente quieres eliminar el registro.</p>
                    <a href="borrarComida.php" class="btn btn-outline-secondary" type="button">Borrar</a>
                  </div>
                </div>
              </div>
        </div>
    </div>
    
</body>
</html>