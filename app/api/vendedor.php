<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/vendedor.php');

if (isset($_GET['action'])){
    session_start();
    $Vendedor=new Vendedor;
    $result = array ('status' => 0, 'message' =>null, 'exeception' => null); 
        switch($_GET['action']){
            case 'readAll':
                if ($result['dataset'] = $Vendedor->readAll()) {
                    $result['status'] = 1;  
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay Vendedores registrados';
                    }
                }
                break;  
                case 'create':
                    $_POST = $Vendedor->validateForm($_POST);
                        if ($Vendedor->setVendedor($_POST['vendedor'])) {
                            if ($Vendedor->setEstado(isset($_POST['estado']) ? 1 : 0)) {
                               if ($Vendedor->createRow()) {
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
                     if ($Vendedor->setId($_POST['idvendedor'])) {
                        if ($result['dataset'] = $Vendedor->readOne()) {
                             $result['status'] = 1;
                        } else {
                             if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No existe el respectivo vendedor';
                            }
                            }
                    } else {
                        $result['exception'] = 'vendedor erróneo';
                    }
                    break;
                case 'update':
                    $_POST = $Vendedor->validateForm($_POST);
                        if ($Vendedor->setId($_POST['id'])) {
                            if ($Vendedor->readOne()) {
                                if ($Vendedor->setVendedor($_POST['vendedor'])) {
                                    if ($Vendedor->setEstado(isset($_POST['estado']) ? 1 : 0)) {
                                        if ($Vendedor->updateRow()) {
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
    print(json_encode('Recurso no disponible'));
}
