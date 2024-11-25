<?php
function getTodasZonas() {
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
            echo '<li style="display: flex; align-items: center; justify-content: space-between; padding: 10px; border-bottom: 1px solid #ccc;">';
            
            echo '<div style="display: flex; flex: 1; justify-content: flex-start;" id="zona-'. htmlspecialchars($zona['id_zona']) .'">';
            echo '<span style="width: 4rem; text-align: left;">' . htmlspecialchars($zona['id_zona']) . '</span>';
            echo '<span>|</span>';
            echo '<span style="flex: 1; text-align: left; padding-left: 1rem;">' . htmlspecialchars($zona['descripcion']) . '</span>';
            echo '</div>';
    
            echo '<button style="margin-left: 10px; padding: 5px 10px; background-color: blue; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="abrirModalUpdate('. $zona['id_zona'] .', 1)">Editar</button>';
            echo '<button style="margin-left: 10px; padding: 5px 10px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="borrarZona('. $zona['id_zona'] .')">Borrar</button>';
            
            echo '</li>';
        }
    } else {
        
    }
}

function getTodosTransfers() {
    $url = 'http://localhost/backend-vef/class/controller/otroTransfer.php?action=getTipos';
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo "Error al obtener los tipos: " . curl_error($ch);
        curl_close($ch);
        return;
    }
    
    curl_close($ch);
    
    $tipos = json_decode($response, true);
    
    if (!empty($tipos) && is_array($tipos)) {
        foreach ($tipos as $tipo) {
            echo '<li style="display: flex; align-items: center; justify-content: space-between; padding: 10px; border-bottom: 1px solid #ccc;">';
            
            echo '<div style="display: flex; flex: 1; justify-content: flex-start;" id="tipo-'. htmlspecialchars($tipo['id_tipo_reserva']) .'">';
            echo '<span style="width: 4rem; text-align: left;">' . htmlspecialchars($tipo['id_tipo_reserva']) . '</span>';
            echo '<span>|</span>';
            echo '<span style="flex: 1; text-align: left; padding-left: 1rem;">' . htmlspecialchars($tipo['Descripción']) . '</span>';
            echo '</div>';
    
            echo '<button style="margin-left: 10px; padding: 5px 10px; background-color: blue; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="abrirModalUpdate('. $tipo['id_tipo_reserva'] .', 2)">Editar</button>';
            echo '<button style="margin-left: 10px; padding: 5px 10px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="borrarTipo('. $tipo['id_tipo_reserva'] .')">Borrar</button>';
            
            echo '</li>';
        }
    } else {
        
    }
}
?>
<div>
    <h4>Configuración de la aplicación</h4>
    <div style="display: flex; flex-direction: column; padding: 20px;">
        <h6>Configuración de Zonas</h6>
        <div style="display: flex; justify-content: flex-start; margin-bottom: 20px;">
            <button onclick="abrirModalZona()" style="padding: 10px 20px; background-color: green; color: white; border: none; border-radius: 5px; cursor: pointer;">Añadir Nueva Zona</button>
        </div>

        <div style="background-color: #f0f0f0; padding: 15px; border-radius: 5px;">
            <h6>Listado de Zonas</h6>
            <ul id="lista-zonas" style="list-style-type: none; padding-left: 0;">
                <li style="display: flex; align-items: center; justify-content: space-between; padding: 10px; border-bottom: 1px solid #ccc;">
                    <div style="display: flex; flex: 1; justify-content: flex-start;">
                        <span style="width: 4rem; text-align: left;">ID Zona</span>
                        <span>|</span>
                        <span style="flex: 1; text-align: left; padding-left: 1rem;">Descripción de la zona</span>
                    </div>
                </li>
                <?php getTodasZonas(); ?>
            </ul>
        </div>
    </div>
    <div style="display: flex; flex-direction: column; padding: 20px;">
        <h6>Configuración de tipos de Reserva</h6>
        <div style="display: flex; justify-content: flex-start; margin-bottom: 20px;">
            <button onclick="abrirModalTransfer()" style="padding: 10px 20px; background-color: green; color: white; border: none; border-radius: 5px; cursor: pointer;">Añadir Nueva Tipo de Reserva</button>
        </div>

        <div style="background-color: #f0f0f0; padding: 15px; border-radius: 5px;">
            <h6>Tipos de transfers</h6>
            <ul id="lista-tipos" style="list-style-type: none; padding-left: 0;">
                <li style="display: flex; align-items: center; justify-content: space-between; padding: 10px; border-bottom: 1px solid #ccc;">
                    <div style="display: flex; flex: 1; justify-content: flex-start;">
                        <span style="width: 4rem; text-align: left;">ID Tipo</span>
                        <span>|</span>
                        <span style="flex: 1; text-align: left; padding-left: 1rem;">Descripción del Tipo</span>
                    </div>
                </li>
                <?php getTodosTransfers(); ?>
            </ul>
        </div>
    </div>
</div>

<div id="nuevazonamodal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px; display: flex; flex-direction: column; gap: 10px;">
        <h5 style="margin: 0;">Crear Nueva Zona</h5>
        
        <input type="text" id="descripcionzona" placeholder="Descripción" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <button onclick="crearZona()" style="flex: 1; padding: 8px; background-color: green; color: white; border: none; border-radius: 5px; cursor: pointer;">Crear</button>
            <button onclick="cerrarModalZona()" style="flex: 1; padding: 8px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Cancelar</button>
        </div>
    </div>
</div>

<div id="nuevotransfermodal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px; display: flex; flex-direction: column; gap: 10px;">
        <h5 style="margin: 0;">Crear Nuevo tipo de Trasnfer</h5>
        
        <input type="text" id="descripciontipo" placeholder="Descripción" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <button onclick="crearTipo()" style="flex: 1; padding: 8px; background-color: green; color: white; border: none; border-radius: 5px; cursor: pointer;">Crear</button>
            <button onclick="cerrarModalTransfer()" style="flex: 1; padding: 8px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Cancelar</button>
        </div>
    </div>
</div>

<div id="update-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px; display: flex; flex-direction: column; gap: 10px;">
        <h5 id="titulo-update" style="margin: 0;"></h5>
        <p>Id: <span id=id-update></span></p>
        <input type="text" id="descripcion-update" placeholder="Descripción" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <button id="update-btn" onclick="updateModal()" style="flex: 1; padding: 8px; background-color: green; color: white; border: none; border-radius: 5px; cursor: pointer;">Cambiar</button>
            <button onclick="cerrarModalUpdate()" style="flex: 1; padding: 8px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Cancelar</button>
        </div>
    </div>
</div>


