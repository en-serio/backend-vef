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
        <a href="{{ route('calendario') }}" class="nav-link text-light" id="vistaPanelLink">
            <i class="bi bi-person-lines-fill pe-2"></i> <span class="ms-1 d-none d-sm-inline">Calendario</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('estadisticas') }}" class="nav-link text-light preciosBtn">
            <i class="bi bi-cash pe-2"></i> <span class="ms-1 d-none d-sm-inline">Estadísticas</span>
        </a>
    </li>
</ul>
