// Función para validar el formulario de registro
function validateForm() {
    const email = $('#email').val();
    const confirmEmail = $('#confirmEmail').val();
    const password = $('#password').val();
    const confirmPassword = $('#confirmPassword').val();
    const phone = $('#telefono').val();

    const requiredFields = ['userName', 'nombre', 'apellido1', 'apellido2', 'claveRol', 'telefono', 'email', 'password'];
    let valid = true;

    // Limpiar mensajes de error previos
    $('.form-control').removeClass('is-invalid');
    $('.error-message').remove();

    // Validación de campos requeridos
    requiredFields.forEach(field => {
        const fieldValue = $(`#${field}`).val();
        if (!fieldValue) {
            $(`#${field}`).addClass('is-invalid')
                .after('<span class="error-message text-danger">Este campo es obligatorio.</span>');
            valid = false;
        }
    });

    // Validación del email
    if (email !== confirmEmail) {
        $('#email, #confirmEmail').addClass('is-invalid')
            .after('<span class="error-message text-danger">Los correos electrónicos no coinciden.</span>');
        valid = false;
    }

    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        $('#email').addClass('is-invalid')
            .after('<span class="error-message text-danger">Introduce un correo electrónico válido.</span>');
        valid = false;
    }

    // Validación del teléfono (solo números)
    const phonePattern = /^[0-9]+$/;
    if (!phonePattern.test(phone)) {
        $('#telefono').addClass('is-invalid')
            .after('<span class="error-message text-danger">Introduce un número de teléfono válido.</span>');
        valid = false;
    }

    // Validación de contraseñas
    if (password !== confirmPassword) {
        $('#password, #confirmPassword').addClass('is-invalid')
            .after('<span class="error-message text-danger">Las contraseñas no coinciden.</span>');
        valid = false;
    }

    if (password.length < 8) {
        $('#password').addClass('is-invalid')
            .after('<span class="error-message text-danger">La contraseña debe tener al menos 8 caracteres.</span>');
        valid = false;
    }

    return valid;
}

// Función principal del registro
function register() {
    $(".registroBtn").on("click", function (event) {
        event.preventDefault();

        if (!validateForm()) return;

        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        const data = {
            user: $("#userName").val(),
            pass: $("#password").val(),
            nombre: $("#nombre").val(),
            apellido1: $("#apellido1").val(),
            apellido2: $("#apellido2").val(),
            rol: $("#claveRol").val(),
            tel: $("#telefono").val(),
            email: $("#email").val()
        };

        // Petición POST al backend de Laravel
        $.post({
            url: '/register', // Ruta en Laravel donde se procesa el registro
            method: 'POST',
            data: data,
            headers: { 'X-CSRF-TOKEN': csrfToken },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: response.message || 'Usuario registrado correctamente.',
                    timer: 3000,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = '/login'; // Redirige a la ruta login de Laravel
                });
            },
            error: function (xhr) {
                const errors = xhr.responseJSON ? xhr.responseJSON.errors : {};
                Object.keys(errors).forEach(field => {
                    $(`#${field}`).addClass('is-invalid')
                        .after(`<span class="error-message text-danger">${errors[field][0]}</span>`);
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message || 'Ha ocurrido un error en el registro.',
                });
            }
        });
    });
}

// Inicialización
$(document).ready(function () {
    register();

    // Inicializar tooltips de Bootstrap
    $('[data-bs-toggle="tooltip"]').tooltip();
});