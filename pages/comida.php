<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Registro de comida</h1>
        <form>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
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
                <label for="glucosa_antes" class="form-label">Glucosa antes:</label>
                <input type="number" name="glucosa_antes" id="glucosa_antes" class="form-control" placeholder="1h antes" min="80" max="130" required>
                </div>
                <div class="col">
                <label for="glucosa_despues" class="form-label">Glucosa después:</label>
                <input type="number" name="glucosa_despues" id="glucosa_despues" class="form-control" placeholder="2h después" min="80" max="130" required>
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
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="control.php" class="btn btn-danger">Cancelar</a>
            <a href="hiper-hipo.php" class="btn btn-warning">Hipergluecemia</a>
            <a href="hiper-hipo.php" class="btn btn-warning">Hipogluecemia</a>
        </form>
    </div>
    
</body>
</html>