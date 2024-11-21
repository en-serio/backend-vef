<?php


class TransferEntity 
{
    private $conn;

    private $idReserva;
    private $localizador;
    private $idHotel;
    private $idTipoReserva;
    private $email;
    private $created;
    private $updated;
    private $idDestino;
    private $fechaEntrada;
    private $horaEntrada;
    private $nuVueloEntrada;
    private $origenVueloEntrada;
    private $horaVueloSalida;
    private $fechaVueloSalida;
    private $numViajeros;
    private $idVehiculo;
    private $numeroVueloVuelta;
    private $horaRecogida;

    public function __construct()
    {
        $connection = new Database();
        $this->conn = $connection->getConnection();
    }

    public function mapaDB($data)
    {

    $obj = [];
    $obj['id_reserva'] = $this->getIdReserva();
    $obj['localizador'] = $this->getLocalizador();
    $obj['id_hotel'] = $this->getIdHotel();
    $obj['id_tipo_reserva'] = $this->getIdTipoReserva();
    $obj['email'] = $this->getEmail();
    $obj['created'] = $this->getCreated();
    $obj['updated'] = $this->getUpdated();
    $obj['id_destino'] = $this->getIdDestino();
    $obj['fecha_entrada'] = $this->getFechaEntrada();
    $obj['hora_entrada'] = $this->getHoraEntrada();
    $obj['nu_vuelo_entrada'] = $this->getNuVueloEntrada();
    $obj['origen_vuelo_entrada'] = $this->getOrigenVueloEntrada();
    $obj['hora_vuelo_salida'] = $this->getHoraVueloSalida();
    $obj['fecha_vuelo_salida'] = $this->getFechaVueloSalida();
    $obj['num_viajeros'] = $this->getNumViajeros();
    $obj['id_vehiculo'] = $this->getIdVehiculo();

    return $obj;

    }

     // Getters and Setters

     public function getIdReserva() { return $this->idReserva; }
     public function setIdReserva($idReserva) { $this->idReserva = $idReserva; }
 
     public function getLocalizador() { return $this->localizador; }
     public function setLocalizador($localizador) { $this->localizador = $localizador; }
 
     public function getIdHotel() { return $this->idHotel; }
     public function setIdHotel($idHotel) { $this->idHotel = $idHotel; }
 
     public function getIdTipoReserva() { return $this->idTipoReserva; }
     public function setIdTipoReserva($idTipoReserva) { $this->idTipoReserva = $idTipoReserva; }
 
     public function getEmail() { return $this->email; }
     public function setEmail($email) { $this->email = $email; }
 
     public function getCreated() { return $this->created; }
     public function setCreated($created) { $this->created = $created; }
 
     public function getUpdated() { return $this->updated; }
     public function setUpdated($updated) { $this->updated = $updated; }
 
     public function getIdDestino() { return $this->idDestino; }
     public function setIdDestino($idDestino) { $this->idDestino = $idDestino; }
 
     public function getFechaEntrada() { return $this->fechaEntrada; }
     public function setFechaEntrada($fechaEntrada) { $this->fechaEntrada = $fechaEntrada; }
 
     public function getHoraEntrada() { return $this->horaEntrada; }
     public function setHoraEntrada($horaEntrada) { $this->horaEntrada = $horaEntrada; }
 
     public function getNuVueloEntrada() { return $this->nuVueloEntrada; }
     public function setNuVueloEntrada($nuVueloEntrada) { $this->nuVueloEntrada = $nuVueloEntrada; }
 
     public function getOrigenVueloEntrada() { return $this->origenVueloEntrada; }
     public function setOrigenVueloEntrada($origenVueloEntrada) { $this->origenVueloEntrada = $origenVueloEntrada; }
 
     public function getHoraVueloSalida() { return $this->horaVueloSalida; }
     public function setHoraVueloSalida($horaVueloSalida) { $this->horaVueloSalida = $horaVueloSalida; }
 
