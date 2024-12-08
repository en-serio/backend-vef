function validaCamposHotel() {
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(msg => msg.remove());

    const nombreHotel = document.getElementById('nombre-hotel').value.trim();
    const zonaHotel = document.getElementById('zona-hotel').value.trim();
    const comisionHotel = document.getElementById('comision-hotel').value.trim();
    const direccionHotel = document.getElementById('direccion-hotel').value.trim();
    const usuario = document.getElementById('usuariosCorporativos').value.trim();
    
    let valid = true;

    if (!nombreHotel) {
        showError('nombre-hotel', 'Este campo es obligatorio');
        valid = false;
    }
    if (!zonaHotel) {
        showError('zona-hotel', 'Este campo es obligatorio');
        valid = false;
    }
    if (!comisionHotel) {
        showError('comision-hotel', 'Este campo es obligatorio');
        valid = false;
    }
    if (!direccionHotel) {
        showError('direccion-hotel', 'Este campo es obligatorio');
        valid = false;
    }
    if (!usuario) {
        showError('usuariosCorporativos', 'Este campo es obligatorio');
        valid = false;
    }

    return valid;
}


function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    
    const errorMessage = document.createElement('div');
    errorMessage.classList.add('error-message');
    errorMessage.style.color = 'red'; 
    errorMessage.innerText = message;
    
    field.parentNode.appendChild(errorMessage);
}


async function borrarHotel(id){
    try{
        let url = 'http://localhost/backend-vef/class/controller/otroTransfer.php?tipo=hotel&id_hotel=' + id;
        const response = await fetch (url, {
            method: 'DELETE',
        });
        const datos = await response.json();
        if(datos.error) {
            console.error('Error al borrar');
            return;
        }
        document.getElementById('hotel-' + datos.data.id).parentNode.remove();
    } catch (error) {
        console.error('Error al realizar la solicitud:', error);
    }
}

function nuevoHotel() {
    document.getElementById('nuevo-hotel-modal').style.display = 'flex';
}

async function getZona(id) {
    try{
        let url = 'http://localhost/backend-vef/class/controller/otroTransfer.php?action=getZona&id=' + id;
        const response = await fetch (url);
        const datos = await response.json();
        if(datos.error) {
            console.error('Error al obtener las zonas');
            return;
        }
        return datos.data.descripcion;
    } catch (error) {
        console.error('Error al realizar la solicitud:', error);
    }
}

function agregarHotel(hotel)
{
    const nuevaFila = `
    <tr>
        <td>-</td>
        <td>${hotel.nombre_hotel}</td>
        <td>${hotel.id_zona}</td>
        <td>${hotel.comision}</td>
        <td>${hotel.direccion_hotel}</td>
        
    </tr>`;

$('#dynamicContent tbody').append(nuevaFila);
}

function crearHotel()
{
    if(!validaCamposHotel())
        {
            return;
        }
    const nombreHotel = document.getElementById('nombre-hotel').value;
    const zonaHotel = document.getElementById('zona-hotel').value;
    const zonaHotelNumero = zonaHotel.split(' - ')[0];
    const comisionHotel = document.getElementById('comision-hotel').value;
    const direccionHotel = document.getElementById('direccion-hotel').value;
    const usuario = document.getElementById('usuariosCorporativos').value;

    $.post("../class/controller/settingsCtrl.php", {controller: "settingsCtrl", action: "createHotel", nombreHotel:nombreHotel, zonaHotelNumero:zonaHotelNumero, 
        comisionHotel:comisionHotel, direccionHotel:direccionHotel, usuario:usuario}, function (data) {
        try {
            var d = JSON.parse(data);
            if (!d.error) {
                Swal.fire({
                    icon: 'success',
                    title: 'Hotel creado correctamente',
                    text: d.message,
                });
                agregarHotel(d.hotel);
                $('#nuevoHotelModal').modal('hide');
                $('.modal-backdrop').remove();

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