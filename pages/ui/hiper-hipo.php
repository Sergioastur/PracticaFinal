<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1></h1>
        <form>
            <div class="mb-3">
                <label for="glucosa" class="form-label">Glucosa:</label>
                <input type="number" name="glucosa" id="glucosa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora:</label>
                <input type="time" name="hora" id="hora" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="correcion" class="form-label">Correción:</label>
                <input type="number" name="correcion" id="correcion" class="form-control" required>
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
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            
        </form>
    </div>
</body>
</html>