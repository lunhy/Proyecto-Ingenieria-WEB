<?php 
 //importar la conexion

 include '../funciones/conexion.php';

    $accion = $_POST['accion'];
    $password = $_POST['password'];
    if(isset($_POST['correo'])){
        $correo = $_POST['correo']; 
    }
    if(isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
    }   
    $usuario = $_POST['usuario'];

    if($accion === 'crear'){
        // codigo para crear los administradores
            
            //Realizar la consulta a la base de datos 
            //Para saber si el usuario ya existe
            $stmt = $conn->prepare("SELECT * FROM solicitudes WHERE usuario = ?");
            $stmt->bind_param('s', $usuario);
            $stmt->execute();
            $resU = $stmt->fetch();
            if($resU){
                $respuesta = array(
                    'respuesta' => 'error_usuario'                    
                );
                echo json_encode($respuesta);                
                die();
            }
            else{
                $stmt = $conn->prepare("SELECT * FROM solicitudes WHERE correo = ?");
                $stmt->bind_param('s', $correo);
                $stmt->execute();
                $resC = $stmt->fetch();
                if ($resC){   
                    $respuesta = array(
                        'respuesta' => 'error_correo'                    
                        );
                        echo json_encode($respuesta);                
                        die();                    
                }
                else{
                    //hashear passwords
                    $opciones = array(
                        'cost' => 12
                    );

                    $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
                                
                    try {
                        //Realizar la consulta a la base de datos
                        $stmt = $conn->prepare("INSERT INTO solicitudes (usuario, correo, password, tipo) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param('sssi', $usuario, $correo, $hash_password, $tipo);
                        $stmt->execute();
                        if($stmt->affected_rows > 0){
                            $respuesta = array(
                                'respuesta' => 'correcto',
                                'id_insertado' => $stmt->insert_id,
                                'tipo' => $accion
                            );
                        }
                        else{
                            $respuesta = array(
                                'respuesta' => 'error'
                            );
                        }
                        $stmt->close();
                        $conn->close();
                    } catch (Exception $e) {
                        //En caso de un error, tomar la exepcion
                        $respuesta = array(
                            'error' => $e->getMessage()
                        );
                    }
                    
                    echo json_encode($respuesta);                
                }
            }  
        } 
    

    if($accion === 'login'){
        // codigo para loguear los administradores
        include '../funciones/conexion.php';

        try {
            //Seleccionar el administrador de la base de datos
            $stmt = $conn->prepare("SELECT usuario, id, password, tipo FROM usuarios WHERE usuario = ?");
            $stmt->bind_param('s', $usuario);
            $stmt->execute();

            //Loguear el usuario
            $stmt->bind_result($nombre_usuario, $id_usuario, $pass_usuario, $tipo_usuario);
            $stmt->fetch();
            if($nombre_usuario){
                //El usuario existe, verificar el password
                if(password_verify($password,$pass_usuario)){ //password verify requiere el pass introducido en el form y el de la consulta
                    //Iniciar la sesion
                    session_start();
                    $_SESSION['nombre'] = $usuario;
                    $_SESSION['id'] = $id_usuario;
                    $_SESSION['tipo'] = $tipo_usuario;
                    $_SESSION['login'] = true;
                    //login correcto
                    $respuesta = array(
                        'respuesta' => 'correcto',
                        'nombre' => $nombre_usuario,
                        'tipo' => $accion
                    );
                }
                else {
                    //Login incorrecto, enviar error
                    $respuesta = array(
                        'resultado' => 'Password Incorrecto'
                    );
                }
            }
            else{
                $respuesta = array(
                    'error' => 'Usuario no Existe'
                );
            }
           
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            //En caso de un error, tomar la exepcion
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
        
        echo json_encode($respuesta);
    }

?>