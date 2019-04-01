<?php
    //obtiene la pagina actual que se ejecuta
    function obtenerPaginaActual(){
        $archivo = basename($_SERVER['PHP_SELF']);//obtiene el nombre de la pagina actual
        $pagina = str_replace(".php", "", $archivo);//remplaza el texto de un string por otro
        return $pagina;
    }

    function obtenerSolicitudes(){
        include 'conexion.php';
        try {
            return $conn->query('SELECT id, usuario, correo, tipo FROM solicitudes');
        } catch (Exception $e) {
            echo '¡Error!: '.$e->getMessage();
            return false;
        }
    }