<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Vincular Bootstrap 5 CSS y otros recursos -->
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/sidebars.css">
    
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Vincular JavaScript de Bootstrap, SweetAlert y FullCalendar -->
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="../node_modules/@fullcalendar/core/index.global.js"></script>
    <script src="../node_modules/@fullcalendar/daygrid/index.global.js"></script>
    <script src="../node_modules/@fullcalendar/interaction/index.global.js"></script>
    <script src="../node_modules/@fullcalendar/timegrid/index.global.js"></script>
</head>

<body class="vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-block">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" onclick="toggleSidebar()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ms-4" href="#dashboard.php" onclick="window.location.href = '#dashboard.php'; location.reload(); return false;">
                <img src="../assets/media/Bootstrap-logo.png" class="rounded-circle" alt="Logo" style="width: 30px;">
                <span class="ms-2">Gestión de transfers VEF</span>
                </a>
    </div>
    </nav>
    <main class="vh-100 mt-5">

<?php require_once '../views/sidebar.php';?>
    <!-- Container principal para Sidebar y Main Content -->
    <div class=" contenidoDinamico container-fluid h-100">
        <!-- Main Content -->
        <div id="main-content" class="main-content">
                <!-- Tarjetas -->
                
<?php
$rol = ($_SESSION['rol']);
        
    switch($rol)
    {
        case 1:
            
            echo '<div class="row mb-3 mt-5 pt-4 pt-md-0">
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body" data-bs-toggle="modal" data-bs-target="#addReservaModal" style="cursor: pointer;">
                                <h5 class="card-title">Crear transfer</h5>
                                <p class="card-text">Ida, vuelta e ida y vuelta</p>
                            </div>
                        </div>
                    </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body gestionTransferBtn" style="cursor: pointer;" id = "loadTransfers">
                            <h5 class="card-title">Gestionar transfer</h5>
                            <p class="card-text">Gestiona todos los transfers existentes</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" style="cursor: pointer;" onclick="loadView(\'views.php\')">
                            <h5 class="card-title">Panel de calendario</h5>
                            <p class="card-text">Consulta el calendario de los transfers</p>
                        </div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" style="cursor: pointer;" onclick="loadView(\'conductor.php\')">
                            <h5 class="card-title">Gestión de conductor</h5>
                            <p class="card-text">Crea y gestiona conductores</p>
                        </div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" style="cursor: pointer;" onclick="loadView(\'hotel.php\')">
                            <h5 class="card-title">Hotel</h5>
                            <p class="card-text">Crea y gestiona los hoteles</p>
                        </div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body preciosBtn" style="cursor: pointer;">
                            <h5 class="card-title">Precios</h5>
                            <p class="card-text">Crea y gestiona los hoteles</p>
                        </div>
                    </div>  
                </div>
            </div>';

            break;

            case 2:
                    echo '<div class="row mb-3 mt-5 pt-4 pt-md-0">
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body" data-bs-toggle="modal" data-bs-target="#addReservaModal" style="cursor: pointer;">
                                <h5 class="card-title">Crear transfer</h5>
                                <p class="card-text">Ida, vuelta e ida y vuelta</p>
                            </div>
                        </div>
                    </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body gestionTransferBtn" style="cursor: pointer;" id = "loadTransfers">
                            <h5 class="card-title">Gestionar transfer</h5>
                            <p class="card-text">Gestiona todos los transfers existentes</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" style="cursor: pointer;" onclick="loadView(\'views.php\')">
                            <h5 class="card-title">Panel de vistas</h5>
                            <p class="card-text">Consulta el calendario de los transfers</p>
                        </div>
                    </div>  
                </div>
            </div>';
                
            break;

            case 3:

                echo '<div class="row mb-3 mt-5 pt-4 pt-md-0">
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" data-bs-toggle="modal" data-bs-target="#addReservaModal" style="cursor: pointer;">
                            <h5 class="card-title">Crear transfer</h5>
                            <p class="card-text">Ida, vuelta e ida y vuelta</p>
                        </div>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body gestionTransferBtn" style="cursor: pointer;" id = "loadTransfers">
                        <h5 class="card-title">Gestionar transfer</h5>
                        <p class="card-text">Gestiona los transfers activos</p>
                    </div>
                </div>
            </div>';
            
            break;    
        
            
        } 
                        

                ?>

                <!-- Contenido dinámico -->
                <div class="row" id="dynamicContent">
                    <!-- Aquí se cargará el contenido dinámico como el calendario -->
                     
                    
                </div>
            </div>
        </div>
    </div>
    <?php require_once '../views/stepper.php';?>
    <?php require_once '../views/modalEdit.php';?>
    
   
</main>
    <!-- Bootstrap JS -->
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/sidebars.js"></script>
    <script src="../assets/js/perfil.js"></script>
    <script src="../assets/js/precios.js"></script>
    <script src="../assets/js/appConfig.js"></script>
    <script src="../assets/js/hotel.js"></script>
    
</body>
</html>
