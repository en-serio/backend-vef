<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/clienteEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferZonaEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/settingsCtrl.php';
?>
    <h5>Configuración de la aplicación</h5>
    <h6>Aquí podrás ver e inicializar las zonas y los tipos de reservas</h6>
    <div class="row pt-3 pb-3">
        <div class="col-12 col-md-6 mb-2 ps-0">
            <button class="btn btn-sm btn-primary me-3 mb-3" onclick="abrirModalZona()">Añadir nueva zona</button>
            <button class="btn btn-sm btn-warning mb-3" onclick="initTiposTransfers()">Inicializar tipos de transfer</button>
            <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Si accede la primera vez como administrador, debe inicializar las zonas para poder crear transfers.">
            </i>
        </div>

        <div style="background-color: #f0f0f0; padding: 15px; border-radius: 5px;">
            <h6>Listado de Zonas</h6>
            <?php $zonaEntity = new TransferZonaEntity;
            $obj = $zonaEntity->getZonas();
            $zonaCtrl = new settingsCtrl;
            echo $zonaCtrl->drawZonas($obj)?>
        </div>
    </div>

<div id="nuevazonamodal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px; display: flex; flex-direction: column; gap: 10px;">
        <h5 style="margin: 0;">Crear Nueva Zona</h5>
        <input type="text" id="descripcionzona" placeholder="Descripción" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
        <button class="btn btn-sm btn-primary" onclick="crearZona()">Crear</button>
        <button class="btn btn-sm btn-primary" onclick="cerrarModalZona()">Cancelar</button>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        console.log(tooltipTriggerList);
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
    </script>