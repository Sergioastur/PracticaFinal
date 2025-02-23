<?php
session_start();
$_SESSION['pagina'] = "control";
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
                  <h1 class="display-5 fw-bold">Crear control</h1>
                  <p class="col-md-8 fs-4">Registra un nuevo control de salud, donde podrás ingresar datos relevantes como niveles de glucosa, 
                  medicación, alimentación o cualquier otro seguimiento necesario. Esto te ayudará a mantener un control detallado de tu bienestar.</p>
                  <a href="crearControl.php" class="btn btn-primary btn-lg" type="button">Crear</a>
                </div>
              </div>
              <div class="row align-items-md-stretch">
                <div class="col-md-6">
                  <div class="h-100 p-5 text-bg-dark rounded-3">
                    <h2>Edita el control</h2>
                    <p>Modifica un control existente para corregir información, actualizar datos o agregar nuevas observaciones. 
                    Mantén tu historial de seguimiento preciso y actualizado según tus necesidades.</p>
                    <a href="editarControl.php" class="btn btn-outline-light" type="button">Editar</a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Borra el control</h2>
                    <p>Elimina un registro de control si ya no es necesario o si fue ingresado por error. 
                    Asegúrate de mantener solo los datos relevantes para un mejor monitoreo de tu salud.</p>
                    <a href="borrarControl.php" class="btn btn-outline-secondary" type="button">Borrar</a>
                  </div>
                </div>
              </div>
        </div>
    </div>
    
</body>
</html>