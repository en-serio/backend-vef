
    <h5>Hotel</h5>
        <h6>Aquí puedes ver la lista de todos los hoteles que hay actualmente y dar de alta a nuevos.</h6>
        <div class="row">
            <div class="col-6">
                <form id="profileForm" method="post">
                    
                </form>
            </div>
        </div>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/clienteEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferHotelEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/settingsCtrl.php';

?>
    <div style="display: flex; flex-direction: column; padding: 20px;">
        <h6>Configuración de Hoteles</h6>
        <div style="display: flex; justify-content: flex-start; margin-bottom: 20px;">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoHotelModal">Crear Nuevo Hotel</button>
        </div>
        <div style="background-color: #f0f0f0; padding: 15px; border-radius: 5px;">
            <h6>Listado de hoteles disponibles</h6>
                <?php $settings = new SettingsCtrl;
                  $settings->mostrarHoteles(); ?>
            </ul>
        </div>
        
    </div>
</div>

<div class="modal fade" id="nuevoHotelModal" tabindex="-1" aria-labelledby="nuevoHotelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nuevoHotelModalLabel">Crear Nuevo Hotel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="crearHotelForm">
         <div class = "row">
            <div class="col-12 mb-3">
                <label for="nombre-hotel" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre-hotel" placeholder="Nombre del hotel" required>
            </div>
            <div class="col-12 mb-3">
                <label for="direccion-hotel" class="form-label">Dirección:</label>
                <input type="text" class="form-control" id="direccion-hotel" placeholder="Dirección" required>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-3">
              <label for="zona-hotel" class="form-label">Zona:</label>
              <select class="form-select" id="zona-hotel" required>
                <option value="" disabled selected>Selecciona una zona</option>
                <?php 
                  $settings = new SettingsCtrl;
                  $settings->getZonas(); 
                ?>
              </select>
            </div>
            <div class="col-6 mb-3">
              <label for="comision-hotel" class="form-label">Comisión:</label>
              <input type="number" class="form-control" id="comision-hotel" placeholder="10.5" step="0.01" lang="en" required>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-3">
              <label for="usuariosCorporativos" class="form-label">Usuario:</label>
              <select class="form-select" id="usuariosCorporativos" required>
                <option value="" disabled selected>Asigna el hotel un usuario</option>
                <?php 
                  $settings = new SettingsCtrl;
                  $settings->getUsuarios(); 
                ?>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardarHotelBtn" onclick="crearHotel()">Crear</button>
      </div>
    </div>
  </div>
</div>

<div id="update-modal-hotel" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px; display: flex; flex-direction: column; gap: 10px;">
        <h5 id="titulo-update" style="margin: 0;"></h5>
        <p>Id: <span id=id-hotel-update></span></p>
        <label for="nombre-hotel-update">Nombre: <input type="text" id="nombre-hotel-update" placeholder="Nombre del hotel" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></label>
        <label for="zona-hotel-update">Zona: <select name="zona-hotel" id="zona-hotel-update">
            <option value="">Selecciona una zona</option>
            <?php $settings = new SettingsCtrl;
                $settings->getZonas(); ?>
        </select>
        </label>
        <label for="comision-hotel-update">Comisión: <input type="number" id="comision-hotel-update" placeholder="10.5" ></label>
        <label for="usuario-hotel-update">Usuario: <input type="email" id="usuario-hotel-update" placeholder="user@user.com" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></label>
        <label for="direccion-hotel-update">Dirección: <input type="text" id="direccion-hotel-update" placeholder="Dirección" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></label>


        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <button id="update-btn" onclick="updateHotel()" style="flex: 1; padding: 8px; background-color: green; color: white; border: none; border-radius: 5px; cursor: pointer;">Cambiar</button>
            <button onclick="cerrarUpdateHotel()" style="flex: 1; padding: 8px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Cancelar</button>
        </div>
    </div>
</div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

 
