function validateForm() {
    const requiredFields = ['userName', 'password'];
    let valid = true;

    $('.form-control').removeClass('is-invalid');
    $('.error-message').remove();

    requiredFields.forEach(field => {
        const fieldValue = document.getElementById(field).value;
        if (!fieldValue) {
            $(`#${field}`).addClass('is-invalid')
                .after(`<span class="error-message text-danger">Este campo es obligatorio.</span>`);
            valid = false;
        }
    });

    return valid;
}

$(document).ready(function () {
    login();
});

function login() {
    $(".loginBtn").off("click").on("click", function (event) {
        event.preventDefault();

        if (!validateForm()) return; // Valida el formulario antes de continuar

        const user = $("#userName").val();
        const pass = $("#password").val();

        // Token CSRF de Laravel
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.post("/login", {
            _token: csrfToken, 
            action: "login",
            userName: user,
            password: pass
        }, function (data) {
            try {
                if (!data.error) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: data.message,
                        timer: 3000,
                        timerProgressBar: true,
                    }).then(() => {
                        window.location.href = '/dashboard';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                    });
                }
            } catch (e) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Error en la respuesta del servidor.",
                });
            }
        }).fail(function (xhr) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Error al comunicarse con el servidor.",
            });
        });
    });
}

$(document).ready(function () {
    login();
});


