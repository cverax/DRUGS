<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/usuario.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $usuario = new Usuario;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.

        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'logOut':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
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

                        case 'logIn':
                            $_POST = $usuario->validateForm($_POST);
                            if ($usuario->checkUser($_POST['usuario'])) {
                                if ($usuario->checkPassword($_POST['contraseña'])) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Autenticación correcta';
                                    $_SESSION['idusuario'] = $usuario->getId();
                                    $_SESSION['usuario'] = $usuario->getUsuario();
                                    $_SESSION['tipousuario'] = $usuario->getTipoU();

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
            