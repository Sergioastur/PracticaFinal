<?php session_start(); 
$tipo = $_GET["tipo"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tipo;?>gluecemia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
     <!-- Sidebar -->
    <!-- TODO: Icono perfil, links, iconos -->
    <div class="d-flex">
    <?php include '../interface/sidebar.php'; ?>
        
        <!-- Fin Sidebar -->
        <div class="flex-grow-1 d-flex justify-content-center align-items-center formulario">
            
            <form action="../php/<?php echo $tipo;?>.php" method="POST" class="p-4 border rounded shadow bg-white" style="width: 50%;">
            <h1>Crear <?php echo $tipo;?>glucemia</h1>
            <div class="mb-3">
                    <label for="glucosa" class="form-label">Glucosa:</label>
                    <input type="number" name="glucosa" id="glucosa" class="form-control" min="0" max="100" required>
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora:</label>
                    <input type="time" name="hora" id="hora" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="correcion" class="form-label">Correción:</label>
                    <input type="number" name="correcion" id="correcion" min="0" max="100" class="form-control" <?php if($tipo == "hiper"){echo "required";}else{echo "disabled";}?>>
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
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                
            </form>
        </div>
</body>
</html>