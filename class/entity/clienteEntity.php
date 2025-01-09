<?php



Class clienteEntity
{
    private $conn; 

    private $idCliente;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $email;
    private $telefono;
    private $created;
    private $updated;
    private $nombreUsuario;
    private $password;
    private $rol;
    private $dni;
    

    public function __construct()
    {
        $connection = new Database();
        $this->conn = $connection->getConnection();
    }

    
    public function mapaDB($data)
    {
        
        $obj = [];
        $obj['idCliente'] = $this->getIdCliente();
        $obj['nombre'] = $this->getNombre();
        $obj['apellido1'] = $this->getApellido1(); 
        $obj['apellido2'] = $this->getApellido2();
        $obj['email'] = $this->getEmail();
        $obj['telefono'] = $this->getTelefono();
        $obj['created'] = $this->getCreated();
        $obj['updated'] = $this->getUpdated();
        $obj['nombreUsuario'] = $this->getNombreUsuario();
        $obj['password'] = $this->getPassword();
        $obj['rol'] = $this->getRol();
        $obj['dni'] = $this->getdni();

        return $obj;
    }

        // Getters y Setters

        public function getIdCliente() { return $this->idCliente; }
        public function setIdCliente($idCliente) { $this->idCliente = $idCliente; }

        public function getNombreUsuario() { return $this->nombreUsuario; }
        public function setNombreUsuario($nombreUsuario) { $this->nombreUsuario = $nombreUsuario; }

        public function getNombre() { return $this->nombre; }
        public function setNombre($nombre) { $this->nombre = $nombre; }

        public function getApellido1() { return $this->apellido1; }
        public function setApellido1($apellido1) { $this->apellido1 = $apellido1; }

        public function getApellido2() { return $this->apellido2; }
        public function setApellido2($apellido2) { $this->apellido2 = $apellido2; }

        public function getEmail() { return $this->email; }
        public function setEmail($email) { $this->email = $email; }

        public function getTelefono() { return $this->telefono; }
        public function setTelefono($telefono) { $this->telefono = $telefono; }

        public function getCreated() { return $this->created; }
        public function setCreated($created) { $this->created = $created; }

        public function getUpdated() { return $this->updated; }
        public function setUpdated($updated) { $this->updated = $updated; }

        public function getPassword() { return $this->password; }
        public function setPassword($password) { $this->password = $password; }

        public function getRol() { return $this->rol; }
        public function setRol($rol) { $this->rol = $rol; }

        public function getDNI() { return $this->dni; }
        public function setDNI($dni) { $this->dni = $dni; }


        public function insertUser($user, $nombre, $apellido1, $apellido2, $tipoRol, $email, $tel, $fechaSQL, $pass, $dni) :int
        {
            $sql = 'INSERT INTO cliente (nombre, apellido1, apellido2, email, telefono, created, updated, nombreUsuario, password, rol, dni) 
                    VALUES (:nombre, :apellido1, :apellido2, :email, :telefono, :created, :updated, :nombreUsuario, :password, :rol, :dni)';
            
            $stmt = $this->conn->prepare($sql);
           
            $roclCliente = [
                'administrador' => 1,
                'corporativo' => 2,
                'cliente' => 3
            ];

            $rol = $roclCliente[$tipoRol];


            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido1', $apellido1);
            $stmt->bindParam(':apellido2', $apellido2);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefono', $tel);
            $stmt->bindParam(':created', $fechaSQL);
            $stmt->bindParam(':updated', $fechaSQL);
            $stmt->bindParam(':nombreUsuario', $user);
            $stmt->bindParam(':password', $pass);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':dni', $dni);

            if ($stmt->execute()) {
                return $this->conn->lastInsertId();
            }
            return null;
        }

        public function getCliente($id) :array
        {
            $sql = 'SELECT * FROM cliente WHERE idCliente = :idCliente LIMIT 1'; 
            
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':idCliente', $id, PDO::PARAM_INT); 
            
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                $this->idCliente = $row['idCliente'];
                $this->nombre = $row['nombre'];
                $this->apellido1 = $row['apellido1'];
                $this->apellido2 = $row['apellido2'];
                $this->email = $row['email'];
                $this->telefono = $row['telefono'];
                $this->created = $row['created'];
                $this->updated = $row['updated'];
                $this->nombreUsuario = $row['nombreUsuario'];
                $this->password = $row['password'];
                $this->rol = $row['rol'];
                $this->dni = $row['dni'];
            
                return $row;
            }
            
            return null;
        }

        public function getClientesByRol($rol) :array
        {
            $sql = 'SELECT * FROM cliente WHERE rol = :rol'; 
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':rol', $rol, PDO::PARAM_INT); 
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $rows;
    
        }
        



        public function updateCliente()
        {
            $fechaSQL = date('Y-m-d H:i:s');
            $sql = 'UPDATE cliente SET updated = :updated';
            $params = [':updated' => $fechaSQL];

            if (!empty($this->nombre)) {
                $sql .= ', nombre = :nombre';
                $params[':nombre'] = $this->nombre;
            }
            if (!empty($this->apellido1)) {
                $sql .= ', apellido1 = :apellido1';
                $params[':apellido1'] = $this->apellido1;
            }
            if (!empty($this->apellido2)) {
                $sql .= ', apellido2 = :apellido2';
                $params[':apellido2'] = $this->apellido2;
            }
            if (!empty($this->email)) {
                $sql .= ', email = :email';
                $params[':email'] = $this->email;
            }
            if (!empty($this->telefono)) {
                $sql .= ', telefono = :telefono';
                $params[':telefono'] = $this->telefono;
            }
            if (!empty($this->nombreUsuario)) {
                $sql .= ', nombreUsuario = :nombreUsuario';
                $params[':nombreUsuario'] = $this->nombreUsuario;
            }
            if (!empty($this->password)) {
                $sql .= ', password = :password';
                $params[':password'] = $this->password;
            }
            if (!empty($this->dni)) {
                $sql .= ', dni = :dni';
                $params[':dni'] = $this->dni;
            }
            if (!empty($this->rol)) {
                $sql .= ', rol = :rol';
                $params[':rol'] = $this->rol;
            }

            $sql .= ' WHERE idCliente = :idCliente';
            $params[':idCliente'] = $this->idCliente;

            $stmt = $this->conn->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            return $stmt->execute();
        }        

        public function deleteCliente($id) {
            $sql = "DELETE FROM cliente WHERE idCliente = :idCliente";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idCliente', $idCliente);
            
            if ($stmt->execute()) {
                echo "Cliente eliminado correctamente.";
            } else {
                echo "Error al eliminar el cliente.";
            }
        }

        public function userExists($username)
        {
            $sql = "SELECT COUNT(*) FROM cliente WHERE nombreUsuario = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            
            return $count > 0;
        }

        public function emailExists($email)
        
        {
            $sql = "SELECT COUNT(*) FROM cliente WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            
            return $count > 0;
        }

        public function verifyUser($username, $password) :bool
        {
            $sql = 'SELECT password FROM cliente WHERE nombreUsuario = :username LIMIT 1';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            
            if ($row && password_verify($password, $row['password'])) {
                return true; 
            }
            return false; 
        }

        public function getClienteByUsername($username) :array
        {
            $sql = 'SELECT * FROM cliente WHERE nombreUsuario = :nombreUsuario LIMIT 1';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombreUsuario', $username);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                $this->idCliente = $row['idCliente'];
                $this->nombreUsuario = $row['nombreUsuario']; 
                $this->nombre = $row['nombre']; 
                $this->apellido1 = $row['apellido1'];
                $this->apellido2 = $row['apellido2'];
                $this->email = $row['email'];
                $this->telefono = $row['telefono'];
                $this->created = $row['created'];
                $this->updated = $row['updated'];
                $this->password = $row['password']; 
                $this->rol = $row['rol'];
                $this->dni = $row['dni'];
            
                return $row;
            }
            return null;
        }


        public function getClienteByEmail($email) : ?array
        {
            $sql = 'SELECT * FROM cliente WHERE email = :email LIMIT 1';
            
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':email', $email, PDO::PARAM_STR); 
            
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                /*$this->idCliente = $row['idCliente'];
                $this->nombreUsuario = $row['nombre'];
                $this->apellido1 = $row['apellido1'];
                $this->apellido2 = $row['apellido2'];
                $this->email = $row['email'];
                $this->telefono = $row['telefono'];
                $this->created = $row['created'];
                $this->updated = $row['updated'];
                $this->nombreUsuario = $row['nombreUsuario'];
                $this->password = $row['password'];
                $this->rol = $row['rol'];
                $this->rol = $row['dni'];*/
            
                return $row;
            }
            
            return null;
        }




    }


