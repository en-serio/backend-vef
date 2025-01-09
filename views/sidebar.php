<!-- Sidebar para escritorio -->
<div class="d-none d-md-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <?php
    $rol = $_SESSION['rol']; 

    switch ($rol) {
        case 1: // Rol de Administrador
            echo '<ul class="nav nav-pills flex-column mb-auto ">
                <li class="nav-item">
                    <a href="#" class="nav-link text-light" data-bs-toggle="modal" data-bs-target="#addReservaModal" onclick="resetStepper()">
                        <i class="bi bi-pencil-square pe-2"></i> <span class="ms-1 d-none d-sm-inline">Nuevo Transfer</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-light gestionTransferBtn">
                        <i class="bi bi-book pe-2"></i> <span class="ms-1 d-none d-sm-inline">Gestionar reservas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-light" id="vistaPanelLink2" data-bs-toggle="tooltip">
                        <i class="bi bi-person-lines-fill pe-2"></i> <span class="ms-1 d-none d-sm-inline">Calendario</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-light" id="crearConductorLink" onclick="loadView(\'conductor.php\')">
                        <i class="bi bi-person-plus pe-2"></i> <span class="ms-1 d-none d-sm-inline">Gestión conductor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-light" id="hotelView" onclick="loadView(\'hotel.php\')">
                        <i class="bi bi-door-open pe-2"></i> <span class="ms-1 d-none d-sm-inline">Gestión hotel</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-light preciosBtn">
                        <i class="bi bi-cash pe-2"></i> <span class="ms-1 d-none d-sm-inline">Estadísticas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-light" id="hotelView" onclick="loadView(\'settings.php\')">
                        <i class="bi bi-gear"></i> <span class="ms-1 d-none d-sm-inline">Preferencias</span>
                    </a>
                </li>
            </ul>';
            break;
            case 2: 
                echo '<ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light" data-bs-toggle="modal" data-bs-target="#addReservaModal" onclick="resetStepper()">
                                <i class="bi bi-pencil-square pe-2"></i> <span class="ms-1 d-none d-sm-inline">Nuevo Transfer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light gestionTransferBtn">
                                <i class="bi bi-book pe-2"></i> <span class="ms-1 d-none d-sm-inline">Gestionar reservas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light" id="vistaPanelLink" onclick="loadView(\'precios.php\')">
                                <i class="bi bi-person-lines-fill pe-2"></i> <span class="ms-1 d-none d-sm-inline">Calendario</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light preciosBtn">
                                <i class="bi bi-cash pe-2"></i> <span class="ms-1 d-none d-sm-inline">Estadísticas</span>
                            </a>
                        </li>
                    </ul>';
                break;

                case 3: // Rol cliente
                    echo '<ul class="nav nav-pills flex-column mb-auto mt-4">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light" data-bs-toggle="modal" data-bs-target="#addReservaModal" onclick="resetStepper()">
                                <i class="bi bi-pencil-square pe-2"></i> <span class="ms-1 d-none d-sm-inline">Nuevo Transfer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light gestionTransferBtn">
                                <i class="bi bi-book pe-2"></i> <span class="ms-1 d-none d-sm-inline">Gestionar reservas</span>
                            </a>
                        </li>
                    </ul>';
                break;
    }
    ?>
    <hr>
    <div>
        <a href="#" class="nav-link text-light perfilPanel">
            <i class="bi bi-person-circle pe-2"></i> <span class="ms-1 d-none d-sm-inline">Perfil</span>
        </a>
        <a role="button" class="nav-link text-light closeSessionBtn" id="closeSessionBtn" onclick="logout()">
            <i class="bi bi-box-arrow-right pe-2"></i> <span class="ms-1 d-none d-sm-inline">Cerrar Sesión</span>
        </a>
    </div>
</div>

<!-- Sidebar compacto para móvil -->
<div class="sidebar d-flex d-md-none flex-column flex-shrink-0 bg-dark text-white" style="width: 4.5rem;">
    <?php
    switch ($rol) 
    {
        case 1: // Rol de Administrador
            echo '<ul class="nav nav-pills nav-flush flex-column mb-auto pt-5 text-center">
                <li class="nav-item">
                    <a href="#" class="nav-link py-3 border-bottom text-light" data-bs-toggle="modal" data-bs-target="#addReservaModal" onclick="resetStepper()">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link py-3 border-bottom text-light gestionTransferBtn" data-bs-toggle="tooltip" data-bs-placement="right" title="Gestionar Reservas">
                        <i class="bi bi-book"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link py-3 border-bottom text-light" id="vistaPanelLink" data-bs-toggle="tooltip" data-bs-placement="right" title="Calendario">
                        <i class="bi bi-person-lines-fill"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link py-3 border-bottom text-light" id="crearConductorLink" data-bs-toggle="tooltip" data-bs-placement="right" title="Gestión conductor" onclick="loadView(\'conductor.php\')">
                        <i class="bi bi-person-plus"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link py-3 border-bottom text-light" id="hotelView" data-bs-toggle="tooltip" data-bs-placement="right" title="Gestión hotel" onclick="loadView(\'hotel.php\')">
                        <i class="bi bi-door-open pe-2"></i> <span class="ms-1 d-none d-sm-inline">Gestión hotel</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link py-3 border-bottom text-light preciosBtn"  data-bs-toggle="tooltip" data-bs-placement="right" title="Estadísticas" >
                        <i class="bi bi-cash"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link py-3 border-bottom text-light" id="settingsLink" data-bs-toggle="tooltip" data-bs-placement="right" title="Preferencias" onclick="loadView(\'settings.php\')">
                        <i class="bi bi-gear"></i>
                    </a>
                </li>
            </ul>';
            break;

            case 2: 
                    echo '<ul class="nav nav-pills nav-flush flex-column mb-auto pt-5 text-center">
                    <li class="nav-item">
                        <a href="#" class="nav-link py-3 border-bottom text-light" data-bs-toggle="modal" data-bs-target="#addReservaModal" onclick="resetStepper()">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 border-bottom text-light gestionTransferBtn" data-bs-toggle="tooltip" data-bs-placement="right" title="Gestionar Reservas">
                            <i class="bi bi-book"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 border-bottom text-light" id="vistaPanelLink2" data-bs-toggle="tooltip" data-bs-placement="right" title="Calendario">
                            <i class="bi bi-person-lines-fill"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 border-bottom text-light preciosBtn"  data-bs-toggle="tooltip" data-bs-placement="right" title="Estadísticas" >
                            <i class="bi bi-cash"></i>
                        </a>
                    </li>
                </ul>';
            break;

            case 3: // Rol cliente
                echo '<ul class="nav nav-pills nav-flush flex-column mb-auto pt-2 text-center">
                        <li class="nav-item">
                            <a href="#" class="nav-link py-3 border-bottom text-light" data-bs-toggle="modal" data-bs-target="#addReservaModal" onclick="resetStepper()">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link py-3 border-bottom text-light gestionTransferBtn" data-bs-toggle="tooltip" data-bs-placement="right" title="Gestionar Reservas">
                                <i class="bi bi-book"></i>
                            </a>
                        </li>
                    </ul>';
            break;
    }
    ?>
    <div class="dropdown border-top">
        <a href="#" 
           class="d-flex align-items-center justify-content-center p-3 link-light text-decoration-none dropdown-toggle" 
           id="dropdownUser" 
           data-bs-toggle="dropdown" 
           aria-expanded="false">
            <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
        </a>

        <ul class="dropdown-menu text-small shadow bg-dark text-light" aria-labelledby="dropdownUser">
            <li><a href="#" class="dropdown-item text-light perfilPanel">Perfil</a></li>
            <li><hr class="dropdown-divider bg-light"></li>
            <li><a class="dropdown-item text-light closeSessionBtn" id="closeSessionBtn" onclick="logout()">Cerrar Sesión</a></li>
        </ul>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="../assets/js/sidebars.js"></script>
