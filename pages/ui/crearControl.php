<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Glucosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Control de glucosa</h1>
        <form action="../php/control.php" method="post">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="deporte" class="form-label">Nivel de actividad:</label>
                <select class="form-select" id="deporte" name="deporte">
                    <option value="1">1 - Actividad mínima</option>
                    <option value="2">2 - Actividad baja</option>
                    <option value="3">3 - Actividad media</option>
                    <option value="4">4 - Actividad alta</option>
                    <option value="5">5 - Actividad máxima</option>
                </select>

            </div>
            <div class="mb-3">
                <label for="lenta" class="form-label">Insulina lenta:</label>
                <input type="number" name="lenta" id="lenta" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>

</html>