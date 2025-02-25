<?php session_start();
$pagina = $_SESSION['pagina'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
    <!-- Sidebar -->
    <!-- TODO: Icono perfil, links, iconos -->
    <div class="d-flex">
    <?php include '../interface/sidebar.php'; ?>
        <!-- Fin Sidebar -->
        <div class="flex-grow-1 d-flex justify-content-center align-items-center formulario">
            
           
            <form action="../php/comida.php" method="post" class="p-4 border rounded shadow bg-white" style="width: 50%;">
            <h1>Crear Comida</h1>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
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
                <div class="mb-3 row row-cols-2">
                    <div class="col">
                        <label for="gl_1h" class="form-label">Glucosa 1h antes:</label>
                        <input type="number" name="gl_1h" id="gl_1h" class="form-control" min="80" max="130" required>
                    </div>
                    <div class="col">
                        <label for="gl_2h" class="form-label">Glucosa 1h después:</label>
                        <input type="number" name="gl_2h" id="gl_2h" class="form-control" min="80" max="130" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="raciones" class="form-label">Raciones:</label>
                    <input type="number" name="raciones" id="raciones" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="insulina" class="form-label">Insulina:</label>
                    <input type="number" name="insulina" id="insulina" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear comida</button>
            </form>
        </div>
    </div>
</body>
</html>