<?php
require_once '../entity/dbConnection.php';
require_once '../controller/controller.php';

$dbTest = new Database();

Class UserEntity 
{
    private $conn; //Pasamos la variable de la conexión de la bbdd

    private $id;
    private $idCliente;
    private $nombreUsuario;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $email;
    private $telefono;
    private $password;
    private $created;
    private $updated;
    private $rol;
    

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    
    public function mapaDB($data)
    {
        $this->setId($data['id']);
        $this->setIdCliente($data['idCliente']);
        $this->setNombreUsuario($data['nombreUsuario']);
        $this->setNombre($data['nombre']);
        $this->setApellido1($data['apellido1']);
        $this->setApellido2($data['apellido2']);
        $this->setEmail($data['email']);
        $this->setTelefono($data['telefono']);
        $this->setPassword($data['password']);
        $this->setCreated($data['created']);
        $this->setUpdated($data['updated']);
        $this->setRol($data['rol']);

    }


        // Getters y Setters
        public function getId() { return $this->id; }
        public function setId($id) { $this->id = $id; }

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

        public function getPassword() { return $this->password; }
        public function setPassword($password) { $this->password = $password; }

        public function getCreated() { return $this->created; }
        public function setCreated($created) { $this->created = $created; }

        public function getUpdated() { return $this->updated; }
        public function setUpdated($updated) { $this->updated = $updated; }

        public function getRol() { return $this->rol; }
        public function setRol($rol) { $this->rol = $rol; }



        public function insertUser($nombreUsuario, $nombre,$apellido1, $apellido2, $rol, $email, $telefono, $password, $fechaSQL) 
        {
            
            $sql = 'INSERT INTO users (nombreUsuario, nombre, apellido1, apellido2, email, telefono, password, created, updated, rol) 
            VALUES (:nombreUsuario, :nombre, :apellido1, :apellido2, :email, :telefono, :password, :created, :updated, :rol)';

            $stmt = $this->conn->prepare($sql);


            $stmt->bindParam(':nombreUsuario', $nombreUsuario);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido1', $apellido1);
            $stmt->bindParam(':apellido2', $apellido2);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':created',$fechaSQL);
            $stmt->bindParam(':updated', $fechaSQL);
            $stmt->bindParam(':rol', $rol);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        public function getUser($id) 
        {
            $sql = 'SELECT * FROM users WHERE id = :id LIMIT 1';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                $this->id = $row['id'];
                $this->idCliente = $row['idCliente'];
                $this->nombreUsuario = $row['nombreUsuario'];
                $this->nombre = $row['nombre'];
                $this->apellido1 = $row['apellido1'];
                $this->apellido2 = $row['apellido2'];
                $this->email = $row['email'];
                $this->telefono = $row['telefono'];
                $this->password = $row['password'];
                $this->created = $row['created'];
                $this->updated = $row['updated'];
                $this->rol = $row['rol'];
            
                return true;
            }
            return false;
        }


        public function updateUser() 
        {
            $sql = 'UPDATE users SET idCliente = :idCliente, nombreUsuario = :nombreUsuario, nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, email = :email, telefono = :telefono, password = :password, created = :created, updated = :updated, rol = :rol  WHERE id= :id';
            
            $stmt = $this->conn->prepare($sql);


            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':idCliente', $this->idCliente);
            $stmt->bindParam(':nombreUsuario', $this->nombreUsuario);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellido1', $this->apellido1);
            $stmt->bindParam(':apellido2', $this->apellido2);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':created', $this->created);
            $stmt->bindParam(':updated', $this->updated);
            $stmt->bindParam(':rol', $this->rol);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        public function deleteUser($id) {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
        
    }


