function validateForm() {
    const email = document.getElementById('email').value;
    const confirmEmail = document.getElementById('confirmEmail').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const phone = document.getElementById('telefono').value;
    const requiredFields = ['userName', 'nombre', 'apellido1', 'apellido2', 'claveRol', 'telefono', 'email', 'password'];
    let valid = true;

     // Limpiar mensajes previos de error y estilos
     $('.form-control').removeClass('is-invalid');
     $('.error-message').remove(); // Elimina mensajes de error previos
 
     // Validación de campos requeridos (no vacíos)
     requiredFields.forEach(field => {
         const fieldValue = document.getElementById(field).value;
         if (!fieldValue) {
             $(`#${field}`).addClass('is-invalid')
                 .after(`<span class="error-message text-danger">Este campo es obligatorio.</span>`);
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

    // Verificación de la longitud mínima de la contraseña
    if (password.length < 8) {
        $('#password').addClass('is-invalid')
            .after('<span class="error-message text-danger">La contraseña debe tener al menos 8 caracteres.</span>');
        valid = false;
    }

    return valid;
}


$(document).ready(function() {
    register();
});


 function register(){
    
    $(".registroBtn").on("click", function (event) {
        event.preventDefault(); 

            if (!validateForm()) return;
        
            var user = $("#userName").val();
            var pass = $("#password").val();
            var nombre = $("#nombre").val();
            var apellido1 = $("#apellido1").val();
            var apellido2 = $("#apellido2").val();
            var rol = $("#claveRol").val();
            var tel = $("#telefono").val();
            var email = $("#email").val();


    
            $.post("../class/controller/registroCtrl.php", {controller: "registroCtrl", action: "registro", 
                user:user, pass:pass, nombre:nombre, apellido1:apellido1, 
                apellido2:apellido2, rol:rol, tel:tel, email:email}, function (data) {
                try {
                    var d = JSON.parse(data);
    
                    if (!d.error) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: d.message,
                            timer: 3000,  
                            timerProgressBar: true, 
                        }).then(() => {
                            window.location.href = '../views/login.php'; 
                        });
                    
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
        
    });
}
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
    
