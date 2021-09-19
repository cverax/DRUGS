<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/usuario.php');

if (isset($_GET['action'])){
    session_start();
    $Usuario=new Usuario;
    $result = array ('status' => 0, 'message' =>null, 'exeception' => null); 
        switch($_GET['action']){
            case 'readAll':
                if ($result['dataset'] = $Usuario->readAll()) {
                    $result['status'] = 1;  
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay usuarios registrados';
                    }
                }
                break;  
                case 'create':
                    $_POST = $Usuario->validateForm($_POST);
                        if ($Usuario->setNombre($_POST['nombre'])) {
                            if ($Usuario->setUsuario($_POST['usuario'])) {
                                if ($Usuario->setTipoU($_POST['tipoempleado'])) {
                                    if ($Usuario -> setCorreo ($_POST ['correo'])){
                                    if ($_POST['clave'] == $_POST['confclave']) {
                                    if ($Usuario->setClave($_POST['clave'])) {
                                        if ($Usuario->createRow()) {
                                             $result['status'] = 1;
                                            $result['message'] = 'Usuario Guardado Correctamente'; 
                                        } else {
                                            $result['exception'] = Database::getException();;
                                        }

                                    } else {
                                        $result['exception'] = 'clave incorrecto';
                                    } 
                                    } else {
                                        $result['exception'] = 'Claves diferentes';
                                    }
                                } else {
                                    $result['exception'] = 'correo incorrecto';
                                } 
                                } else {
                                    $result['exception'] = 'tipo de empleado incorrecto';
                                } 
                            } else {
                                $result['exception'] = 'Usuario incorrecto';
                            } 
                        } else {
                         $result['exception'] = 'Nombre incorrecto';
                        }                   
                break;

                case 'readOne':
                     if ($Usuario->setId($_POST['id'])) {
                        if ($result['dataset'] = $Usuario->readOne()) {
                             $result['status'] = 1;
                        } else {
                             if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No existe el respectivo Usuario';
                            }
                            }
                    } else {
                        $result['exception'] = 'Usuario erróneo';
                    }
                    break;
                    case 'readOnes':
                        if ($Usuario->setId($_POST['ids'])) {
                           if ($result['dataset'] = $Usuario->readOnes()) {
                                $result['status'] = 1;
                           } else {
                                if (Database::getException()) {
                                   $result['exception'] = Database::getException();
                               } else {
                                   $result['exception'] = 'No existe el respectivo Usuario';
                               }
                               }
                       } else {
                           $result['exception'] = 'Usuario erróneo';
                       }
                       break;
                case 'update':
                    $_POST = $Usuario->validateForm($_POST);
                        if ($Usuario->setId($_POST['id'])) {
                            if ($Usuario->readOne()) {
                                if ($Usuario->setNombre($_POST['nombre'])) {
                                    if ($Usuario->setUsuario($_POST['usuario'])) {
                                        if ($Usuario -> setCorreo ($_POST ['correo'])){
                                        if ($Usuario->updateRow()) {
                                                     $result['status'] = 1;
                                                    $result['message'] = 'Usuario Guardado Correctamente'; 
                                                } else {
                                                    $result['exception'] = Database::getException();;
                                                }
                                            } else {
                                                $result['exception'] = 'Correo incorrecto';
                                               } 
                                    } else {
                                        $result['exception'] = 'Usuario incorrecto';
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
                case 'updatepass':
                    $_POST = $Usuario->validateForm($_POST);
                        if ($Usuario->setId($_POST['id'])) {
                            if ($Usuario->readOne()) {
                                if ($_POST['clave'] == $_POST['confclave']) {
                                    if ($Usuario->setClave($_POST['clave'])) {
                                        if ($Usuario->updateRowpass()) {
                                                     $result['status'] = 1;
                                                    $result['message'] = 'Usuario Guardado Correctamente'; 
                                         } else {
                                            $result['exception'] = Database::getException();;
                                        }           
                                    } else {
                                         $result['exception'] = 'clave incorrecto';
                                     } 
                                } else {
                                     $result['exception'] = 'Claves diferentes';
                                }  
                            } else {
                                $result['exception'] = 'Problema con leer ids';
                            }
                        }else {
                            $result['exception'] = 'Problema con ids';
                        }
                break;
        
                case 'readAlltipo':
                    if ($result['dataset'] = $Usuario->readAlltipo()) {
                        $result['status'] = 1;  
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay tipo usuarios registrados';
                        }
                    }
                   break;

        }
        header('content-type: application/json; charset=utf-8');
        print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
