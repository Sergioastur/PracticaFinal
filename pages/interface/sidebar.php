<?php 
if (!isset($_SESSION)) {
    session_start();
}
$pagina = $_SESSION['pagina'];
$rootPath = "/PracticaFinal/pages/ui/";

$inicio = $rootPath."index.php";
$control = $rootPath."selectControl.php";
$comida = $rootPath."selectComida.php";
$hiperHipo = $rootPath."selectHiperHipo.php";
$tabla = $rootPath."tabla.php";
$estadisticas = $rootPath."estadisticas.php";
?>
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Diabetes</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="<?php echo $inicio;?>" class="nav-link <?php if($pagina=='inicio'){echo 'active';}else{echo 'text-white';} ?>" aria-current="page">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                Inicio
            </a>
        </li>
        <li>
            <a href="<?php echo $control;?>" class="nav-link <?php if($pagina=='control'){echo 'active';}else{echo 'text-white';} ?>">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                Control
            </a>
        </li>
        <li>
            <a href="<?php echo $comida;?>" class="nav-link <?php if($pagina=='comida'){echo 'active';}else{echo 'text-white';} ?>">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Comida
            </a>
        </li>
        <li>
            <a href="<?php echo $hiperHipo;?>" class="nav-link <?php if($pagina=='hiperHipo'){echo 'active';}else{echo 'text-white';} ?>">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Hiper/Hipoglucemia
            </a>
        </li>
        <li>
            <a href="<?php echo $tabla;?>" class="nav-link <?php if($pagina=='tabla'){echo 'active';}else{echo 'text-white';} ?>">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Tabla
            </a>
        </li>
        <li>
            <a href="<?php echo $estadisticas;?>" class="nav-link <?php if($pagina=='estadisticas'){echo 'active';}else{echo 'text-white';} ?>">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Estadisticas
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong><?php echo $_SESSION['name'] ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../../index.html">Sign out</a></li>
        </ul>
    </div>
</div>