     public function getFechaVueloSalida() { return $this->fechaVueloSalida; }
     public function setFechaVueloSalida($fechaVueloSalida) { $this->fechaVueloSalida = $fechaVueloSalida; }
 
     public function getNumViajeros() { return $this->numViajeros; }
     public function setNumViajeros($numViajeros) { $this->numViajeros = $numViajeros; }
 
     public function getIdVehiculo() { return $this->idVehiculo; }
     public function setIdVehiculo($idVehiculo) { $this->idVehiculo = $idVehiculo; }

     public function getHoraRecogida() { return $this->horaRecogida; }
     public function setHoraRecogida($horaRecogida) { $this->horaRecogida = $horaRecogida; }

     public function getNumeroVueloVuelta() { return $this->numeroVueloVuelta; }
     public function setNumeroVueloVuelta($numeroVueloVuelta) { $this->numeroVueloVuelta = $numeroVueloVuelta; }

     

    // CREATE
    public function insertTransfer($idCliente, $email, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIda, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVuelta, 
    $horaRecogida, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel, $idZona)
    {
        $sql = "INSERT INTO transfer_reservas ( localizador, id_hotel, id_tipo_reserva, email_cliente,
            fecha_reserva, fecha_modificacion, id_destino, fecha_entrada, hora_entrada,
            numero_vuelo_entrada, origen_vuelo_entrada, hora_vuelo_salida, fecha_vuelo_salida,
            num_viajeros, id_vehiculo, numero_vuelo_vuelta, hora_recogida)
            VALUES (:localizador, :id_hotel, :id_tipo_reserva, :email_cliente,
            :fecha_reserva, :fecha_modificacion, :id_destino, :fecha_entrada, :hora_entrada,
            :numero_vuelo_entrada, :origen_vuelo_entrada, :hora_vuelo_salida, :fecha_vuelo_salida,
            :num_viajeros, :id_vehiculo, :numero_vuelo_vuelta, :hora_recogida)";

        $stmt = $this->conn->prepare($sql);

        // Bind params

        $stmt->bindParam(':localizador', $localizador);
        $stmt->bindParam(':id_hotel', $idHotel);
        $stmt->bindParam(':id_tipo_reserva', $tipoReserva);
        $stmt->bindParam(':email_cliente', $email);
        $stmt->bindParam(':fecha_reserva', $fechaSQL);
        $stmt->bindParam(':fecha_modificacion', $fechaSQL);
        $stmt->bindParam(':id_destino', $idZona);
        $stmt->bindParam(':fecha_entrada', $fechaIda);
        $stmt->bindParam(':hora_entrada', $horaIda);
        $stmt->bindParam(':numero_vuelo_entrada', $numeroVueloIda);
        $stmt->bindParam(':origen_vuelo_entrada', $aeropuertoOrigen);
        $stmt->bindParam(':hora_vuelo_salida', $horaVueloVuelta);
        $stmt->bindParam(':fecha_vuelo_salida', $fechaVuelta);
        $stmt->bindParam(':num_viajeros', $numeroViajeros);
        $stmt->bindParam(':id_vehiculo', $idVehiculo);
        $stmt->bindParam(':numero_vuelo_vuelta', $numeroVueloVuelta);
        $stmt->bindParam(':hora_recogida', $horaRecogida);

