<!-- Sidebar completo para escritorio -->
<div class="d-none d-md-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <hr class="text-light my-3 mt-4">
    <ul class="nav nav-pills flex-column mb-auto">
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
            <a href="#" class="nav-link text-light" id="vistaPanelLink">
                <i class="bi bi-person-lines-fill pe-2"></i> <span class="ms-1 d-none d-sm-inline">Vistas</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-light" id="crearConductorLink">
                <i class="bi bi-person-plus pe-2"></i> <span class="ms-1 d-none d-sm-inline">Crear Conductor</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-light" id="preciosLink">
                <i class="bi bi-cash pe-2"></i> <span class="ms-1 d-none d-sm-inline">Precios</span>
            </a>
        </li>
    </ul>
    <hr>
    <div>
        <a href="#" class="nav-link text-light" id="perfilPanel">
            <i class="bi bi-person-circle pe-2"></i> <span class="ms-1 d-none d-sm-inline">Perfil</span>
        </a>
        <a role="button" class="nav-link text-light closeSessionBtn" id="closeSessionBtn" onclick="logout()">
            <i class="bi bi-box-arrow-right pe-2"></i> <span class="ms-1 d-none d-sm-inline">Cerrar Sesión</span>
        </a>
    </div>
</div>

<!-- Sidebar compacto para móvil -->
<div class="sidebar d-flex d-md-none flex-column flex-shrink-0 bg-dark text-white" style="width: 4.5rem;">
    <a href="/" class="d-block p-3 link-light text-decoration-none" title="Inicio" data-bs-toggle="tooltip" data-bs-placement="right">
        <i class="bi bi-house" style="font-size: 1.5rem;"></i>
        <span class="visually-hidden">Inicio</span>
    </a>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
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
            <a href="#" class="nav-link py-3 border-bottom text-light" id="vistaPanelLink" data-bs-toggle="tooltip" data-bs-placement="right" title="Vistas">
                <i class="bi bi-person-lines-fill"></i>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom text-light" id="crearConductorLink" data-bs-toggle="tooltip" data-bs-placement="right" title="Crear Conductor">
                <i class="bi bi-person-plus"></i>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom text-light" id="preciosLink" data-bs-toggle="tooltip" data-bs-placement="right" title="Precios">
                <i class="bi bi-cash"></i>
            </a>
        </li>
    </ul>
    <div class="dropdown border-top">
    <!-- Botón que abre el dropdown -->
    <a href="#" 
       class="d-flex align-items-center justify-content-center p-3 link-light text-decoration-none dropdown-toggle" 
       id="dropdownUser" 
       data-bs-toggle="dropdown" 
       aria-expanded="false">
        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
    </a>

    <!-- Contenido del dropdown -->
    <ul class="dropdown-menu text-small shadow bg-dark text-light" aria-labelledby="dropdownUser">
        <li><a href="#" class="dropdown-item text-light" id="perfilPanel">Perfil</a></li>
        <li><hr class="dropdown-divider bg-light"></li>
        <li><a class="dropdown-item text-light closeSessionBtn"id="closeSessionBtn" onclick="logout()">Cerrar Sesión</a></li>
    </ul>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="../assets/js/sidebars.js"></script>
