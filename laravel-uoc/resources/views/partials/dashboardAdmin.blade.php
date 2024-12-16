<div class="row mb-3 pt-4 pt-md-0">
    <!-- Crear transfer -->
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-body" data-bs-toggle="modal" data-bs-target="#addReservaModal" style="cursor: pointer;">
                <h5 class="card-title">Crear Transfer</h5>
                <p class="card-text">Ida, vuelta e ida y vuelta</p>
            </div>
        </div>
    </div>

    <!-- Gestionar transfer -->
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <a href="{{ route('gestionTransfers') }}" class="text-decoration-none text-dark">
                <div class="card-body" style="cursor: pointer;">
                    <h5 class="card-title">Gestionar Transfer</h5>
                    <p class="card-text">Gestiona todos los transfers existentes</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Panel de calendario -->
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <a href="{{ route('calendar') }}" class="text-decoration-none text-dark">
                <div class="card-body" style="cursor: pointer;">
                    <h5 class="card-title">Panel de Calendario</h5>
                    <p class="card-text">Consulta el calendario de los transfers</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Gestión de conductor -->
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <a href="{{ route('conductor') }}" class="text-decoration-none text-dark">
                <div class="card-body" style="cursor: pointer;">
                    <h5 class="card-title">Gestión de Conductor</h5>
                    <p class="card-text">Crea y gestiona conductores</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Hotel -->
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <a href="{{ route('hotel') }}" class="text-decoration-none text-dark">
                <div class="card-body" style="cursor: pointer;">
                    <h5 class="card-title">Hotel</h5>
                    <p class="card-text">Crea y gestiona los hoteles</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <a href="{{ route('estadisticas') }}" class="text-decoration-none text-dark">
                <div class="card-body" style="cursor: pointer;">
                    <h5 class="card-title">Estadísticas</h5>
                    <p class="card-text">Consulta los transfers y comisiones filtradas</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Preferencias -->
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <a href="{{ route('settings') }}" class="text-decoration-none text-dark">
                <div class="card-body" style="cursor: pointer;">
                    <h5 class="card-title">Preferencias</h5>
                    <p class="card-text">Visualiza e inicializa zonas y tipos de transfers</p>
                </div>
            </a>
        </div>
    </div>
</div>
