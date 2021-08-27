<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/registro.php');

if (isset($_GET['action'])){
    session_start();
    $entradasalida=new entradasalida;
    $result = array ('status' => 0, 'message' =>null, 'exeception' => null); 
        switch($_GET['action']){

            case 'readAll':
                if ($result['dataset'] = $entradasalida->readAllexistencia()) {
                    $result['status'] = 1;  
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay productos registrados';
                    }
                }
                break;
                case 'graphExistencias':
                    if ($result['dataset'] = $Productos->graphExistencias()) {
                         $result['status'] = 1;
                    } else {
                         if (Database::getException()) {
                               $result['exception'] = Database::getException();
                         } else {
                               $result['exception'] = 'No hay datos registrados';
                         }
                    }						                    
                break;  

                case 'searchRows':
                    $_POST = $entradasalida->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $entradasalida->searchRowsExistencias($_POST['search'])) {
                            $result['status'] = 1;
                            $rows = count($result['dataset']);
                            if ($rows > 1) {
                                $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                            } else {
                                $result['message'] = 'Solo existe una coincidencia';
                            }
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay coincidencias';
                            }
                        }
                    } else {
                        $result['exception'] = 'Ingrese un valor para buscar';
                    }
                    break;
        }
        header('content-type: application/json; charset=utf-8');
        print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
