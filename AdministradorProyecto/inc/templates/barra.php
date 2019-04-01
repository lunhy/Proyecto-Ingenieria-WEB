<?php
    $tipoU = $_SESSION['tipo'];    
?>
<div class="barra">
    <h1><a href="index.php">Project Organizer</a></h1>
    <?php if($tipoU === 1){?>
        <a href="solicitudes.php">Solicitudes</a>
    <?php   }?>
    <a href="login.php?cerrar_sesion=true">Cerrar Sesión</a>
</div>