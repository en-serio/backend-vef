<h5>Agregar vehículo</h5>
<div class="row">
    <div class="col-6">
        <form id="priceForm" method="post">
            <!-- ID Vehículo -->
            <div class="mb-3">
                <label for="idVehiculo" class="form-label">ID Vehículo</label>
                <input type="number" class="form-control form-control-lg" id="idVehiculo" name="idVehiculo" required>
            </div>

            <!-- ID Hotel -->
            <div class="mb-3">
                <label for="descripcionVehiculo" class="form-label">Descripción</label>
                <input type="number" class="form-control form-control-lg" id="idDescripcion" name="idDescripcion" required>
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control form-control-lg" id="precio" name="precio" required>
            </div>

            <!-- Botón Guardar -->
            <div class="col-3 mt-4">
                <button type="button" class="btn btn-primary btn-lg" id="savePrecioBtn">Guardar Precio</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>