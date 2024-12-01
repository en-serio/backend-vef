
async function borrarZona(idZona){    

    Swal.fire({
        title: "Vas a eliminar una zona",
        text: "Esta acción no puede deshacerse.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar zona"
    }).then((result) => {
        // Si el usuario confirma la eliminación
        if (result.isConfirmed) {

    $.post("../class/controller/settingsCtrl.php", {controller: "settingsCtrl", action: "deleteZona", idZona:idZona}, function (data) {
    
        try {
            var d = JSON.parse(data);  
            if (!d.error) {  
                Swal.fire({
                    title: "Zona eliminada correctamente!",
                    icon: "success"
                });
                $('[data-id="' + idZona + '"]').closest('tr').remove();
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
});
}

async function updateZona(){    

    const idZona = $('#update-btn').attr('data-id');
    var descripcion = $('#descripcion-update').val();

    $.post("../class/controller/settingsCtrl.php", {controller: "settingsCtrl", action: "updateZona", idZona:idZona, descripcion:descripcion}, function (data) {
    
        try {
            var d = JSON.parse(data);  
            if (!d.error) {  
                Swal.fire({
                    title: "Zona actualizada correctamente!",
                    icon: "success"
                });

                $('[data-id="' + idZona + '"]').closest('tr').find('td').eq(1).text(descripcion);
                cerrarModalUpdate();

            }else{
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

function abrirModalZona() {
    document.getElementById('nuevazonamodal').style.display = 'flex';
}

function abrirModalUpdate(id, tipo) {
    document.getElementById('update-modal').style.display = 'flex';
    
    const btn = document.getElementById('update-btn');
    let div;
    
        document.getElementById('titulo-update').innerText = "Nuevo nombre de la Zona";    
    // Establecer el ID como atributo en el botón (no visible)
    btn.setAttribute('data-id', id);

    // Actualizar el campo de nombre
    const input = document.getElementById('descripcion-update');
    let descripcion = div.childNodes[2].textContent.trim();
    input.placeholder = "Escribe el nuevo nombre";
    input.value = descripcion;
    
}

function cerrarModalZona() {
    document.getElementById('nuevazonamodal').style.display = 'none';
}

function cerrarModalTransfer() {
    document.getElementById('nuevotransfermodal').style.display = 'none';
}

function cerrarModalUpdate() {
    document.getElementById('update-modal').style.display = 'none';
    const input = document.getElementById('descripcion-update');
    input.value = '';
    const btn = document.getElementById('update-btn');
    btn.setAttribute('data-id', '');
}

function agregarZona(zona)
{
    console.log(zona);
    const nuevaFila = `
    <tr>
        <td>${zona.id_zona}</td>
        <td>${zona.descripcion}</td>
        <td>
            <button class="btn btn-sm btn-danger borrarZonaBtn" data-id="${zona.id_zona}" onclick="borrarZona(${zona.id_zona})">Borrar</button>
        </td>
    </tr>
`;

$('#dynamicContent tbody').append(nuevaFila);
}

function crearZona() {

    const descripcion = document.getElementById('descripcionzona').value;
    
    $.post("../class/controller/settingsCtrl.php", {controller: "settingsCtrl", action: "createZona",descripcion:descripcion}, function (data) {
        try {
            var d = JSON.parse(data);

            if (!d.error) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: d.message,   
                })
                agregarZona(d.zona);
                cerrarModalZona();

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

function drawZonas() {
    $.post("../class/controller/settingsCtrl.php", {controller: "settingsCtrl", action: "loadZonas"}, function (data) {
        try {
            var d = JSON.parse(data);

            if (!d.error) {
                $('#dynamicContent').html(d.out);  
                $("#dynamicContent").on("click", ".borrarZonaBtn", function () {
                    const idZona = $(this).attr('data-id'); 
                    borrarZona(idZona);
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
}

function initTiposTransfers()
{   
    $.post("../class/controller/settingsCtrl.php", {controller: "settingsCtrl", action: "initTipoTransfers"}, function (data) {
        try {
            var d = JSON.parse(data);

            if (!d.error) {
                Swal.fire({
                    icon: 'success',
                    title: 'Inicializadas correctamente',
                    text: d.message,
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

}