        if ($stmt->execute()) {
            $this->idReserva = $this->conn->lastInsertId(); // Obtener el último ID insertado
            return true;
        }
        return false;
    }

    // READ
    public function getTransfer($idReserva):array
    {
    $sql = "SELECT * FROM transfer_reservas WHERE id_reserva = :idReserva LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idReserva', $idReserva);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $this->idReserva = $row['id_reserva'];               
        $this->localizador = $row['localizador'];             
        $this->idHotel = $row['id_hotel'];                 
        $this->idTipoReserva = $row['id_tipo_reserva'];       
        $this->email = $row['email_cliente'];              
        $this->created = $row['fecha_reserva'];         
        $this->updated = $row['fecha_modificacion'];
        $this->idDestino = $row['id_destino'];               
        $this->fechaEntrada = $row['fecha_entrada'];        
        $this->horaEntrada = $row['hora_entrada'];          
        $this->nuVueloEntrada = $row['numero_vuelo_entrada']; 
        $this->origenVueloEntrada = $row['origen_vuelo_entrada']; 
        $this->horaVueloSalida = $row['hora_vuelo_salida'];   
        $this->fechaVueloSalida = $row['fecha_vuelo_salida']; 
        $this->numViajeros = $row['num_viajeros'];           
        $this->idVehiculo = $row['id_vehiculo'];             
        $this->numeroVueloVuelta = $row['numero_vuelo_vuelta']; 
        $this->horaRecogida = $row['hora_recogida'];         


        return $row;
    }
    return null;
    }


    // UPDATE
    /*public function update($idCliente, $email, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIda, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVuelta, 
    $horaRecogida, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel)
    {
        $sql = "UPDATE transfer_reservas SET 
                    localizador = :localizador,
                    id_hotel = :idHotel,
                    id_tipo_reserva = :idTipoReserva,
                    email_cliente = :email,
                    updated = :updated,
                    id_destino = :idDestino,
                    fecha_entrada = :fechaEntrada,
                    hora_entrada = :horaEntrada,
                    nu_vuelo_entrada = :nuVueloEntrada,
                    origen_vuelo_entrada = :origenVueloEntrada,
                    hora_vuelo_salida = :horaVueloSalida,
                    fecha_vuelo_salida = :fechaVueloSalida,
                    num_viajeros = :numViajeros,
                    id_vehiculo = :idVehiculo
                WHERE id_reserva = :idReserva";

        $stmt = $this->conn->prepare($sql);


        // Bind params
        $stmt->bindParam(':localizador', $localizador);
        $stmt->bindParam(':id_hotel', $idHotel);
        $stmt->bindParam(':id_tipo_reserva', $tipoReserva);
        $stmt->bindParam(':email_cliente', $email);
        $stmt->bindParam(':fecha_reserva', $fechaSQL);
        $stmt->bindParam(':fecha_modificacion', $fechaSQL);
        $stmt->bindParam(':id_destino', $id_destino);
        $stmt->bindParam(':fecha_entrada', $fechaIda);
        $stmt->bindParam(':hora_entrada', $horaIda);
        $stmt->bindParam(':numero_vuelo_entrada', $numeroVueloIda);
        $stmt->bindParam(':origen_vuelo_entrada', $aeropuertoOrigen);
        $stmt->bindParam(':hora_vuelo_salida', $horaVueloVuelta);
        $stmt->bindParam(':fecha_vuelo_salida', $fechaVuelta);
        $stmt->bindParam(':num_viajeros', $numeroViajeros);
        $stmt->bindParam(':id_vehiculo', $idVehiculo);
        $stmt->bindParam(':numero_vuelo_vuelta', $numeroVueloVuelta);
        $stmt->bindParam(':hora_recogida', $horaRecogida);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }*/

    public function update($idReserva, $data)
    {
        // Construir dinámicamente la consulta SQL
        $sql = "UPDATE transfer_reservas SET ";
        $setClauses = [];
        $params = [];
    
        // Recorrer el array de datos y construir las cláusulas SET
        foreach ($data as $key => $value) {
            $setClauses[] = "$key = :$key";
            $params[":$key"] = $value;
        }
    
        // Completar la consulta SQL con WHERE
        $sql .= implode(", ", $setClauses);
        $sql .= " WHERE id_reserva = :idReserva";
        $params[":idReserva"] = $idReserva;
    
        // Preparar y ejecutar la consulta
        $stmt = $this->conn->prepare($sql);
    
        // Ejecutar la consulta con los parámetros
        if ($stmt->execute($params)) {
            return true;
        }
        return false;
    }
    


    // DELETE
    public function delete($idReserva)
    {
        $sql = "DELETE FROM transfer_reservas WHERE id_reserva = :idReserva";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idReserva', $idReserva);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getTransferByIdCliente($idCliente):array
    {
        $sql = "
            SELECT 
                tr.id_reserva, tr.localizador, tr.id_hotel, tr.id_tipo_reserva, tr.email_cliente, tr.fecha_reserva, tr.fecha_modificacion, tr.id_destino, 
                tr.fecha_entrada, tr.hora_entrada, tr.numero_vuelo_entrada, tr.origen_vuelo_entrada, tr.hora_vuelo_salida, tr.fecha_vuelo_salida, 
                tr.num_viajeros, tr.id_vehiculo, tr.numero_vuelo_vuelta, tr.hora_recogida,c.idCliente,c.nombreUsuario,c.email
            FROM 
                transfer_reservas AS tr
            INNER JOIN 
                cliente AS c 
            ON 
                tr.email_cliente = c.email
            WHERE 
                c.idCliente = :idCliente";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($results) {
            return $results;
        }
    
        return null;
    }

    public function getAllTransfersActivos():array
    {
    $sql = "SELECT * FROM transfer_reservas WHERE fecha_entrada >= CURDATE() OR fecha_vuelo_salida >= CURDATE() ORDER BY email_cliente;";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($row) {
            return $row;
        }
    }

    public function getTransferEdit ($idReserva):array

    {
        $sql = 'SELECT transfer_reservas.*, 
        cliente.nombre, cliente.apellido1, cliente.apellido2, cliente.telefono, cliente.dni,
        tranfer_hotel.nombre_hotel, tranfer_hotel.direccion_hotel
        FROM transfer_reservas
        INNER JOIN cliente ON transfer_reservas.email_cliente = cliente.email
        INNER JOIN tranfer_hotel ON transfer_reservas.id_hotel = tranfer_hotel.id_hotel
        WHERE transfer_reservas.id_reserva = :idReserva
        AND cliente.email = transfer_reservas.email_cliente
        AND tranfer_hotel.id_hotel = transfer_reservas.id_hotel
        LIMIT 1';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idReserva', $idReserva);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->idReserva = $row['id_reserva'];               
            $this->localizador = $row['localizador'];             
            $this->idHotel = $row['id_hotel'];                 
            $this->idTipoReserva = $row['id_tipo_reserva'];       
            $this->email = $row['email_cliente'];              
            $this->created = $row['fecha_reserva'];         
            $this->updated = $row['fecha_modificacion'];
            $this->idDestino = $row['id_destino'];               
            $this->fechaEntrada = $row['fecha_entrada'];        
            $this->horaEntrada = $row['hora_entrada'];          
            $this->nuVueloEntrada = $row['numero_vuelo_entrada']; 
            $this->origenVueloEntrada = $row['origen_vuelo_entrada']; 
            $this->horaVueloSalida = $row['hora_vuelo_salida'];   
            $this->fechaVueloSalida = $row['fecha_vuelo_salida']; 
            $this->numViajeros = $row['num_viajeros'];           
            $this->idVehiculo = $row['id_vehiculo'];             
            $this->numeroVueloVuelta = $row['numero_vuelo_vuelta']; 
            $this->horaRecogida = $row['nombre'];   
            $this->horaRecogida = $row['apellido1']; 
            $this->horaRecogida = $row['apellido2']; 
            $this->horaRecogida = $row['telefono']; 
            $this->horaRecogida = $row['dni']; 
            $this->horaRecogida = $row['nombre_hotel']; 
            $this->horaRecogida = $row['direccion_hotel'];     
    
            return $row;
        }
        return null;
        }
    
}

   

