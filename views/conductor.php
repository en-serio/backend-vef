    <h5>Perfil</h5>
        <div class="row">
            <div class="col-6">
                <form id="profileForm" method="post">
                    <!-- Nombre completo -->
                    <div class="mb-3">
                        <label for="userName" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control form-control-lg" id="userName" name="userName" value="Juan Pérez" required>
                    </div>

                    <!-- Usuario -->
                    <div class="mb-3">
                        <label for="user" class="form-label">Usuario</label>
                        <input type="text" class="form-control form-control-lg" id="user" name="user" value="juanperez123" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" value="juan.perez@example.com" required>
                    </div>

                    <!-- Repetir Email -->
                    <div class="mb-3">
                        <label for="emailRepeat" class="form-label">Repite el correo electrónico</label>
                        <input type="email" class="form-control form-control-lg" id="emailRepeat" name="emailRepeat" value="juan.perez@example.com" required>
                    </div>

                 
                </div>
                    <div class="col-3">
                           <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" value="123456" required>
                        </div>

                        <!-- Repetir Contraseña -->
                        <div class="mb-3">
                            <label for="passwordRepeat" class="form-label">Repite la contraseña</label>
                            <input type="password" class="form-control form-control-lg" id="passwordRepeat" name="passwordRepeat" value="123456" required>
                        </div>
                    </div>
                
                    <div class="col-3 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg ">Guardar Cambios</button>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
