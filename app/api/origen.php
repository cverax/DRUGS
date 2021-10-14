<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/origen.php');

if (isset($_GET['action'])){
    session_start();
    $origen=new Origen;
    $result = array ('status' => 0, 'message' =>null, 'exeception' => null); 
    if (isset($_SESSION['idusuario'])) {

        switch($_GET['action']){
            case 'readAll':
                if ($result['dataset'] = $origen->readAll()) {
                    $result['status'] = 1;  
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay productos registrados';
                    }
                }
                break;  
                case 'create':
                    $_POST = $origen->validateForm($_POST);
                        if ($origen->setOrigen($_POST['origen'])) {
                            if ($origen->setEstado(isset($_POST['estado']) ? 1 : 0)) {
                               if ($origen->createRow()) {
                                     $result['status'] = 1;
                                     $result['message'] = 'Origen Guardado Correctamente'; 
                                 } else {
                                     $result['exception'] = Database::getException();;
                                 }
                            } else {
                             $result['exception'] = 'Estado incorrecto';
                            }
                    } else {
                    $result['exception'] = 'Nombre incorrecto';
                    }                   
                break;

                case 'readOne':
                     if ($origen->setId($_POST['idorigen'])) {
                        if ($result['dataset'] = $origen->readOne()) {
                             $result['status'] = 1;
                        } else {
                             if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No existe el respectivo origen';
                            }
                            }
                    } else {
                        $result['exception'] = 'origen erróneo';
                    }
                    break;
                case 'update':
                    $_POST = $origen->validateForm($_POST);
                        if ($origen->setId($_POST['id'])) {
                            if ($origen->readOne()) {
                                if ($origen->setOrigen($_POST['origen'])) {
                                    if ($origen->setEstado(isset($_POST['estado']) ? 1 : 0)) {
                                        if ($origen->updateRow()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Origen actualizo Correctamente'; 
                                        } else {
                                           $result['exception'] = Database::getException();;
                                        }
                                    } else {
                                        $result['exception'] = 'Estado incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Nombre incorrecto';
                                    }    
                            } else {
                                $result['exception'] = 'Problema con leer id';
                            }
                        }else {
                            $result['exception'] = 'Problema con id';
                        }
                break;
        

        }
        header('content-type: application/json; charset=utf-8');
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
