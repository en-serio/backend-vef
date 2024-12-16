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
</div>