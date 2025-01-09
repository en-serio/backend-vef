<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/transferCtrl.php';

?>
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
                                        <label class="form-check-label" for="ida">Aeropuerto al hotel</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="trayecto" id="vuelta" value="vuelta" onchange="updateDateTimeFields()">
                                        <label class="form-check-label" for="vuelta">Hotel a aeropuerto</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="trayecto" id="idaVuelta" value="idaVuelta" onchange="updateDateTimeFields()">
                                        <label class="form-check-label" for="idaVuelta">Aeropuerto al hotel y vuelta</label>
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
                                        <div class="col-4">
                                            <label for="numeroViajeros" class="form-label">Número de viajeros</label>
                                            <input type="number" class="form-control" id="numeroViajeros" placeholder="Número">
                                        </div>
                                        <div class="col-8">
                                            <label for="hotelDestino" class="form-label">Hotel de destino/recogida</label>
                                                <select class="form-select" id="hotelDestino" onchange="updateDireccionHotel()">
                                                    <?php $obj = new TransferCtrl;
                                                        $obj->drawHotelesList();?>
                                                </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="direccionHotel" class="form-label">Dirección del hotel</label>
                                            <input type="text" class="form-control" id="direccionHotel" placeholder="Dirección del hotel" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Caja para datos personales del cliente -->
                                <div class="col-12 col-md-8 col-lg-8 text-start mb-4 p-3 border rounded shadow-sm">
                                    <h6 class="fw-bold mb-3 pb-2 border-bottom text-center">Datos Personales</h6>
                                    <?php $obj = new TransferCtrl;
                                            $obj->drawUserTransfer()?>
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
                                        <div><strong>Trayecto:</strong> <span id="summaryTrayecto"></span></div>
                                        <div id="summaryIdaSection" style="display: none;">
                                            <div><strong>Fecha ida:</strong> <span id="summaryFechaIda"></span></div>
                                            <div><strong>Hora ida:</strong> <span id="summaryHoraIda"></span></div>
                                            <div><strong>Número de vuelo:</strong> <span id="summaryNumeroVueloIda"></span></div>
                                            <div><strong>Aeropuerto:</strong> <span id="summaryAeropuertoOrigen"></span></div>
                                        </div>
                                        <div id="summaryVueltaSection" style="display: none;">
                                            <div><strong>Fecha vuelta:</strong> <span id="summaryFechaVuelta"></span></div>
                                            <div><strong>Hora recogida:</strong> <span id="summaryHoraRecogida"></span></div>
                                            <div><strong>Hora del vuelo:</strong> <span id="summaryHoraVueloVuelta"></span></div>
                                            <div><strong>Número vuelo vuelta:</strong> <span id="summaryNumeroVueloVuelta"></span></div>
                                        </div>
                                        <hr class="border-top border-primary">
                                    <div id="summaryHotel" style="display: none;">
                                        <div><strong>Hotel:</strong> <span id="summaryHotelDestino"></span></div>
                                        <div><strong>Dirección:</strong> <span id="summaryDireccionHotel"></span></div>
                                        <div><strong>Número de viajeros:</strong> <span id="summaryNumeroViajeros"></span></div>
                                        <input type="hidden" id="summaryHotelId" name="summaryHotelId" value="">
                                    </div>
                                </div>
                            </div>
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-10 col-lg-8 text-start mb-4 p-3 border rounded shadow-sm">
                                        <h6 class="fw-bold mb-3 pb-2 border-bottom text-center">Datos personales</h6>
                                        <!-- Resumen del datos cliente -->
                                        <div><strong>Nombre:</strong> <span id="summaryNombreCliente"></span></div>
                                        <div><strong>Apellido 1:</strong> <span id="summaryApellido1"></span></div>
                                        <div><strong>Apellido 2:</strong> <span id="summaryApellido2"></span></div>
                                        <div><strong>Email:</strong> <span id="summaryEmailCliente"></span></div>
                                        <div><strong>Teléfono:</strong> <span id="summaryTelefonoCliente"></span></div>
                                        <div><strong>DNI:</strong> <span id="summaryDniCliente"></span></div>

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