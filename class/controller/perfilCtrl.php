<?php

session_start(); 
$user = $_SESSION['user'];
$rol = $_SESSION['rol']; 


require_once '../entity/dbConnection.php';
require_once '../controller/controller.php';
require_once '../entity/clienteEntity.php';



class perfilCtrl extends controller
{
    private $db;
    private $userEntity;

    public function __construct(){}


    public function drawPerfilCliente($cliente): string
    {       

        $out= 
        
        '<h5>Perfil</h5>
            <div class="row">
                <!-- Columna 1: Información Personal -->
                <div class="col-12 col-md-4">
                    <form id="profileForm" method="post">
                        <!-- Nombre completo -->
                        <div class="mb-3">
                            <label for="userName" class="form-label">Nombre</label>
                            <input type="text" class="form-control form-control-lg" id="nomCli" name="nomCli" value="'.$cliente->getNombre().'" required>
                        </div>

                        <!-- Usuario -->
                        <div class="mb-3">
                            <label for="user" class="form-label">Usuario</label>
                            <input type="text" class="form-control form-control-lg" id="user" name="user"value="'.$cliente->getNombreUsuario().'" required readonly>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" value="'.$cliente->getEmail().'" required>
                        </div>
                    </form>
                </div>

                <!-- Columna 2: Apellidos -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="apellido1Cliente" class="form-label">Primer apellido </label>
                        <input type="text" class="form-control form-control-lg" id="apellido1Cliente" name="apellido1Cliente" value="'.$cliente->getApellido1().'" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido2Cliente" class="form-label">Segundo apellido </label>
                        <input type="text" class="form-control form-control-lg" id="apellido2Cliente" name="apellido2Cliente" value="'.$cliente->getApellido2().'" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono contacto</label>
                        <input type="text" class="form-control form-control-lg" id="telefono" name="telefono" value="'.$cliente->getTelefono().'" required>
                    </div>
                </div>

                <!-- Columna 3: Contraseña -->
                <div class="col-12 col-md-4">
                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="DNI" class="form-label">DNI</label>
                        <input type="text" class="form-control form-control-lg" id="DNI" name="DNI" value="'.$cliente->getDNI().'" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" value="'.$cliente->getPassword().'" required>
                    </div>

                    <!-- Repetir Contraseña -->
                    <div class="mb-3">
                        <label for="passwordRepeat" class="form-label">Repite la contraseña</label>
                        <input type="password" class="form-control form-control-lg" id="passwordRepeat" name="passwordRepeat" value="" required>
                    </div>

                    <!-- Botón de guardar -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-lg savePerfilBtn">Guardar Cambios</button>
                        <input type="hidden" id="clienteId" name="clienteId" value="'.$cliente->getIdCliente().'">
                    </div>
                </div>
            </div>';

        return $out;
    }



    public static  function procesaPost()
    { 
            $db = new Database();
            $db->getConnection();
            $post = self::cleanPost();

            if($post["action"]=="loadPerfil")
            {
                $result = new stdClass();
                $result->error = false;
                $result->message = null;

                $user = $_SESSION['user'];
              
                try
                {
                    $cliente = new clienteEntity;
                    
                    if(!$cliente->getClienteByUsername($user))
                        throw new Exception ("No ha sido posible cargar el cliente");

                    $perfil = new perfilCtrl;
                    $result->error = false;
                    $result->out = $perfil->drawPerfilCliente($cliente);

                }catch(Exception $e)
                {
                    $result->error = true;
                    $result->message = $e->getMessage();
                }
                
                echo json_encode($result);
                exit();
            }

            if($post["action"]=="savePerfil")
            {
                $result = new stdClass();
                $result->error = false;
                $result->message = null;

                $id = $post['id'];
                $nombre = $post['nombre'];
                //$user = $post['user'];
                $pass = $post['password'];
                $email = $post['email'];
                $apellido1 = $post['apellido1'];
                $apellido2 = $post['apellido2'];
                $tel = $post['tel'];
                //$rol = $post['rol'];
                $fecha = date('Y-m-d H:i:s');
                $DNI = $post['DNI'];
                
                try
                {
                    $cliente = new clienteEntity;
                    $cleanEmail = self::sanitize_email($email);



                    if ($post['email'] == $cliente->emailExists($email) && $post['email'] != $email) {
                        throw new exception ("Email ya registrado.");

                    }else{$passEncrypt = self::encriptarPassword($pass);
                    }
                    
                    $perfil = new perfilCtrl;

                    $cliente->getCliente($id);

                    $cliente->setNombre($nombre);
                    $cliente->setApellido1($apellido1);
                    $cliente->setApellido2($apellido2);
                    $cliente->setEmail($cleanEmail);
                    $cliente->setTelefono($tel);
                    $cliente->setUpdated($tel);
                    $cliente->setPassword($passEncrypt);
                    $cliente->setDNI($DNI);
                    $cliente->updateCliente($fecha);

                    $result->error = false;
                    $result->message = ("Datos guardados correctamente");
                    
                }catch(Exception $e)
                {
                    $result->error = true;
                    $result->message = $e->getMessage();
                }
                
                echo json_encode($result);
                exit();
            }

            


    }
}

if(array_key_exists('controller', $_POST) && $_POST['controller']=="perfilCtrl"){    

    PerfilCtrl::procesaPost();
    
}

