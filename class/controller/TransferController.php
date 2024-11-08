<?php

require_once './database.php'

class TransferController
{
    
    // Acción para la página de inicio
    public function register()
    {
        $data_base = new Database();

        $data_base->execute("INSERT INTO `transfer_reservas` (
            `id_reserva`,
            `localizador`,
            `id_hotel`,
            `id_tipo_reserva`,
            `email_cliente`,
            `fecha_reserva`,
            `fecha_modificacion`,
            `id_destino`,
            `fecha_entrada`,
            `hora_entrada`,
            `numero_vuelo_entrada`,
            `origen_vuelo_entrada`,
            `hora_vuelo_salida`,
            `fecha_vuelo_salida`,
            `num_viajeros`,
            `id_vehiculo`
         VALUES (
            :id_reserva,
            -- :localizador,
            :id_hotel,
            :id_tipo_reserva,
            -- :email_cliente,
            :fecha_reserva,
            :fecha_modificacion,
            :id_destino,
            :fecha_entrada,
            :hora_entrada,
            :numero_vuelo_entrada,
            -- :origen_vuelo_entrada,
            :hora_vuelo_salida,
            :fecha_vuelo_salida,
            -- :num_viajeros,
            :id_vehicul`
         );",
         array(
            'localizador' => 'STRING_GENERADO_ALEATORIAMENTE',
            '' => $_POST["trayecto"],
            '' => $_POST["fechaIda"],
            '' => $_POST["horaIda"],
            'origen_vuelo_entrada' => $_POST["aeropuertoOrigen"],
            '' => $_POST["numeroVueloIda"],
            '' => $_POST["fechaVuelta"],
            '' => $_POST["horaVueloVuelta"],
            '' => $_POST["horaRecogida"],
            '' => $_POST["numeroVueloVuelta"],
            '' => $_POST["hotelDestino"],
            'num_viajeros' => $_POST["numeroViajeros"],
            '' => $_POST["direccionHotel"],
            '' => $_POST["nombreCliente"],
            'email_cliente' => $_POST["emailCliente"],
            '' => $_POST["telefonoCliente"],
            '' => $_POST["dniCliente"]
         )
        );

        // Llama a la vista de inicio
        require_once './views/dashboard.php';
        
    }

}


