<?php 
if (!isset($_SESSION)) {
    session_start();
}
// Si no hay una sesion iniciada, redirige al index
if (!isset($_SESSION['name'])) {
    header('Location: ../../index.html');
}
$pagina = $_SESSION['pagina'];

// Rutas de los archivos
$rootPath = "/PracticaFinal/pages/ui/";

$inicio = $rootPath."index.php";
$control = $rootPath."selectControl.php";
$comida = $rootPath."selectComida.php";
$hiperHipo = $rootPath."selectHiperHipo.php";
$tabla = $rootPath."tabla.php";
$estadisticas = $rootPath."estadisticas.php";
$logo = $rootPath."../../img/diabetes.png";
$usu = $rootPath."../../img/usu.png";
$css = $rootPath."../../css/styles.css";
?>
<!-- Links iconos -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<!-- Estilos -->
<link rel="stylesheet" href="<?php echo $css;?>">

<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar position-fixed" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <!-- <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg> -->
         <img src="<?php echo $logo;?>" width="40" height="40" class="bi pe-none me-2">
        <span class="fs-4">Diabetes</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto ">
        <li class="nav-item">
            <a href="<?php echo $inicio;?>" class="nav-link <?php if($pagina=='inicio'){echo 'active';}else{echo 'text-white';} ?>" aria-current="page">
            <i class="bi bi-house-door pe-none me-2"></i>
                Inicio
            </a>
        </li>
        <li>
            <a href="<?php echo $control;?>" class="nav-link <?php if($pagina=='control'){echo 'active';}else{echo 'text-white';} ?>">
            <i class="bi bi-card-list pe-none me-2"></i>
                Control
            </a>
        </li>
        <li>
            <a href="<?php echo $comida;?>" class="nav-link <?php if($pagina=='comida'){echo 'active';}else{echo 'text-white';} ?>">
            <i class="fa-solid fa-utensils pe-none me-2"></i>
                Comida
            </a>
        </li>
        <li>
            <a href="<?php echo $hiperHipo;?>" class="nav-link <?php if($pagina=='hiperHipo'){echo 'active';}else{echo 'text-white';} ?>">
            <i class="bi bi-arrow-down-up pe-none me-2"></i>
                Hiper/Hipoglucemia
            </a>
        </li>
        <li>
            <a href="<?php echo $tabla;?>" class="nav-link <?php if($pagina=='tabla'){echo 'active';}else{echo 'text-white';} ?>">
            <i class="bi bi-table pe-none me-2"></i>
                Tabla
            </a>
        </li>
        <li>
            <a href="<?php echo $estadisticas;?>" class="nav-link <?php if($pagina=='estadisticas'){echo 'active';}else{echo 'text-white';} ?>">
            <i class="bi bi-bar-chart-line pe-none me-2"></i>
                Estadisticas
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo $usu;?>" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong><?php echo $_SESSION['name'] ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../../index.html">Sign out</a></li>
        </ul>
    </div>
</div>
