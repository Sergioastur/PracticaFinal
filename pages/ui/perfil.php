<?php
session_start();
require_once "../../connection/conexion.php";
$_SESSION['pagina'] = "none";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Sacar los datos del usuario
$stmt = $conn->prepare("SELECT fecha_nacimiento, nombre, apellidos, usuario FROM usuario WHERE id_usu = ?");
$stmt->bind_param("i", $_SESSION["usuario"]);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$fecha_nacimiento = $row["fecha_nacimiento"];
$nombre = $row["nombre"];
$apellidos = $row["apellidos"];
$usuario = $row["usuario"];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido, <?php echo $_SESSION['name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Sidebar -->
    <!-- TODO: Icono perfil, links, iconos -->
    <div class="d-flex ">
        <?php include '../interface/sidebar.php'; ?>
        <div class="flex-grow-1 d-flex justify-content-center align-items-center formulario">
            
            <form action="../php/edit/update_perfil.php" method="post" class="p-4 border rounded shadow bg-white" style="width: 50%;">
            <h1>Perfil</h1>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo $apellidos; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?php echo $fecha_nacimiento; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario; ?>" readonly>
                </div>
                <input type="submit" value="Editar" class="btn btn-primary">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarCuenta">
                    Eliminar cuenta
                </button>
            </form>
            

            <!-- Modal -->
            <div class="modal fade" id="eliminarCuenta" tabindex="-1" aria-labelledby="eliminarCuentaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">¿Borrar cuenta?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Esta acción no se puede deshacer. ¿Estás seguro de que quieres borrar tu cuenta?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="del/perfil.php" class="btn btn-danger">Eliminar cuenta</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Fin Sidebar -->
</body>

</html>