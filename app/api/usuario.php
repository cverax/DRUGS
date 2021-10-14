<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/usuario.php');
require_once('../models/registrosesion.php');


require_once('../../libraries/phpmailer/src/Exception.php');
require_once('../../libraries/phpmailer/src/PHPMailer.php');
require_once('../../libraries/phpmailer/src/SMTP.php'); 
require_once('../../libraries/phpmailer52/class.smtp.php'); 

if (isset($_GET['action'])){
    session_start();
    $Usuario=new Usuario;
    $registro=new Regis;

    $result = array ('status' => 0, 'message' =>null, 'exeception' => null); 

    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    function generate_string($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }

    if (isset($_SESSION['idusuario'])) {

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
                                                    $result['message'] = 'Usuario Actualizado Correctamente'; 
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
       
    } else {
        switch($_GET['action']){
        case 'readCorreo':
            if ($Usuario->readCorreo($_POST['usuario'])) {
                    $result['status'] = 1;
                    $_SESSION['correo'] = $Usuario->getCorreo();
                    $_SESSION['token'] =  generate_string($permitted_chars, 5);
                      
               } else {
                    if (Database::getException()) {
                       $result['exception'] = Database::getException();
                   } else {
                       $result['exception'] = 'No existe el respectivo Usuario';
                   }
                   }
           break;
            case 'updateTokens':
                if($Usuario->setTokens($_SESSION['token'])){
                    if($Usuario->setCorreo($_SESSION['correo'])){
                if ($Usuario->readTokens()) {
                   
                   $mail = new PHPMailer(true);
                   try {
                       //Server settings
                       $mail->SMTPDebug =0;                      //Enable verbose debug output
                       $mail->isSMTP();                                            //Send using SMTP
                       $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                       $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                       $mail->Username   = 'drugsinternationalservice@gmail.com';                     //SMTP username
                       $mail->Password   = 'Luis123.';                               //SMTP password
                       $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                       $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                   
                       //Recipients
                       $mail->setFrom('drugsinternationalservice@gmail.com', 'Administracion');
                       $mail->addAddress($_SESSION['correo']); 
                    
                       //Content
                       $mail->isHTML(true);                                  
                       $mail->Subject = 'Restauracion de clave de acceso';
                       $mail->Body    = 'Para recuperar su clave de acceso al sistema porfavor ingresar al siguiente link <a href="http://localhost/GitHub/DRUGS/views/recuperacion.php?tokens='.$_SESSION['token'].'">Este Link</a> 
                       si existe algun problema al momento de restaurar su clave, volver a intentar, si el problema persiste, porfavor pedidle ayuda al administrador';
                       $mail->AltBody = '';
                   
                       $mail->send();
                       $result['status'] = 1;
                       $result['message'] =  'Ingrese a su correo electronico para continuar con la restauracion';
                   } catch (Exception $e) {
                    $result['exception'] = 'Problema al enviar el correo';
                   }
                  
                } else {
                 $result['exception'] = Database::getException();;
                 }
                }else {
                    $result['exception'] = 'Problema con el correo';
                }
                }else {
                    $result['exception'] = 'Problema con la generacion de tokens';
                }
           break;
           case 'readTicket':
                if ($Usuario->readTiket($_SESSION['correo'])) {    
                        $_SESSION['ticket'] = $Usuario->getTokens();
                        if  ($_SESSION['ticket'] ==$_SESSION['token'] ) {
                            $result['status'] = 1;
                            $result['message'] =  'token correcto';
                        } else {
                            $result['exception'] = 'tokens incorrectos';
                        }
                   } else {
                        if (Database::getException()) {
                           $result['exception'] = Database::getException();
                       } else {
                           $result['exception'] = 'token no encontrado';
                       }
                       }
            break;
            case 'updatepass':
                    $_POST = $Usuario->validateForm($_POST);
                        if ($_POST['clave'] == $_POST['confclave']) {
                            if ($Usuario->setClave($_POST['clave'])) {
                                if ($Usuario->updatepass()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Contraseña cambiada correctamente';
                                   $_SESSION['token'] = generate_string($permitted_chars, 5);
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = $Usuario->getPasswordError();
                            }
                        } else {
                            $result['status'] = 2;
                            $result['exception'] = 'Claves nuevas diferentes';
                        }

            break;
           default:
           $result['exception'] = 'Acción no disponible fuera de la sesión';
    }
}
header('content-type: application/json; charset=utf-8');
print(json_encode($result)); 
} else {
    print(json_encode('Recurso no disponible'));
}
