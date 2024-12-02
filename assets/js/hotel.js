
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

/*function abrirModalUpdate(id) {
    document.getElementById('update-modal-hotel').style.display = 'flex';
    document.getElementById('titulo-update').value = "Editar Hotel";
    let div = document.getElementById('hotel-' + id);
    const idSpan = document.getElementById('id-hotel-update');
    const inNombre = document.getElementById('nombre-hotel-update');
    const inZona = document.getElementById('zona-hotel-update');
    const inComision = document.getElementById('comision-hotel-update');
    const inUsuario = document.getElementById('usuario-hotel-update');
    const inDireccion = document.getElementById('direccion-hotel-update');
    idSpan.innerText = id;
    inNombre.value = div.children[2].textContent.trim();
    inZona.value = div.children[4].textContent.trim();
    inComision.value = div.children[6].textContent.trim();
    inUsuario.value = div.children[8].textContent.trim();
    inDireccion.value = div.children[10].textContent.trim();
    
    console.log(div.children[2].textContent);
    console.log(div.children[4].textContent);
    console.log(div.children[6].textContent);
    console.log(div.children[8].textContent);
    console.log(div.children[10].textContent);
}*/

/*function cerrarModalHotel() {
    document.getElementById('nuevo-hotel-modal').style.display = 'none';
    const input = document.getElementById('nombre-hotel');
    input.value = '';
    const select = document.getElementById('zona-hotel');
    select.value = '';
    const comision = document.getElementById('comision-hotel');
    comision.value = '';
    const usuario = document.getElementById('usuario-hotel');
    usuario.value = '';
    const direccion = document.getElementById('direccion-hotel');
    direccion.value = '';
}*/

/*function cerrarUpdateHotel() {
    document.getElementById('update-modal-hotel').style.display = 'none';
    const input = document.getElementById('nombre-hotel-update');
    input.value = '';
    const select = document.getElementById('zona-hotel-update');
    select.value = '';
    const comision = document.getElementById('comision-hotel-update');
    comision.value = '';
    const usuario = document.getElementById('usuario-hotel-update');
    usuario.value = '';
    const direccion = document.getElementById('direccion-hotel-update');
    direccion.value = '';

}*/

/*async function updateHotel() {
    const input = document.getElementById('nombre-hotel-update');
    const select = document.getElementById('zona-hotel-update');
    const comision = document.getElementById('comision-hotel-update');
    const usuario = document.getElementById('usuario-hotel-update');
    const direccion = document.getElementById('direccion-hotel-update');
    const idSpan = document.getElementById('id-hotel-update');
    let url = 'http://localhost/backend-vef/class/controller/otroTransfer.php';
    const formData = new FormData();
    formData.append('action', 'updateHotel');
    formData.append('id_hotel', idSpan.innerText);
    formData.append('nombre_hotel', input.value);
    formData.append('id_zona', select.value);
    formData.append('Comision', comision.value);
    formData.append('usuario', usuario.value);
    formData.append('direccion_hotel', direccion.value);
    const response = await fetch (url, {
        method: 'POST',
        body: formData,
    })
    
    const datos = await response.json();
    if(datos.error) {
        alert(datos.message);
        return;
    }
    llenarTipo(datos.data.id, datos.data.id_zona, datos.data.Comision, datos.data.usuario, datos.data.nombre_hotel, datos.data.direccion_hotel);
    cerrarUpdateHotel();
}*/

/*function llenarTipo(id, zona, comision, usuario, nombre, direccion){
    let div;
    div = document.getElementById('hotel-' + id);
    div.childNodes[2].textContent = nombre;
    // let zonaTxt = getZona(zona);
    div.childNodes[4].textContent = zona;
    div.childNodes[6].textContent = comision;
    div.childNodes[8].textContent = usuario;
    div.childNodes[10].textContent = direccion;
}*/

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
        <td>${hotel.nombre_hotel}</td>
        <td>${hotel.Comision}</td>
        <td>${hotel.usuario}</td>
        <td>${hotel.id_zona}</td>
        <td>${hotel.direccion_hotel}</td>
        <td>${hotel.id_hotel}</td>
        <td>
            <button class="btn btn-sm btn-danger borrarZonaBtn" data-id="${hotel.id_hotel}" onclick="borrarZona(${hotel.id_hotel})">Borrar</button>
        </td>
    </tr>`;

$('#dynamicContent tbody').append(nuevaFila);
}

function crearHotel()
{
    const nombreHotel = document.getElementById('nombre-hotel').value;
    const zonaHotel = document.getElementById('zona-hotel').value;
    const zonaHotelNumero = zonaHotel.split(' - ')[0];
    const comisionHotel = document.getElementById('comision-hotel').value;
    const direccionHotel = document.getElementById('direccion-hotel').value;

    $.post("../class/controller/settingsCtrl.php", {controller: "settingsCtrl", action: "createHotel", nombreHotel:nombreHotel, zonaHotelNumero:zonaHotelNumero, 
        comisionHotel:comisionHotel, direccionHotel:direccionHotel}, function (data) {
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