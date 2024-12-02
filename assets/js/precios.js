
function loadPrecios() {
    
    $.post("../class/controller/preciosCtrl.php", {controller: "preciosCtrl", action: "loadPrecios"}, function (data) {
        
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


$(document).ready(function () {
    // Asignar evento al botón perfil (cuando se hace clic en cargar perfil)
    $(".preciosBtn").on("click", function (e) {
        e.preventDefault();
        loadPrecios();
    });

})