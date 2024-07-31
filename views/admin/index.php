<h1 class="nombre-pagina">Panel de administracion</h1>

<?php 
    include_once __DIR__ . '/../templates/barra.php';
?>
<h2>Buscar citas actuales o pasadas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $fecha ?>">
        </div>
    </form>


</div>
<?php  if(count($citas) === 0):?>

    <h2>No hay citas</h2>

<?php endif;?>

<div id="citas-admin">
    <ul class="citas">

    <?php 
            $idCita = 0;
            foreach($citas as $key => $cita):
            if($idCita !== $cita->id):
                $total = 0;
          
        ?>

        <li>
            <p>id: <span><?php echo $cita->id ?></span></p>
            <p>hora: <span><?php echo $cita->hora ?></span></p>
            <p>cliente: <span><?php echo $cita->cliente ?></span></p>
            <p>e-mail: <span><?php echo $cita->email ?></span></p>
            <p>telefono: <span><?php echo $cita->telefono ?></span></p>



                <h3>Servicios</h3>
            <?php 
           $idCita = $cita->id   ;
            endif; 
            $total += $cita->precio;
            ?>

            <p class="servicio"> <?php echo $cita->servicio .  ' $' . $cita->precio ?></p>


            <?php 
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0; 
                if (esUltimo($actual, $proximo)) :

            ?>
        <p class="total">Total: <span>$<?php echo $total ?></span> </p>
        <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id ?>">
                        <input type="submit" value="eliminar" class="boton-eliminar">
        </form>
    <?php
    endif;
    endforeach;?>

    </ul>
</div>
<?php
    $script = "<script src='build/js/buscador.js'></script>"


?>
