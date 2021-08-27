<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/productos.php');

if (isset($_GET['action'])){
    session_start();
    $Productos=new Productos;
    $result = array ('status' => 0, 'message' =>null, 'exeception' => null); 
        switch($_GET['action']){
            case 'readAll':
                if ($result['dataset'] = $Productos->readAll()) {
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
                    $_POST = $Productos->validateForm($_POST);
                        if ($Productos->setId($_POST['Codigo'])) {
                            if ($Productos->setNombre($_POST['Nombre'])) {
                                if ($Productos->setCategoria($_POST['Categoria'])) {
                                    if ($Productos->setLote($_POST['Lote'])) {
                                        if ($Productos->setVencimiento($_POST['vencimiento'])) {
                                            if ($Productos->setComentario($_POST['Comentarios'])) {
                                        if ($Productos->createRow()) {
                                             $result['status'] = 1;
                                            $result['message'] = 'Usuario Guardado Correctamente'; 
                                        } else {
                                            $result['exception'] = Database::getException();;
                                        }
                                        

                                } else {
                                    $result['exception'] = 'Comentario incorrecto';
                                } 

                            } else {
                                $result['exception'] = 'fecha incorrecta';
                            } 

                                    } else {
                                        $result['exception'] = 'lote incorrecto';
                                    } 

                                } else {
                                    $result['exception'] = 'categoria incorrecto';
                                } 
                            } else {
                                $result['exception'] = 'nombre incorrecto';
                            } 
                        } else {
                         $result['exception'] = 'codigo incorrectso';
                        }                   
                break;

                case 'readOne':
                     if ($Productos->setId($_POST['id'])) {
                        if ($result['dataset'] = $Productos->readOne()) {
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
                    case 'graphProductos':
                        if ($result['dataset'] = $Productos->graphProductos()) {
                             $result['status'] = 1;
                        } else {
                             if (Database::getException()) {
                                   $result['exception'] = Database::getException();
                             } else {
                                   $result['exception'] = 'No hay datos registrados';
                             }
                        }						                    
                    break;
                case 'update':
                    $_POST = $Productos->validateForm($_POST);
                        if ($Productos->setId($_POST['id'])) {
                            if ($Productos->readOne()) {
                              $_POST = $Productos->validateForm($_POST);
                                    if ($Productos->setNombre($_POST['Nombre'])) {
                                                    if ($Productos->setComentario($_POST['Comentarios'])) {
                                                if ($Productos->updateRow()) {
                                                     $result['status'] = 1;
                                                    $result['message'] = 'Usuario Guardado Correctamente'; 
                                                } else {
                                                    $result['exception'] = Database::getException();;
                                                }
                                                
                                            } else {
                                                $result['exception'] = 'comentario erroneo';
                                            }  
                                        } else {
                                                $result['exception'] = 'nombre erroneo';
                                            } 
                                        } else {
                                            $result['exception'] = ' inactualizable';
                                        } 
        
                                    } else {
                                        $result['exception'] = 'codigo incorrecto';
                                    } 
        
                                           
                        break;
                    
            }
            header('content-type: application/json; charset=utf-8');
            print(json_encode($result));
    } else {
        print(json_encode('Recurso no disponible'));
    }