<?php
    if(isset($_POST['accion'])){
        $accion = $_POST['accion'];
        $proyecto = $_POST['proyecto'];
        $descripcion = $_POST['descripcion'];
        $inicio = $_POST['inicio'];
        $fin = $_POST['fin'];
        if($accion === 'crear'){
            //importar la conexion
            include '../funciones/conexion.php';
    
            try {
                //Realizar la consulta a la base de datos
                $stmt = $conn->prepare("INSERT INTO proyectos (nombre, descripcion, fechaInicio, fechaFin) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('ssss', $proyecto, $descripcion, $inicio, $fin);
                $stmt->execute();
                if($stmt->affected_rows > 0){
                    $respuesta = array(
                        'respuesta' => 'correcto',
                        'id_insertado' => $stmt->insert_id,
                        'tipo' => $accion,
                        'nombre_proyecto' => $proyecto
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

    if(isset($_GET['accion'])){
        if($_GET['accion'] == 'borrar'){
            require_once('../funciones/conexion.php');
    
            //Validar las entradas
            $id = (int)$_GET['id'];
            try{
                //eliminamos primero las tareas
                $stmt = $conn->prepare("DELETE FROM tareas WHERE id_proyecto = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt = $conn->prepare("DELETE FROM proyectos WHERE id = ?");
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
    }    

?>