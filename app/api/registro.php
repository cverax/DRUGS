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
                if ($result['dataset'] = $entradasalida->readAll()) {
                    $result['status'] = 1;  
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay productos registrados';
                    }
                }
                break;  
                case 'search':
                    $_POST = $entradasalida->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $entradasalida->searchRows($_POST['search'])) {
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
                case 'create':
                    $_POST = $entradasalida->validateForm($_POST);
                        if ($entradasalida->setFecha($_POST['vencimiento'])) {
                            if ($entradasalida->setCodigovta($_POST['VTA'])) {
                                if ($entradasalida->setTipodocumento($_POST['tipo'])) {
                                    if ($entradasalida->setNumero($_POST['comprobante'])) {
                                        if ($entradasalida->setDestino($_POST['Destino'])) {
                                            if ($entradasalida->setVendedor($_POST['Vendedor'])) {
                                                 if ($entradasalida->setProductos($_POST['Producto'])) {
                                                      if ($entradasalida->setCantidad($_POST['Cantidad'])) {
                               if ($entradasalida->createRow()) {
                                     $result['status'] = 1;
                                     $result['message'] = 'Origen Guardado Correctamente'; 
                                 } else {
                                     $result['exception'] = Database::getException();;
                                 }
                                     } else {
                                    $result['exception'] = 'Nombre incorrecto';
                                    } 
                                } else {
                                    $result['exception'] = 'Nombre incorrecto';
                                    } 
                                } else {
                                    $result['exception'] = 'Nombre incorrecto';
                                    } 
                                } else {
                                    $result['exception'] = 'Nombre incorrecto';
                                    } 
                                } else {
                                    $result['exception'] = 'Nombre incorrecto';
                                    } 
                                } else {
                                    $result['exception'] = 'Nombre incorrecto';
                                    } 
                                } else {
                                    $result['exception'] = 'Nombre incorrecto';
                                    } 
                    } else {
                    $result['exception'] = 'Nombre incorrecto';
                    }                   
                break;

                case 'readOne':
                     if ($entradasalida->setId($_POST['id'])) {
                        if ($result['dataset'] = $entradasalida->readOne()) {
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
                    case 'graphRegistro':
                        if ($result['dataset'] = $entradasalida->graphRegistro()) {
                             $result['status'] = 1;
                        } else {
                             if (Database::getException()) {
                                   $result['exception'] = Database::getException();
                             } else {
                                   $result['exception'] = 'No hay datos registrados';
                             }
                        }						                    
                    break;
                    case 'readAllvta':
                        if ($result['dataset'] = $entradasalida->readAllvta()) {
                            $result['status'] = 1;  
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay productos registrados';
                            }
                        }
                        break;
                        case 'readAllDocumentos':
                            if ($result['dataset'] = $entradasalida->readAllDocumentos()) {
                                $result['status'] = 1;  
                            } else {
                                if (Database::getException()) {
                                    $result['exception'] = Database::getException();
                                } else {
                                    $result['exception'] = 'No hay productos registrados';
                                }
                            }
                            break;
                            case 'readAllproducto':
                                if ($result['dataset'] = $entradasalida->readAllproducto()) {
                                    $result['status'] = 1;  
                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $result['exception'] = 'No hay productos registrados';
                                    }
                                }
                                break;
                                case 'readAllorigen':
                                    if ($result['dataset'] = $entradasalida->readAllorigen()) {
                                        $result['status'] = 1;  
                                    } else {
                                        if (Database::getException()) {
                                            $result['exception'] = Database::getException();
                                        } else {
                                            $result['exception'] = 'No hay productos registrados';
                                        }
                                    }
                                    break;
                                    case 'readAllvendedor':
                                        if ($result['dataset'] = $entradasalida->readAllvendedor()) {
                                            $result['status'] = 1;  
                                        } else {
                                            if (Database::getException()) {
                                                $result['exception'] = Database::getException();
                                            } else {
                                                $result['exception'] = 'No hay productos registrados';
                                            }
                                        }
                                        break;
                                      

        }
        header('content-type: application/json; charset=utf-8');
        print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
