<?php

session_start(); 
$user = $_SESSION['user'];
$rol = $_SESSION['rol']; 

require_once '../entity/dbConnection.php';
require_once '../controller/controller.php';
require_once '../entity/clienteEntity.php';
require_once '../entity/transferPreciosEntity.php';


class preciosCtrl extends controller
{
    private $db;
    private $userEntity;

    public function __construct(){}


    public function drawPreciosByCliente($obj)
    {
        $out = '<table class="table table-hover">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Precio</th>
                        <th>Id Hotel</th>
                        <th>Id Vehículo</th>
                        <th>nombre</th>                        
                    </tr>
                </thead>
                <tbody>';                  
    
    
        foreach ($obj as $value) {

            $out .= '<tr>
                        <td>' . htmlspecialchars($value['email']) . '</td>
                        <td>' . htmlspecialchars($value['precio']) . '</td>
                        <td>' . htmlspecialchars($value['id_hotel']) . '</td>
                        <td>' . htmlspecialchars($value['id_vehiculo']) . '</td>
                        <td>' . htmlspecialchars($value['nombre']) . '</td>';
        }
    
        $out .= '</tbody>
                </table>';

            return $out;
    }
    



    public static  function procesaPost()
    { 
            
        $db = new Database();
        $db->getConnection();
        $post = self::cleanPost();

        if($post["action"]=="loadPrecios")
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;
            
            try
            {
                
                $preciosEntity = new TransferPreciosEntity;
                $obj = $preciosEntity->getAllPreciosByUser($_SESSION['user']);

                $preciosCtrl = new preciosCtrl;
                $result->out = $preciosCtrl->drawPreciosByCliente($obj);

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

if(array_key_exists('controller', $_POST) && $_POST['controller']=="preciosCtrl"){    

    preciosCtrl::procesaPost();
    
}

