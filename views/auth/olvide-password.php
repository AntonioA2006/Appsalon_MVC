<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Restablece tu password</p>

<?php 
         include_once __DIR__ . '/../templates/alertas.php';
?>


<form class="formulario" action="/olvide" method="POST">

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Restablece tu password">
    </div>
    <input type="submit" class="boton" value="enviar E-mail">

</form>
<div class="acciones">
        <a href="/">Inicia Sesion</a>
        <a href="/crear-cuenta">Resgistrate</a>
</div>