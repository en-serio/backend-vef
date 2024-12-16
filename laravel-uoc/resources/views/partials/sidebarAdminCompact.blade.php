<div class="sidebar d-flex d-md-none flex-column flex-shrink-0 bg-dark text-white" style="width: 4.5rem;">
    <ul class="nav nav-pills nav-flush flex-column mb-auto pt-5 text-center">
        <li class="nav-item">
            <a href="#" class="nav-link py-3 border-bottom text-light" data-bs-toggle="modal" data-bs-target="#addReservaModal">
                <i class="bi bi-pencil-square"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('transfer.gestionTransfers') }}" class="nav-link py-3 border-bottom text-light" data-bs-toggle="tooltip" title="Gestionar Reservas">
                <i class="bi bi-book"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('calendario') }}" class="nav-link py-3 border-bottom text-light" data-bs-toggle="tooltip" title="Calendario">
                <i class="bi bi-person-lines-fill"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('conductor.gestion') }}" class="nav-link py-3 border-bottom text-light" data-bs-toggle="tooltip" title="Gestión Conductor">
                <i class="bi bi-person-plus"></i>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('hotel.gestion') }}" class="nav-link py-3 border-bottom text-light" data-bs-toggle="tooltip" title="Gestión Hotel">
                <i class="bi bi-door-open"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('estadisticas') }}" class="nav-link py-3 border-bottom text-light" data-bs-toggle="tooltip" title="Estadísticas">
                <i class="bi bi-cash"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('preferencias') }}" class="nav-link py-3 border-bottom text-light" data-bs-toggle="tooltip" title="Preferencias">
                <i class="bi bi-gear"></i>
            </a>
        </li>
    </ul>

    <div class="dropdown border-top">
        <a href="#" class="d-flex align-items-center justify-content-center p-3 link-light text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
        </a>
        <ul class="dropdown-menu text-small shadow bg-dark text-light" aria-labelledby="dropdownUser">
            <li><a href="#" class="dropdown-item text-light perfilPanel">Perfil</a></li>
            <li><hr class="dropdown-divider bg-light"></li>
            <li><a class="dropdown-item text-light closeSessionBtn" id="closeSessionBtn" onclick="logout()">Cerrar Sesión</a></li>
        </ul>
    </div>
</div>
