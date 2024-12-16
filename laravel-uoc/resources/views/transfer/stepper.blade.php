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
                        @foreach ([1 => 'signpost', 2 => 'calendar-date', 3 => 'person-circle', 4 => 'check-circle'] as $step => $icon)
                            <div class="col text-center step">
                                <div class="p-3 rounded d-inline-block border" id="step{{ $step }}Icon">
                                    <i class="bi bi-{{ $icon }} {{ $step == 1 ? 'text-primary' : 'text-muted' }}"></i>
                                </div>
                                <div class="mt-2 {{ $step == 1 ? 'text-primary' : 'text-muted' }} fw-bold">0{{ $step }}</div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paso 1: Selección de Trayecto -->
                    <div class="content-container" stepper-label="1">
                        <h5 class="fw-bold mb-2 text-center">Paso 1</h5>
                        <p class="mb-4 text-center">Selecciona el tipo de trayecto que quieres reservar.</p>
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-6 text-start mb-4 p-3 border rounded shadow-sm">
                                <h6 class="fw-bold mb-3 pb-2 border-bottom text-center">Introduce el tipo de transfer</h6>
                                @php
                                    $trayectos = [
                                        'ida' => 'Aeropuerto al hotel',
                                        'vuelta' => 'Hotel a aeropuerto',
                                        'idaVuelta' => 'Aeropuerto al hotel y vuelta'
                                    ];
                                @endphp
                                @foreach ($trayectos as $key => $label)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="trayecto" id="{{ $key }}" value="{{ $key }}" onchange="updateDateTimeFields()">
                                        <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Paso 2: Fechas y Horas -->
                    <div class="content-container" stepper-label="2" style="display: none;">
                        <h5 class="fw-bold mb-2 text-center">Paso 2</h5>
                        <p class="mb-4 text-center">Introduce la información respectiva al trayecto</p>
                        <div class="row justify-content-center">
                            <!-- Trayecto Ida -->
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
                            </div>

                            <!-- Trayecto Vuelta -->
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
                            </div>
                        </div>
                    </div>

                    <!-- Paso 3: Información del Trayecto y Datos Personales -->
                    <div class="content-container" stepper-label="3" style="display: none;">
                        <h5 class="fw-bold mb-2 text-center">Paso 3</h5>
                        <p class="mb-4 text-center">Introduce la información adicional para el trayecto y los datos personales</p>
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 text-start mb-4 p-3 border rounded shadow-sm">
                                <h6 class="fw-bold mb-3 pb-2 border-bottom text-center">Información del Trayecto</h6>
                                @php
                                    $obj = new App\Http\Controllers\transferCtrl;
                                    $hoteles = $obj->drawHotelesList();
                                @endphp
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="hotelDestino" class="form-label">Hotel de destino/recogida</label>
                                        <select class="form-select" id="hotelDestino" onchange="updateDireccionHotel()">
                                            @foreach ($hoteles as $hotel)
                                                <option value="{{ $hotel['id'] }}">{{ $hotel['nombre'] }}</option>
                                            @endforeach
                                        </select>
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
                                <div><strong>Trayecto:</strong> <span id="summaryTrayecto"></span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer del modal con botones de navegación -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="previousBtn" onclick="previousStep()" style="display: none;">Anterior</button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextStep()">Siguiente</button>
                    <button type="button" class="btn btn-success" id="submitBtn" onclick="submitTransfer()" style="display: none;">Reservar Transfer</button>
                </div>
            </div>
        </div>
    </div>
</div>