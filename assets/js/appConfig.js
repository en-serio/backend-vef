function addZone(id, descripcion, tipoLista) {
    let lista;
    let tipo;
    if(tipoLista == 'zonas') {
        tipo= 1;
        lista = document.getElementById('lista-zonas');
    }else{
        tipo = 2;
        lista = document.getElementById('lista-tipos');
    }
    const nuevaZona = document.createElement('li');
    nuevaZona.style.display = 'flex';
    nuevaZona.style.alignItems = 'center';
    nuevaZona.style.justifyContent = 'space-between';
    nuevaZona.style.padding = '10px';
    nuevaZona.style.borderBottom = '1px solid #ccc';

    const cntZona = document.createElement('div');
    if(tipoLista == 'zonas') {
        cntZona.id = 'zona-' + id;
    }else{
        cntZona.id = 'tipo-' + id;
    }
    cntZona.style.display = 'flex';
    cntZona.style.flex = '1';
    cntZona.style.justifyContent = 'flex-start';

    const idZona = document.createElement('span');
    idZona.textContent = id;
    idZona.style.width = '4rem';
    idZona.style.textAlign = 'left';
    
    const separador = document.createElement('span');
    separador.textContent = '|';

    const descZona = document.createElement('span');
    descZona.textContent = descripcion;
    descZona.style.flex = '1';
    descZona.style.textAlign = 'left';
    descZona.style.paddingLeft = '1rem';

    cntZona.appendChild(idZona);
    cntZona.appendChild(separador);
    cntZona.appendChild(descZona);

    nuevaZona.appendChild(cntZona);

    const editarBtn = document.createElement('button');
    editarBtn.textContent = 'Editar';
    editarBtn.style.marginLeft = '10px';
    editarBtn.style.padding = '5px 10px';
    editarBtn.style.backgroundColor = 'blue';
    editarBtn.style.color = 'white';
    editarBtn.style.border = 'none';
    editarBtn.style.borderRadius = '5px';
    editarBtn.style.cursor = 'pointer';
    if(tipo == 1) {
        editarBtn.onclick = function() { abrirModalUpdate(id, 1); };
    }else{
        editarBtn.onclick = function() { abrirModalUpdate(id, 2); };
    }

    const borrarBtn = document.createElement('button');
    borrarBtn.textContent = 'Borrar';
    borrarBtn.style.marginLeft = '10px';
    borrarBtn.style.padding = '5px 10px';
    borrarBtn.style.backgroundColor = 'red';
    borrarBtn.style.color = 'white';
    borrarBtn.style.border = 'none';
    borrarBtn.style.borderRadius = '5px';
    borrarBtn.style.cursor = 'pointer';
    if(tipo == 1) {
        borrarBtn.onclick = function() { borrarZona(id); };
    }else{
        borrarBtn.onclick = function() { borrarTipo(id); };
    }

    nuevaZona.appendChild(editarBtn);
    nuevaZona.appendChild(borrarBtn);

    lista.appendChild(nuevaZona);
}

async function borrarZona(id){
    try{
        let url = 'http://localhost/backend-vef/class/controller/otroTransfer.php?tipo=zona&id=' + id;
        const response = await fetch (url, {
            method: 'DELETE',
        });
        const datos = await response.json();
        if(datos.error) {
            console.error('Error al borrar');
            return;
        }
        document.getElementById('zona-' + id).parentNode.remove();
    } catch (error) {
        console.error('Error al realizar la solicitud:', error);
    }
}

async function borrarTipo(id){
    try{
        let url = 'http://localhost/backend-vef/class/controller/otroTransfer.php?tipo=tipo&id=' + id;
        const response = await fetch (url, {
            method: 'DELETE',
        });
        const datos = await response.json();
        if(datos.error) {
            console.error('Error al borrar');
            return;
        }
        document.getElementById('tipo-' + id).parentNode.remove();
    } catch (error) {
        console.error('Error al realizar la solicitud:', error);
    }
}

function abrirModalZona() {
    document.getElementById('nuevazonamodal').style.display = 'flex';
}

function abrirModalTransfer() {
    document.getElementById('nuevotransfermodal').style.display = 'flex';
}

function abrirModalUpdate(id, tipo) {
    document.getElementById('update-modal').style.display = 'flex';
    const btn = document.getElementById('update-btn');
    let div;
    if(tipo == 1) {
        document.getElementById('titulo-update').value = "Editar Zona";
        div = document.getElementById('zona-' + id);
        btn.setAttribute('data-tipo', 1);
    }else{
        document.getElementById('titulo-update').value = "Editar Tipo";
        div = document.getElementById('tipo-' + id);
        btn.setAttribute('data-tipo', 2);
    }
    btn.setAttribute('data-id', id);
    const input = document.getElementById('descripcion-update');
    const idSpan = document.getElementById('id-update');
    idSpan.innerText = id;
    let descripción = div.childNodes[2].textContent.trim();
    input.placeholder = descripción;
    input.value = descripción;
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

async function updateModal() {
    let descripcion = document.getElementById('descripcion-update').value;
    let id = document.getElementById('update-btn').getAttribute('data-id');
    let url = 'http://localhost/backend-vef/class/controller/otroTransfer.php';
    const tipobtn = document.getElementById('update-btn').getAttribute('data-tipo');
    const formData = new FormData();
    formData.append('id', id);
    if(tipobtn == 1) {
        formData.append('action', 'updateZona');
        formData.append('descripcion', descripcion);
    }else{
        formData.append('action', 'updateTipo');
        formData.append('Descripción', descripcion);
    }
    const response = await fetch (url, {
        method: 'POST',
        body: formData,
    })
    
    const datos = await response.json();
    if(datos.error) {
        alert('Error al actualizar');
        return;
    }
    llenarTipo(tipobtn, datos.data.id, datos.data.descripcion);
    cerrarModalUpdate();
}

function llenarTipo(tipo, id, desc){
    let div;
    if(tipo == 1) {
        div = document.getElementById('zona-' + id);
    } else {
        div = document.getElementById('tipo-' + id);
    }
    div.childNodes[2].textContent = desc;
}

async function crearZona() {
    let descripcion = document.getElementById('descripcionzona').value;
    let url = 'http://localhost/backend-vef/class/controller/otroTransfer.php';
    const formData = new FormData();
    formData.append('descripcion', descripcion);
    formData.append('action', 'postZona');
    const response = await fetch (url, {
        method: 'POST',
        body: formData,
    })
    
    const datos = await response.json();
    if(datos.error) {
        alert('Error al crear la zona');
        return;
    }
    addZone(datos.data.id, datos.data.descripcion, 'zonas');
    cerrarModalZona();
}

async function crearTipo() {
    let descripcion = document.getElementById('descripciontipo').value;
    let url = 'http://localhost/backend-vef/class/controller/otroTransfer.php';
    const formData = new FormData();
    formData.append('Descripción', descripcion);
    formData.append('action', 'postTipo');
    const response = await fetch (url, {
        method: 'POST',
        body: formData,
    })
    
    const datos = await response.json();
    if(datos.error) {
        alert('Error al crear la zona');
        return;
    }
    addZone(datos.data.id, datos.data.descripcion, 'tipos');
    cerrarModalTransfer();
}