<h1 class="nombre-pagina">Restablece password</h1>

<p class="descripcion-pagina">Coloca tu nuevo password</p>
<?php 
    include_once __DIR__ . '/../templates/alertas.php';
?>
<?php if($error)return null; ?>

<form class="formulario" method="POST">

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="tu nuevo password">

    </div>

    <input type="submit" class="boton" value="restablece tu password">

</form>
<div class="acciones">

    <a href="/">Inicia Sesion</a>
    <a href="/crear-cuenta">Registrate</a>


</div>