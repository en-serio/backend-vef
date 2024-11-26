function addHotel(id, descripcion, comi, user, nombre, direc) {
    const lista = document.getElementById('lista-hotel');
    const nuevoHotel = document.createElement('li');
    nuevoHotel.style.display = 'flex';
    nuevoHotel.style.alignItems = 'center';
    nuevoHotel.style.justifyContent = 'space-between';
    nuevoHotel.style.padding = '10px';
    nuevoHotel.style.borderBottom = '1px solid #ccc';

    const cntHotel = document.createElement('div');
    cntHotel.id = 'hotel-' + id;
    cntHotel.style.display = 'flex';
    cntHotel.style.flex = '1';
    cntHotel.style.justifyContent = 'flex-start';

    const hotelInfo = [
        { text: id, width: '4rem' },
        { text: nombre, width: '10rem', paddingLeft: '1rem' },
        { text: descripcion, width: '6rem', paddingLeft: '1rem' },
        { text: comi, width: '6rem', paddingLeft: '1rem' },
        { text: user, width: '10rem', paddingLeft: '1rem' },
        { text: direc, flex: '1', paddingLeft: '1rem' }
    ];

    const createSpan = ({ text, width, paddingLeft, flex }) => {
        const span = document.createElement('span');
        span.textContent = text;
        span.style.width = width || 'auto';
        span.style.paddingLeft = paddingLeft || '0';
        span.style.flex = flex || 'none';
        span.style.textAlign = 'left';
        return span;
    };

    hotelInfo.forEach((info, index) => {
        const span = createSpan(info);
        cntHotel.appendChild(span);

        if (index < hotelInfo.length - 1) {
            const separador = document.createElement('span');
            separador.textContent = '|';
            cntHotel.appendChild(separador);
        }
    });

    nuevoHotel.appendChild(cntHotel);

    const editarBtn = document.createElement('button');
    editarBtn.textContent = 'Editar';
    editarBtn.style.marginLeft = '10px';
    editarBtn.style.padding = '5px 10px';
    editarBtn.style.backgroundColor = 'blue';
    editarBtn.style.color = 'white';
    editarBtn.style.border = 'none';
    editarBtn.style.borderRadius = '5px';
    editarBtn.style.cursor = 'pointer';
    editarBtn.onclick = function() { abrirModalUpdate(id); };

    const borrarBtn = document.createElement('button');
    borrarBtn.textContent = 'Borrar';
    borrarBtn.style.marginLeft = '10px';
    borrarBtn.style.padding = '5px 10px';
    borrarBtn.style.backgroundColor = 'red';
    borrarBtn.style.color = 'white';
    borrarBtn.style.border = 'none';
    borrarBtn.style.borderRadius = '5px';
    borrarBtn.style.cursor = 'pointer';
    borrarBtn.onclick = function() { borrarHotel(id); };

    nuevoHotel.appendChild(editarBtn);
    nuevoHotel.appendChild(borrarBtn);

    lista.appendChild(nuevoHotel);
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

function abrirModalUpdate(id) {
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
}

function cerrarModalHotel() {
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
}

function cerrarUpdateHotel() {
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

}

async function updateHotel() {
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
}

function llenarTipo(id, zona, comision, usuario, nombre, direccion){
    let div;
    div = document.getElementById('hotel-' + id);
    div.childNodes[2].textContent = nombre;
    // let zonaTxt = getZona(zona);
    div.childNodes[4].textContent = zona;
    div.childNodes[6].textContent = comision;
    div.childNodes[8].textContent = usuario;
    div.childNodes[10].textContent = direccion;
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

async function crearHotel() {
    let nombre = document.getElementById('nombre-hotel').value;
    let zona = document.getElementById('zona-hotel').value;
    let comision = document.getElementById('comision-hotel').value;
    let user = document.getElementById('usuario-hotel').value;
    let dir = document.getElementById('direccion-hotel').value;
    let url = 'http://localhost/backend-vef/class/controller/otroTransfer.php';
    const formData = new FormData();
    formData.append('nombre_hotel', nombre);
    formData.append('direccion_hotel', dir);
    formData.append('Comision', comision);
    formData.append('usuario', user);
    formData.append('id_zona', zona);
    formData.append('action', 'postHotel');
    const response = await fetch (url, {
        method: 'POST',
        body: formData,
    })
    
    const datos = await response.json();
    if(datos.error) {
        alert('Error al crear el hotel');
        return;
    }
    addHotel(datos.data.id, datos.data.id_zona, datos.data.Comision, datos.data.usuario, datos.data.nombre_hotel, datos.data.direccion_hotel);
    cerrarModalHotel();
}
