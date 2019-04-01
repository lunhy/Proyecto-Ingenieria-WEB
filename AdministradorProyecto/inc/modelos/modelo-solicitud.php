<?php
    if(isset($_GET['accion'])){
        if($_GET['accion'] == 'borrar'){
            require_once('../funciones/conexion.php');

            //Validar las entradas
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

            try{
                $stmt = $conn->prepare("DELETE FROM solicitudes WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                if($stmt->affected_rows == 1){
                    $repuesta = array(
                        'respuesta' => 'correcto'
                    );
                }
                $stmt->close();
                $conn->close();
            }
            catch(Exception $e){
                    $repuesta = array(
                        'error' => $e->getMessage()
                    );
            }

            echo json_encode($repuesta);
        }

        if($_GET['accion'] == 'aceptar'){
            require_once('../funciones/conexion.php');

            $id = (int)$_GET['id'];

            $stmt = $conn->prepare('SELECT * FROM solicitudes WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            if($resultado->num_rows == 1){
                //obtenemos los datos del usuario de la tabla solicitudes
                while($res = $resultado->fetch_assoc()){
                    $usuario = $res['usuario'];
                    $correo = $res['correo'];
                    $hash_password = $res['password'];
                    $tipo = $res['tipo'];
                }
            }             
            try{
                //Realizar la consulta a la base de datos
                $stmt = $conn->prepare("INSERT INTO usuarios (usuario, correo, password, tipo) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('sssi', $usuario, $correo, $hash_password, $tipo);
                $stmt->execute();
                if($stmt->affected_rows == 1){
                    $repuesta = array(
                        'respuesta' => 'correcto',
                        'id_insertado' => $stmt->insert_id
                    );
                }
                $stmt = $conn->prepare("DELETE FROM solicitudes WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
                $conn->close();
            }
            catch(Exception $e){
                    $repuesta = array(
                        'error' => $e->getMessage()
                    );
            }

            echo json_encode($repuesta);         
        }

    }
    // function obtenerSolicitud($i){        
        //     include '../funciones/conexion.php';
    //       echo 'desde la funcion '.$i;    
    //     try {
        //         return $conn->query('SELECT usuario, correo, password, tipo FROM solicitudes WHERE id = $i');
    //     } catch (Exception $e) {
        //         echo '¡Error!: '.$e->getMessage();
    //         return false;
    //     }
    // }
 ?>