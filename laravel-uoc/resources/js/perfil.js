function validateForm() {
    const requiredFields = ['email', 'password', 'passwordRepeat', 'nomCli', 'apellido1Cliente', 'apellido2Cliente', 'user', 'telefono'];
    let valid = true;

    $('.form-control').removeClass('is-invalid');
    $('.error-message').remove();

    requiredFields.forEach(field => {
        const fieldValue = document.getElementById(field).value.trim();  // .trim() para eliminar espacios
        if (!fieldValue) {
            $(`#${field}`).addClass('is-invalid')
                .after(`<span class="error-message text-danger">Este campo es obligatorio.</span>`);
            valid = false;
        }
    });

    const email = $('#email').val().trim();
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (email && !emailRegex.test(email)) {
        $('#email').addClass('is-invalid')
            .after(`<span class="error-message text-danger">Por favor ingrese un correo electrónico válido.</span>`);
        valid = false;
    }

    const password = $('#password').val().trim();
    const repeatPassword = $('#passwordRepeat').val().trim();
    if (password !== repeatPassword) {
        $('#passwordRepeat').addClass('is-invalid')
            .after(`<span class="error-message text-danger">Las contraseñas no coinciden.</span>`);
        valid = false;
    }


    const telefono = $('#telefono').val().trim();
    const telefonoRegex = /^[0-9]+$/; // solo números
    if (telefono && !telefonoRegex.test(telefono)) {
        $('#telefono').addClass('is-invalid')
            .after(`<span class="error-message text-danger">El teléfono debe contener solo números.</span>`);
        valid = false;
    }

    if (telefono && telefono.length < 9) {
        $('#telefono').addClass('is-invalid')
            .after(`<span class="error-message text-danger">El número de teléfono debe tener al menos 9 dígitos.</span>`);
        valid = false;
    }

    return valid;
}



function loadPerfil() {
    
    $.post("../class/controller/perfilCtrl.php", {controller: "perfilCtrl", action: "loadPerfil"}, function (data) {
        
        try {
            var d = JSON.parse(data);

            if (!d.error) {
                $('#dynamicContent').html(d.out);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: d.message,
                });
            }
        } catch (e) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: e.message,
            });
        }
    });
}

function savePerfil() {
           
        event.preventDefault();
       if (!validateForm()) return;

    var nombre = $('#nomCli').val();
    var apellido1 = $('#apellido1Cliente').val();
    var apellido2 = $('#apellido2Cliente').val();
    var usuario = $('#user').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var tel = $('#telefono').val();
    var DNI = $('#DNI').val();
    var passwordRepeat = $('#passwordRepeat').val();
    var id = $('#clienteId').val();

    $.post("../class/controller/perfilCtrl.php", {controller: "perfilCtrl", action: "savePerfil", nombre:nombre, apellido1:apellido1, apellido2:apellido2, tel:tel, usuario:usuario, email:email, password:password, id:id, DNI:DNI}, function (data) {

        try {
            var d = JSON.parse(data);

            if (!d.error) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: d.message, 
                })

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: d.message,
                });
            }
        } catch (e) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: e.message,
            });
        }
    });
}

$(document).ready(function () {
    // Asignar evento al botón perfil (cuando se hace clic en cargar perfil)
    $(".perfilPanel").on("click", function (e) {
        loadPerfil();
    });

    $(document).on("click", ".savePerfilBtn", function (e) {
        e.preventDefault();
        savePerfil();
    });
});