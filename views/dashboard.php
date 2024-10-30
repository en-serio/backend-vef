<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Vincular Bootstrap 5 CSS y otros recursos -->
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
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
    <div class="container-fluid">
        <button class="btn btn-primary me-2" onclick="toggleSidebar()">
            <i class="bi bi-list" style="width: 25px; height: 25px;"></i>
        </button>
        <a class="navbar-brand" href="#">Gestión de transfers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!--<ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cerrar sesión</a>
                </li>
            </ul>-->
        </div>
    </div>
</nav>


    <!-- Container principal para Sidebar y Main Content -->
    <div class="container-fluid h-100">
    <div class="row flex-nowrap">
        <!-- Sidebar -->
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menú</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light align-middle px-0" data-bs-toggle="modal" data-bs-target="#addReservaModal" onclick="resetStepper()">
                            <i class="bi bi-pencil-square pe-2"></i> <span class="ms-1 d-none d-sm-inline">Nuevo Transfer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light align-middle px-0" id="gestionTransferPanelLink">
                            <i class="bi bi-book pe-2"></i> <span class="ms-1 d-none d-sm-inline">Gestionar reservas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light align-middle px-0" id="vistaPanelLink">
                            <i class="bi bi-person-lines-fill pe-2"></i> <span class="ms-1 d-none d-sm-inline">Vistas</span>
                        </a>
                    </li>

                    <!-- Línea separadora -->
                    <hr class="text-light my-3">

                    <li class="nav-item">
                        <a href="#" class="nav-link text-light align-middle px-0" id="perfilPanel">
                            <i class="bi bi-person-circle pe-2"></i> <span class="ms-1 d-none d-sm-inline">Perfil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light align-middle px-0" id="cierraSesion">
                            <i class="bi bi-box-arrow-right pe-2"></i> <span class="ms-1 d-none d-sm-inline">Cerrar Sesión</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

            <!-- Main Content -->
            <div id="main-content" class="mt-5 col-md-9 col-lg-10 p-4">
                <!-- Tarjetas -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body" data-bs-toggle="modal" data-bs-target="#addReservaModal" style="cursor: pointer;">
                                <h5 class="card-title">Crear transfer</h5>
                                <p class="card-text">Crea una nueva reserva, ida, vuelta o ida/vuelta</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body" style="cursor: pointer;" onclick="loadView('gestionTransfers.php')">
                                <h5 class="card-title">Gestionar transfer</h5>
                                <p class="card-text">Gestiona los transfers activos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body" style="cursor: pointer;" onclick="loadView('views.php')">
                                <h5 class="card-title">Panel de vistas</h5>
                                <p class="card-text">Consulta el calendario de los transfers</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenido dinámico -->
                <div class="row" id="dynamicContent">
                    <!-- Aquí se cargará el contenido dinámico como el calendario -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Transfer -->
    <div class="modal fade" id="addReservaModal" tabindex="-1" aria-labelledby="addReservaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReservaModalLabel">Crear Transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Stepper -->
                    <div class="container">
                        <!-- Íconos de los pasos en la cabecera del modal -->
                        <div class="row justify-content-center mb-4">
                            <!-- Paso 1 -->
                            <div class="col text-center step">
                                <div class="p-3 rounded d-inline-block border" id="step1Icon">
                                    <i class="bi bi-signpost text-primary"></i>
                                </div>
                                <div class="mt-2 text-primary fw-bold">01</div>
                            </div>
                            <!-- Paso 2 -->
                            <div class="col text-center step">
                                <div class="p-3 rounded d-inline-block border" id="step2Icon">
                                    <i class="bi bi-calendar-date text-muted"></i>
                                </div>
                                <div class="mt-2 text-muted fw-bold">02</div>
                            </div>
                            <!-- Paso 3 -->
                            <div class="col text-center step">
                                <div class="p-3 rounded d-inline-block border" id="step3Icon">
                                    <i class="bi bi-person-circle text-muted"></i>
                                </div>
                                <div class="mt-2 text-muted fw-bold">03</div>
                            </div>
                            <!-- Paso 4 -->
                            <div class="col text-center step">
                                <div class="p-3 rounded d-inline-block border" id="step4Icon">
                                    <i class="bi bi-check-circle text-muted"></i>
                                </div>
                                <div class="mt-2 text-muted fw-bold">04</div>
                            </div>
                        </div>

                        <!-- Paso 1: Selección de Trayecto -->
                        <div class="content-container" stepper-label="1">
                            <h5 class="fw-bold mb-2 text-center">Paso 1</h5>
                            <p class="mb-4 text-center">Selecciona el tipo de trayecto que quieres reservar.</p>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-8 col-lg-6 text-start mb-4 p-3 border rounded shadow-sm">
                                    <h6 class="fw-bold mb-3 pb-2 border-bottom text-center">Introduce el tipo de transfer</h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="trayecto" id="ida" value="ida" onchange="updateDateTimeFields()">
                                        <label class="form-check-label" for="ida">De aeropuerto al hotel</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="trayecto" id="vuelta" value="vuelta" onchange="updateDateTimeFields()">
                                        <label class="form-check-label" for="vuelta">De hotel a aeropuerto</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="trayecto" id="idaVuelta" value="idaVuelta" onchange="updateDateTimeFields()">
                                        <label class="form-check-label" for="idaVuelta">Del aeropuerto al hotel y vuelta</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paso 2: Fechas y Horas -->
                        <div class="content-container" stepper-label="2" style="display: none;">
                            <h5 class="fw-bold mb-2 text-center">Paso 2</h5>
                            <p class="mb-4 text-center">Introduce la información respectiva al trayecto</p>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-8 col-lg-8 text-start mb-4 p-3 border rounded shadow-sm" id="trayectoIda" style="display: none;">
                                    <h6 class="fw-bold mb-3 pb-2 border-bottom text-center">Transfer del aeropuerto al hotel</h6>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label for="fechaIda" class="form-label">Día de llegada</label>
                                            <input type="date" class="form-control" id="fechaIda">
                                        </div>
                                        <div class="col-6">
                                            <label for="horaIda" class="form-label">Hora de llegada</label>
                                            <input type="time" class="form-control" id="horaIda">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="aeropuertoOrigen" class="form-label">Aeropuerto de origen</label>
                                            <input type="text" class="form-control" id="aeropuertoOrigen" placeholder="Aeropuerto de origen">
                                        </div>
                                        <div class="col-6">
                                            <label for="numeroVueloIda" class="form-label">Número de vuelo</label>
                                            <input type="text" class="form-control" id="numeroVueloIda" placeholder="Número de vuelo">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8 col-lg-8 text-start mb-4 p-3 border rounded shadow-sm" id="trayectoVuelta" style="display: none;">
                                    <h6 class="fw-bold mb-3 pb-2 border-bottom text-center">Transfer del hotel al aeropuerto</h6>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label for="fechaVuelta" class="form-label">Día del vuelo</label>
                                            <input type="date" class="form-control" id="fechaVuelta">
                                        </div>
                                        <div class="col-6">
                                            <label for="horaVueloVuelta" class="form-label">Hora del vuelo</label>
                                            <input type="time" class="form-control" id="horaVueloVuelta">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="horaRecogida" class="form-label">Hora de recogida</label>
                                            <input type="time" class="form-control" id="horaRecogida">
                                        </div>
                                        <div class="col-6">
                                            <label for="numeroVueloVuelta" class="form-label">Número de vuelo</label>
                                            <input type="text" class="form-control" id="numeroVueloVuelta" placeholder="Número de vuelo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paso 3: Información del Trayecto y Datos Personales -->
                        <div class="content-container" stepper-label="3" style="display: none;">
                            <h5 class="fw-bold mb-2 text-center">Paso 3</h5>
                            <p class="mb-4 text-center">Introduce la información adicional para el trayecto y los datos personales</p>
                            <div class="row justify-content-center">
                                <!-- Caja para información adicional del trayecto -->
                                <div class="col-12 col-md-8 col-lg-8 text-start mb-4 p-3 border rounded shadow-sm">
                                    <h6 class="fw-bold mb-3 pb-2 border-bottom text-center">Información del Trayecto</h6>

                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label for="hotelDestino" class="form-label">Hotel de destino/recogida</label>
                                            <input type="text" class="form-control" id="hotelDestino" placeholder="Nombre del hotel">
                                        </div>
                                        <div class="col-6">
                                            <label for="numeroViajeros" class="form-label">Número de viajeros</label>
                                            <input type="number" class="form-control" id="numeroViajeros" placeholder="Número de personas">
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="direccionHotel" class="form-label">Dirección del hotel</label>
                                            <input type="text" class="form-control" id="direccionHotel" placeholder="Nombre del hotel">
                                        </div>
                                    </div>
                                </div>

                                <!-- Caja para datos personales del cliente -->
                                <div class="col-12 col-md-8 col-lg-8 text-start mb-4 p-3 border rounded shadow-sm">
                                    <h6 class="fw-bold mb-3 pb-2 border-bottom text-center">Datos Personales</h6>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label for="nombreCliente" class="form-label">Nombre completo</label>
                                            <input type="text" class="form-control" id="nombreCliente" placeholder="Nombre completo del cliente">
                                        </div>
                                        <div class="col-6">
                                            <label for="emailCliente" class="form-label">Correo electrónico</label>
                                            <input type="email" class="form-control" id="emailCliente" placeholder="Correo electrónico">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="telefonoCliente" class="form-label">Teléfono de contacto</label>
                                            <input type="tel" class="form-control" id="telefonoCliente" placeholder="Número de teléfono">
                                        </div>
                                        <div class="col-6">
                                            <label for="dniCliente" class="form-label">DNI/Pasaporte</label>
                                            <input type="text" class="form-control" id="dniCliente" placeholder="DNI o pasaporte">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paso 4: Confirmación -->
                        <div class="content-container" stepper-label="4" style="display: none;">
                            <h5 class="fw-bold mb-4 text-center">Paso 4</h5>
                            <p class="mb-3 text-center">Revise los datos y confirme su reserva.</p>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-10 col-lg-8 text-start mb-4 p-3 border rounded shadow-sm">
                                    <h6 class="fw-bold mb-3 pb-2 border-bottom text-center">Resumen de la Reserva</h6>
                                    <!-- Resumen de reserva -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer del modal con botones de navegación -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-dark" id="previousBtn" onclick="previousStep()" style="display: none;">Anterior</button>
                        <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextStep()">Siguiente</button>
                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitTransfer()" style="display: none;">Reservar Transfer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>
</html>
