<?php
    $tipoU = $_SESSION['tipo'];    
?>
<aside class="contenedor-proyectos">
    <?php if($tipoU === 1){
        include 'inc/templates/crear-proyecto.php';
    }?>  
        <div class="panel lista-proyectos">
            <h2>Proyectos</h2>
            <ul id="proyectos">
                <?php
                    $proyectos = obtenerProyectos();
                    if($proyectos){
                        foreach($proyectos as $proyecto){?>
                            <li>
                                <a href="index.php?id_proyecto=<?php echo $proyecto['id']?>" id="proyecto:<?php echo $proyecto['id']?>">
                                    <?php echo $proyecto['nombre']?>
                                </a>
                                <?php if($tipoU === 1){
                                include 'inc/templates/editar-proyecto.php';?>                                
                                <button data-id="<?php echo $proyecto['id']; ?>" type="button" class="btn-borrarProyecto btn">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <?php }?> 
                            </li>
                    <?php } 
                    }
                ?>
            </ul>
        </div>
</aside>