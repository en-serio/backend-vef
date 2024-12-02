function validateForm() {
    
    const requiredFields = ['userName', 'password'];
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
     
 
    return valid;
}

    $(document).ready(function() {
        login(); // Llama a la función login
    });


 function login(){
    $(".loginBtn").on("click", function (event) {
        
        event.preventDefault();
        if (!validateForm()) return;

        const user = $("#userName").val();
        const pass = $("#password").val();

            $.post("../class/controller/loginCtrl.php", {controller: "loginCtrl", action: "login", user: user, pass: pass}, function (data) {
                try {

                    console.log(data);
                    var d= JSON.parse(data);
    
                    if (!d.error) {
                        
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: d.message,
                            timer: 3000,  
                            timerProgressBar: true, 
                        }).then(() => {
                            window.location.href = 'dashboard.php'; 
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


