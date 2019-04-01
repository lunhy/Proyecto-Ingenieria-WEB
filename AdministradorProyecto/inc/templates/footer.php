<script src="js/sweetalert2.all.min.js"></script>
    <?php
        $actual = obtenerPaginaActual();
        if($actual === 'crear-cuenta' || $actual === 'login'){
            echo '<script src="js/formulario.js"></script>';
        }else if($actual === 'index'){
            echo '<script src="js/scripts.js"></script>';
        }else{
            echo '<script src="js/script_solicitud.js"></script>';
        }
    ?>
</body>
</html>