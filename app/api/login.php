<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/usuario.php');
require_once('../models/registrosesion.php');


// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $usuario = new Usuario;
    $registro = new Regis;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.

        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'logOut':
                unset($_SESSION['idusuario']);
                unset( $_SESSION['usuario'] );
                unset( $_SESSION['tipousuario']);
                unset($_SESSION['token']);
                unset($_SESSION['ticket']);
                unset($_SESSION['correo']);
                $result['status'] = 1;
                $result['message'] = 'Sesión eliminada correctamente';
                break;
             
                       
                case 'readProfile':
                    if ($result['dataset'] = $usuario->readProfile()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    }
                    break; 
                    case 'editProfile':
                        $_POST = $usuario->validateForm($_POST);
                        if ($usuario->setNombre($_POST['nombres'])) {
                                if ($usuario->setCorreo($_POST['correos'])) {
                                    if ($usuario->setUsuario($_POST['usuarios'])) {
                                        if ($usuario->editProfile()) {
                                            $result['status'] = 1;
                                            $_SESSION['usuario'] = $usuario->getUsuario();
                                            $result['message'] = 'Perfil modificado correctamente';
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = 'Alias incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                           
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                        break;
                    case 'changePassword':
                        if ($usuario->setId($_SESSION['idusuario'])) {
                            $_POST = $usuario->validateForm($_POST);
                            if ($usuario->checkPassword($_POST['clave_actual'])) {
                                if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                                    if ($usuario->setClave($_POST['clave_nueva_1'])) {
                                        if ($usuario->changePassword()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Contraseña cambiada correctamente';
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = $usuario->getPasswordError();
                                    }
                                } else {
                                    $result['exception'] = 'Claves nuevas diferentes';
                                }
                            } else {
                                $result['exception'] = 'Clave actual incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Usuario incorrecto';
                        }
                        break;
                    case 'readAll':
                        if ($result['dataset'] = $usuario->readAll()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay usuarios registrados';
                            }
                        }
                        break;
                        case 'readSis':
                            if ($result['dataset'] = $registro->readSis()) {
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
                                $_POST = $usuario->validateForm($_POST);
                                    if ($usuario->setNombre($_POST['nombre'])) {
                                        if ($usuario->setUsuario($_POST['usuario'])) {
                                                if ($usuario -> setCorreo ($_POST ['correo'])){
                                                if ($_POST['clave'] == $_POST['confclave']) {
                                                if ($usuario->setClave($_POST['clave'])) {
                                                    if ($usuario->createNew()) {
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
                                            $result['exception'] = 'Usuario incorrecto';
                                        } 
                                    } else {
                                     $result['exception'] = 'Nombre incorrecto';
                                    }                   
                            break;
            
                                break;
                        case 'logIn':
                            $_POST = $usuario->validateForm($_POST);
                            if ($usuario->checkUser($_POST['usuario'])) {
                                if ($usuario->checkPassword($_POST['contraseña'])) {
                                    $_SESSION['idusuario'] = $usuario->getId();
                                    $_SESSION['usuario'] = $usuario->getUsuario();
                                    $_SESSION['tipousuario'] = $usuario->getTipoU();
                                    if ($registro->setCompu($_POST['browser'])) {
                                        if ($registro->setOs($_POST['os'])) {
                                            if ($registro->createRowsis()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Autenticación correcta';
                                           } else {
                                               $result['exception'] = Database::getException();;
                                           }
                                        } else {
                                            $result['exception'] = 'error en el dispositivo';
                                        }
                                    } else {
                                        $result['exception'] = 'Error en el sistema operativo';
                                    }

                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $result['exception'] = 'Clave incorrecta';
                                    }
                                }
                            } else {
                                if (Database::getException()) {
                                    $result['exception'] = Database::getException();
                                } else {
                                    $result['exception'] = 'Alias incorrecto';
                                }
                            }
                            break;
                            default:
                            $result['exception'] = 'Acción no disponible dentro de la sesión';
                    }
                }
                // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
                header('content-type: application/json; charset=utf-8');
                // Se imprime el resultado en formato JSON y se retorna al controlador.
                print(json_encode($result));
            