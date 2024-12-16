<ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
        <a href="#" class="nav-link text-light" data-bs-toggle="modal" data-bs-target="#addReservaModal">
            <i class="bi bi-pencil-square pe-2"></i> <span class="ms-1 d-none d-sm-inline">Nuevo Transfer</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('transfer.gestionTransfers') }}" class="nav-link text-light">
            <i class="bi bi-book pe-2"></i> <span class="ms-1 d-none d-sm-inline">Gestionar Reservas</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link text-light" id="vistaPanelLink2" data-bs-toggle="tooltip" title="Ver Calendario">
            <i class="bi bi-person-lines-fill pe-2"></i>
            <span class="ms-1 d-none d-sm-inline">Calendario</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('conductor.gestion') }}" class="nav-link text-light" id="crearConductorLink">
            <i class="bi bi-person-plus pe-2"></i> <span class="ms-1 d-none d-sm-inline">Gestión Conductor</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('hotel.gestion') }}" class="nav-link text-light" id="hotelView">
            <i class="bi bi-door-open pe-2"></i> <span class="ms-1 d-none d-sm-inline">Gestión Hotel</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('estadisticas') }}" class="nav-link text-light preciosBtn">
            <i class="bi bi-cash pe-2"></i> <span class="ms-1 d-none d-sm-inline">Estadísticas</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('preferencias') }}" class="nav-link text-light" id="settingsLink">
            <i class="bi bi-gear pe-2"></i> <span class="ms-1 d-none d-sm-inline">Preferencias</span>
        </a>
    </li>
</ul>
