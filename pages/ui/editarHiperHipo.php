<?php session_start(); 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tipo;?>gluecemia</title>
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
            <h1>Editar Hiper/Hipoglucemia</h1>
            <form action="edit/hiperHipo.php" method="POST">
                <div class="mb-3">
                    <label for="tipo_comida" class="form-label">Tipo de comida:</label>
                    <select name="tipo_comida" id="tipo_comida" class="form-select" required>
                        <option value="desayuno">Desayuno</option>
                        <option value="comida">Comida</option>
                        <option value="merienda">Merienda</option>
                        <option value="cena">Cena</option>
                        <option value="aperitivo">Aperitivo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
</body>
</html>