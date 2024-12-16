<div class="d-none d-md-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    @php
        $rol = 1; // session('rol') Obtener el rol del usuario desde la sesión
    @endphp

    @switch($rol)
        @case(1) <!-- Rol de Administrador -->
            @include('partials.sidebarAdmin')
            @break

        @case(2) <!-- Rol Corporativo -->
            @include('partials.sidebarCorporativo')
            @break

        @case(3) <!-- Rol Cliente -->
            @include('partials.sidebarCliente')
            @break
    @endswitch

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
    @switch($rol)
        @case(1) <!-- Rol de Administrador -->
            @include('partials.sidebarAdminCompact')
            @break

        @case(2) <!-- Rol Corporativo -->
            @include('partials.sidebarCorporativoCompact')
            @break

        @case(3) <!-- Rol Cliente -->
            @include('partials.sidebarClienteCompact')
            @break
    @endswitch

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
            <li><hr class="dropdown-divider bg-light"
