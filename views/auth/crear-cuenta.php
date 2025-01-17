<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario</p>

<?php 
         include_once __DIR__ . '/../templates/alertas.php';
?>


<form class="formulario" action="/crear-cuenta" method="POST">


    <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" value="<?php echo s($usuario->nombre) ?>">
    </div>
    <div class="campo">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Tu apellido" value="<?php echo s($usuario->apellido) ?>">
    </div>
    <div class="campo">
            <label for="telefono">Telefono</label>
            <input type="tel" name="telefono" id="telefono" placeholder="Tu telefono"value="<?php echo s($usuario->telefono) ?>">
    </div>
    <div class="campo">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Tu E-mail" value="<?php echo s($usuario->email) ?>">
    </div>
    <div class="campo">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu password">
    </div>

    <input type="submit" value="registrate" class="boton">
</form>
<div class="acciones">
        <a href="/">Inicia Sesion</a>
        <a href="/olvide">olvidaste tu password?</a>
</div>