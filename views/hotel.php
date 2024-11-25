<?php
function getHoteles() {
    $url = 'http://localhost/backend-vef/class/controller/otroTransfer.php?action=getHoteles';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "Error al obtener las zonas: " . curl_error($ch);
        curl_close($ch);
        return;
    }
    curl_close($ch);
    
    $hoteles = json_decode($response, true);
    
    return $hoteles;

}

function mostrarHoteles(){
    $hoteles = getHoteles();
    if (!empty($hoteles) && is_array($hoteles)) {
        foreach ($hoteles as $hotel) {
            echo '<li style="display: flex; align-items: center; justify-content: space-between; padding: 10px; border-bottom: 1px solid #ccc;">';
            
            echo '<div style="display: flex; flex: 1; justify-content: flex-start;" id="hotel-'. htmlspecialchars($hotel['id_hotel']) .'">';
            echo '<span style="width: 4rem; text-align: left;">' . htmlspecialchars($hotel['id_hotel']) . '</span>';
            echo '<span>|</span>';
            echo '<span style="width: 8rem; text-align: left; padding-left: 1rem;">' . htmlspecialchars($hotel['nombre_hotel']) . '</span>';
            echo '<span>|</span>';
            echo '<span style="width: 6rem; text-align: left; padding-left: 1rem;">' . htmlspecialchars($hotel['id_zona']) . '</span>';
            echo '<span>|</span>';
            echo '<span style="width: 6rem; text-align: left; padding-left: 1rem;">' . htmlspecialchars($hotel['Comision']) . '</span>';
            echo '<span>|</span>';
            echo '<span style="width: 10rem; text-align: left; padding-left: 1rem;">' . htmlspecialchars($hotel['usuario']) . '</span>';
            echo '<span>|</span>';
            echo '<span style="flex: 1; text-align: left; padding-left: 1rem;">' . htmlspecialchars($hotel['direccion_hotel']) . '</span>';
            echo '</div>';
    
            echo '<button style="margin-left: 10px; padding: 5px 10px; background-color: blue; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="abrirModalUpdate('. $hotel['id_hotel'] .')">Editar</button>';
            echo '<button style="margin-left: 10px; padding: 5px 10px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="borrarHotel('. $hotel['id_hotel'] .')">Borrar</button>';
            
            echo '</li>';
        }
    } else {
        
    }
}

function getZonas(){
    $url = 'http://localhost/backend-vef/class/controller/otroTransfer.php?action=getZonas';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "Error al obtener las zonas: " . curl_error($ch);
        curl_close($ch);
        return;
    }

    curl_close($ch);

    $zonas = json_decode($response, true);
    if (!empty($zonas) && is_array($zonas)) {
        foreach ($zonas as $zona) {
            echo '<option value="'. htmlspecialchars($zona['id_zona']) .'">'. htmlspecialchars($zona['id_zona']) . ' - ' . htmlspecialchars($zona['descripcion']) .'</option>';
        }
    }
}
?>
<div>
    <h4>Hoteles</h4>
    <div style="display: flex; flex-direction: column; padding: 20px;">
        <h6>Configuración de Hoteles</h6>
        <div style="display: flex; justify-content: flex-start; margin-bottom: 20px;">
            <button onclick="nuevoHotel()" style="padding: 10px 20px; background-color: green; color: white; border: none; border-radius: 5px; cursor: pointer;">Añadir Nuevo Hotel</button>
        </div>

        <div style="background-color: #f0f0f0; padding: 15px; border-radius: 5px;">
            <h6>Listado de Zonas</h6>
            <ul id="lista-hotel" style="list-style-type: none; padding-left: 0;">
                <li style="display: flex; align-items: center; justify-content: space-between; padding: 10px; border-bottom: 1px solid #ccc;">
                    <div style="display: flex; flex: 1; justify-content: flex-start;">
                        <span style="width: 4rem; text-align: left;">ID Hotel</span>
                        <span>|</span>
                        <span style="width: 8rem; text-align: left; padding-left: 1rem;">Nombre hotel</span>
                        <span>|</span>
                        <span style="width: 6rem; text-align: left; padding-left: 1rem;">Zona</span>
                        <span>|</span>
                        <span style="width: 6rem; text-align: left; padding-left: 1rem;">Comision</span>
                        <span>|</span>
                        <span style="width: 10rem; text-align: left; padding-left: 1rem;">Usuario</span>
                        <span>|</span>
                        <span style="flex: 1; text-align: left; padding-left: 1rem;">Dirección hotel</span>
                    </div>
                </li>
                <?php mostrarHoteles(); ?>
            </ul>
        </div>
    </div>
</div>
<div id="nuevo-hotel-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px; display: flex; flex-direction: column; gap: 10px;">
        <h5 style="margin: 0;">Crear Nuevo Hotel</h5>
    
        <label for="nombre-hotel">Nombre: <input type="text" id="nombre-hotel" placeholder="Nombre del hotel" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></label>
        <label for="zona-hotel">Zona: <select name="zona-hotel" id="zona-hotel">
            <option value="">Selecciona una zona</option>
            <?php getZonas(); ?>
        </select>
        </label>
        <label for="comision-hotel">Comisión: <input type="number" id="comision-hotel" placeholder="10.5" ></label>
        <label for="usuario-hotel">Usuario: <input type="email" id="usuario-hotel" placeholder="user@user.com" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></label>
        <label for="direccion-hotel">Dirección: <input type="text" id="direccion-hotel" placeholder="Dirección" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></label>

        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <button onclick="crearHotel()" style="flex: 1; padding: 8px; background-color: green; color: white; border: none; border-radius: 5px; cursor: pointer;">Crear</button>
            <button onclick="cerrarModalHotel()" style="flex: 1; padding: 8px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Cancelar</button>
        </div>
    </div>
</div>

<div id="update-modal-hotel" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px; display: flex; flex-direction: column; gap: 10px;">
        <h5 id="titulo-update" style="margin: 0;"></h5>
        <p>Id: <span id=id-hotel-update></span></p>
        <label for="nombre-hotel-update">Nombre: <input type="text" id="nombre-hotel-update" placeholder="Nombre del hotel" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></label>
        <label for="zona-hotel-update">Zona: <select name="zona-hotel" id="zona-hotel-update">
            <option value="">Selecciona una zona</option>
            <?php getZonas(); ?>
        </select>
        </label>
        <label for="comision-hotel-update">Comisión: <input type="number" id="comision-hotel-update" placeholder="10.5" ></label>
        <label for="usuario-hotel-update">Usuario: <input type="email" id="usuario-hotel-update" placeholder="user@user.com" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></label>
        <label for="direccion-hotel-update">Dirección: <input type="text" id="direccion-hotel-update" placeholder="Dirección" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></label>


        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <button id="update-btn" onclick="updateHotel()" style="flex: 1; padding: 8px; background-color: green; color: white; border: none; border-radius: 5px; cursor: pointer;">Cambiar</button>
            <button onclick="cerrarUpdateHotel()" style="flex: 1; padding: 8px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Cancelar</button>
        </div>
    </div>
</div>


