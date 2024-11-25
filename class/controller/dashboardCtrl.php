<?php

use PhpParser\Node\Stmt\Switch_;

session_start(); 
$user = $_SESSION['user'];
$rol = $_SESSION['rol']; 


require_once '../entity/dbConnection.php';
require_once '../controller/controller.php';
require_once '../entity/clienteEntity.php';
require_once '../entity/transferVehiculoEntity.php';



class dashboardCtrl extends controller
{
    private $db;
    private $userEntity;

    public function __construct(){}


    public function drawDashboard():string
    {
        $out = "";

        switch($_SESSION['rol']) {
            case 1:
               $out = ' <div class="row mb-3">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" data-bs-toggle="modal" data-bs-target="#addReservaModal" style="cursor: pointer;">
                            <h5 class="card-title">Crear transfer</h5>
                            <p class="card-text">Ida, vuelta e ida y vuelta</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" style="cursor: pointer;" onclick="loadView("gestionTransfers.php")">
                            <h5 class="card-title">Gestionar transfer</h5>
                            <p class="card-text">Gestiona los transfers activos</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" style="cursor: pointer;" onclick="loadView("views.php")">
                            <h5 class="card-title">Panel de vistas</h5>
                            <p class="card-text">Consulta el calendario de los transfers</p>
                        </div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" style="cursor: pointer;" onclick="loadView("precios.php")">
                            <h5 class="card-title">Crear conductor</h5>
                            <p class="card-text">Crea y gestiona conductores</p>
                        </div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" style="cursor: pointer;" onclick="loadView("precios.php")">
                            <h5 class="card-title">Hotel</h5>
                            <p class="card-text">Crea y gestiona los hoteles</p>
                        </div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body" style="cursor: pointer;" onclick="loadView("precios.php")">
                            <h5 class="card-title">Precios</h5>
                            <p class="card-text">Crea y gestiona los hoteles</p>
                        </div>
                    </div>  
                </div>
            </div>';
            
            case 2:
                
            case 3:    
            }

        return $out;
    }


    public function drawSidebar():string
    {
        $out = "";

        switch($_SESSION['rol']) {
            case 1:
             
            case 2:
                
            case 3:    
            }

        return $out;
    }

    public static  function procesaPost()
    {
            $db = new Database();
            $db->getConnection();
            $post = self::cleanPost();

            if($post["action"]=="loadDashboard")
            {
                $result = new stdClass();
                $result->error = false;
                $result->message = null;

              
                try
                {
                   $dashboardCtrl = NEW dashboardCtrl;

                   $dashboardCtrl->drawDashboard();
                   $dashboardCtrl->drawSidebar();

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

if(array_key_exists('controller', $_POST) && $_POST['controller']=="vehiculoCtrl"){    

    PerfilCtrl::procesaPost();
    
}

